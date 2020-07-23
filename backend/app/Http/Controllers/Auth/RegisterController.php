<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Affiliate;
use App\ReferralList;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller 
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request)
    {
        if ($request->has('ref')) {
            session(['referrer' => $request->query('ref')]);
        }

        return view('auth.register');
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
            'username' => ['required', 'string', 'unique:users', 'alpha_dash', 'min:3', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $referrer = User::whereUsername(Cookie::get('referrer'))->first();

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'referrer_id' => $referrer ? $referrer->id : null,
            'password' => Hash::make($data['password']),
        ]);

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

        // Referral System
        if($referrer){
            
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

        return $user;
    }
}
