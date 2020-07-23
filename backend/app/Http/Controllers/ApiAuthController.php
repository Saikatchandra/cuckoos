<?php

namespace App\Http\Controllers;

use App\Affiliate;
use App\ReferralList;
use App\User;
use Carbon\Carbon;
use sendotp\sendotp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'verify_otp', 'resend_otp', 'referrer', 'auth_user', 'user_update', 'password_reset_otp', 'reset_password']]);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);
    }
    
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        $credentials = request(['phone', 'password']);
        
        if(!$token = auth('api')->attempt($credentials)){
            return response()->json([
                'errors' => [
                    'account' => [
                        "Invalid phone number or password"
                    ]
                ]
            ], 422);
        }else {
            $user = auth('api')->user();
            
            if($user->isVerified){
                return $this->respondWithToken($token);
            }else {
                return response()->json(['verificationFailed' => true], 200);
            }
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['sometimes', 'nullable', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'condition' => ['required'],
            'phone' => ['required', 'integer', 'digits:10', 'unique:users'],
        ]);
    }

    /** 
     * Create User
     */
    public function register(Request $request){
        $validator = $this->validator($request->all());

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $user = User::create($request->all());
        $user->update(['password' => bcrypt($request->password), 'username' => uniqid()]);

        // check if user is referred by someone
        $this->referrer($request->referrer, $user);
        
        $affiliate = Affiliate::first();

        if($affiliate){
            // create wallet for the user.
            $userWallet = $user->wallet();
            $userWallet->create(['balance' => 0]);
            $amount = $affiliate->new_user_points;
            
            $user->transaction($amount, 1);

            $referrer = User::find($user->referrer_id);
            if($referrer){
                $amount =  $affiliate->referrer_user_points;
                $referrer->transaction($amount, 1);
            }
        }else {
            // Create Wallet for the user
            $user->wallet()->create(['balance' => 0]);
        }
        
        $otpCode = null;

        if($request->has('phone')){
            $this->send_otp_by_sms($user, $request->phone);
        }else {
            return response()->json('failed', 300);
        }

        return response()->json(['email' => $user->email, 'otp' => $otpCode ]);
        
        // Get the token
        // $token = auth('api')->login($user);
        // return $this->respondWithToken($token);
    }
     
    public function verify_otp(Request $request){
        $this->validate($request, [
            'code' => 'required|digits:6|integer',
        ]);

        if($request->code){
            $code = $request->code;
            $user = User::where('phone', $request->phone)->first();

            // $data = [
            //     'expired' => true,
            //     'verified' => false,
            //     'message' => '"'.$user->otp_expire.'"',
            // ];

            // return response()->json($data, 200);

            if($user->otp_expire >  Carbon::now()) {
                if($code == $user->otp){
                    $user->isVerified = true;
                    $user->save();

                    $data = [
                        'expired' => false,
                        'verified' => true,
                        'message' => 'Your account is verified',
                    ];

                    return response()->json($data, 200);
                }else {
                    $data = [
                        'expired' => false,
                        'verified' => false,
                        'message' => 'Your have entered wrong code',
                    ];

                    return response()->json($data, 200);
                }
            }else {
                $data = [
                    'expired' => true,
                    'verified' => false,
                    'message' => 'Your coupon has expired',
                ];

                return response()->json($data, 200);
            }
        }
    }

    public function resend_otp(Request $request){
        $user = User::where('phone', $request->phone)->first();

        if($request->has('phone')){
            $this->send_otp_by_sms($user, $request->phone);
        }else {
            return response()->json('failed', 300);
        }

        // if($user){
        //     if($user->otp_expire >  Carbon::now()) {
        //         // Save the otp in database
        //         // $user->update(['otp' => $otp, 'otp_expire' => Carbon::now()->addMinutes(15)]);
                
        //         // Your authentication key
        //         $authKey = "332379ADkhNSEcQ7R5ee4c15bP1";
        //         // Multiple mobiles numbers separated by comma
        //         $mobileNumber = $request->phone;
        //         // Sender ID,While using route4 sender id should be 6 characters long.
        //         $postData = array(
        //             'authkey' => $authKey,
        //             'mobile' => $mobileNumber,
        //             'retrytype' => 'voice',
        //         );

        //         $url = "http://api.msg91.com/api/retryotp.php";
        //         $dataArray = $postData;
        //         $ch = curl_init();
        //         $data = http_build_query($dataArray);
        //         $getUrl = $url."?".$data;
        //         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        //         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //         curl_setopt($ch, CURLOPT_URL, $getUrl);
        //         curl_setopt($ch, CURLOPT_TIMEOUT, 80);
                
        //         $response = curl_exec($ch);
                
        //         if(curl_error($ch)){
        //             echo 'Request Error:' . curl_error($ch);
        //         }else{
        //             $otpCode = true;
        //         }
        //         curl_close($ch);
        //     }else {
        //         $this->send_otp_by_sms($user, $request->phone);
        //     }
        // }else {
        //     return response()->json('failed', 401);
        // }
    }

    /**
     * 
     * If referrer User is found, add the referrer id
     * 
     */
    public function referrer($username, $user){
        $referrer = User::where('username', $username)->first();
        if($referrer){
            $user->update(['referrer_id' => $referrer->id]);
            // ======= Level 1 ========== //
            ReferralList::create([
                'parent_id' => $referrer->id,
                'user_id' => $user->id,
                'level' => 1,
            ]);

            // ======= Level 2 ========== //
            $level2 = User::find($referrer->id);
            if($level2 && $level2->referrer_id){
                ReferralList::create([
                    'parent_id' => $level2->referrer_id,
                    'user_id' => $user->id,
                    'level' => 2,
                ]);

                // ======= Level 3 ========== //
                $level3 = User::find($level2->referrer_id);
                if($level3 && $level3->referrer_id){
                    ReferralList::create([
                        'parent_id' => $level3->referrer_id,
                        'user_id' => $user->id,
                        'level' => 3,
                    ]);


                    // ======= Level 4 ========== //
                    $level4 = User::find($level3->referrer_id);
                    if($level4 && $level4->referrer_id){
                        ReferralList::create([
                            'parent_id' => $level4->referrer_id,
                            'user_id' => $user->id,
                            'level' => 4,
                        ]);


                        // ======= Level 5 ========== //
                        $level5 = User::find($level4->referrer_id);
                        if($level5 && $level5->referrer_id){
                            ReferralList::create([
                                'parent_id' => $level5->referrer_id,
                                'user_id' => $user->id,
                                'level' => 5,
                            ]);

                            
                            // ======= Level 6 ========== //
                            $level6 = User::find($level5->referrer_id);
                            if($level6 && $level6->referrer_id){
                                ReferralList::create([
                                    'parent_id' => $level6->referrer_id,
                                    'user_id' => $user->id,
                                    'level' => 6,
                                ]);
                                

                                // ======= Level 7 ========== //
                                $level7 = User::find($level6->referrer_id);
                                if($level7 && $level7->referrer_id){
                                    ReferralList::create([
                                        'parent_id' => $level7->referrer_id,
                                        'user_id' => $user->id,
                                        'level' => 7,
                                    ]);
                                

                                    // ======= Level 8 ========== //
                                    $level8 = User::find($level7->referrer_id);
                                    if($level8 && $level8->referrer_id){
                                        ReferralList::create([
                                            'parent_id' => $level8->referrer_id,
                                            'user_id' => $user->id,
                                            'level' => 8,
                                        ]);
                                

                                        // ======= Level 9 ========== //
                                        $level9 = User::find($level8->referrer_id);
                                        if($level9 && $level9->referrer_id){
                                            ReferralList::create([
                                                'parent_id' => $level9->referrer_id,
                                                'user_id' => $user->id,
                                                'level' => 9,
                                            ]);
                                

                                            // ======= Level 10 ========== //
                                            $level10 = User::find($level9->referrer_id);
                                            if($level10 && $level10->referrer_id){
                                                ReferralList::create([
                                                    'parent_id' => $level10->referrer_id,
                                                    'user_id' => $user->id,
                                                    'level' => 10,
                                                ]);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } 
                }
            }
        }

    }

    /**
     * Sent OTP by SMS using MSG91
     * 
     */
    public function send_otp_by_sms($user, $phone){
         // OTP code
        $otp = rand(100000, 999999);
        // Save the otp in database
        $user->update(['otp' => $otp, 'otp_expire' => Carbon::now()->addMinutes(15)]);
        // Your authentication key
        $authKey = "332379ADkhNSEcQ7R5ee4c15bP1";
        // Multiple mobiles numbers separated by comma
        $mobileNumber = $phone;
        // Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "cuckos";
        // Your message to send, Add URL encoding here.
        $message = "Your Verification Code is - $otp. Cuckoos.shop";

        $postData = array(
            'authkey' => $authKey,
            'mobile' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'otp' => $otp,
            'otp_length' => 6,
        );

        $url = "http://api.msg91.com/api/sendotp.php";
        $dataArray = $postData;
        $ch = curl_init();
        $data = http_build_query($dataArray);
        $getUrl = $url."?".$data;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        
        $response = curl_exec($ch);
        
        if(curl_error($ch)){
            echo 'Request Error:' . curl_error($ch);
        }else{
            $otpCode = true;
        }
        curl_close($ch);
    }


    public function auth_user(){
        $auth = auth('api')->user();

        if($auth){
            return response()->json($auth, 200);
        }else {
            return response()->json('failed', 401);
        }
    }

    
    public function user_update(Request $request){
        $user = auth('api')->user();

        if($user){
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => "required|email|max:255|unique:users,email, $user->id",
                'avatar' => 'sometimes|nullable|image|max:2048',
                'password' => 'sometimes|nullable|min:8',
            ]);

            // $user->name = $request->name;
            $user->email = $request->email;

            // password
            if($request->password){
                $user->password = bcrypt($request->password);
            }

            if($request->avatar){
                $imageName = time().'_'. uniqid() .'.'.$request->avatar->getClientOriginalExtension();
                $request->avatar->move(public_path('storage/user'), $imageName);
                $user->avatar = 'storage/user/' . $imageName;
            }

            // phone
            if($request->phone){
                if($request->phone !== $user->phone){
                    $user->isVerified = false;

                    $this->send_otp_by_sms($user, $request->phone);
                }
                $user->phone = $request->phone;
            }

            // phone
            if($request->username){
                $user->username = $request->username;
            }

            // Date of Birth
            if($request->dob && $request->dob !== "Invalid Date"){
                $date = Carbon::createFromFormat('Y-m-d', $request->dob);

                $user->dob = $date;
            }

            $user->save();

            return response()->json($user, 200);
        }else {
            return response()->json('failed', 401);
        }
    }

    /**
     * Send Password Reset OTP
     *
     * @param Request $request
     * @return response
     */
    public function password_reset_otp(Request $request){
        $this->validate($request, [
            'phone' => 'required|digits:10|integer',
        ]);

        $phone = $request->phone;
        $user = User::where('phone', $phone)->first();

        if($user){
            $this->send_otp_by_sms($user, $request->phone);

            return response([ 'success' => true ], 200);
        }else {
            return response([
                'errors' => [
                    'phone' => [
                        "No account found with this phone number",
                    ]
                ]
            ], 422);
        }
    }

    public function reset_password(Request $request){
        $this->validate($request, [
            'phone' => 'required|integer|digits:10',
            'otp' => 'required|integer|digits:6',
            'password' => 'required|min:6|string|confirmed',
        ]);

        if($request->otp){
            $code = $request->otp;
            $user = User::where('phone', $request->phone)->first();

            if($user->otp_expire >  Carbon::now()) {
                if($code == $user->otp){
                    $user->update(['password' => bcrypt($request->password)]);

                    $data = [
                        'expired' => false,
                        'verified' => true,
                        'message' => 'Password updated',
                    ];

                    return response()->json($data, 200);
                }else {
                    $data = [
                        'expired' => false,
                        'verified' => false,
                        'message' => 'Your have entered wrong code',
                    ];

                    return response()->json($data, 200);
                }
            }else {
                $data = [
                    'expired' => true,
                    'verified' => false,
                    'message' => 'Your coupon has expired',
                ];

                return response()->json($data, 200);
            }
        }
    }
}
