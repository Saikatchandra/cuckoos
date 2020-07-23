<?php

namespace App\Http\Controllers;

use App\ReferralList;
use App\Role;
use App\Transaction;
use Session;
use App\User;
use App\VerifyIdentity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(
            ['role:superadmin|admin|editor','permission:user index|user create|user edit|user delete|user view|user kyc|kyc verify'],
            ['except' => ['profile', 'update_profile']]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('role', 'referrals', 'wallet')->latest()->paginate(20);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required',
        ]);

        $user = User::create($request->all());
        if($request->has('role')){
            $user->role_id = $request->role;
        }

        // image
        if($request->hasFile('image')){
            $image = $request->image;
            $fileName = time().'_'. uniqid() .'.'. $image->getClientOriginalExtension();
            Storage::putFileAs('public/user', $image, $fileName);
            $user->avatar = 'storage/user/' . $fileName;
            $user->save();
        }
        $user->password = bcrypt($request->password);

        // assgin new user roles
        if($request->role == "5" || $request->role == 5){
            $user->assignRole('superadmin');
        }elseif($request->role == "6" || $request->role == 6){
            $user->assignRole('admin');
        }elseif($request->role == "7" || $request->role == 7){
            $user->assignRole('editor');
        }

        $user->save();

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

        if($user){
            Session::flash('success', 'User created successfully');
        }else {
            Session::flash('error', 'Something is not working');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->where('wallet_id', $user->wallet->id)->take(20)->get();
        $kyc = $user->identity;

        return view('admin.user.show', compact(['user', 'transactions', 'kyc']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.user.edit', compact(['user', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => "required|email|max:255|unique:users,email,$user->id",
            'password' => 'sometimes|nullable|min:8',
            'role' => 'required',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->has('role')){
            $user->role_id = $request->role;
        }
        
        // password
        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }

        // Removing user roles
        $user->removeRole('superadmin');
        $user->removeRole('admin');
        $user->removeRole('editor');

        // assgin new user roles
        if($request->role == "5" || $request->role == 5){
            $user->assignRole('superadmin');
        }elseif($request->role == "6" || $request->role == 6){
            $user->assignRole('admin');
        }elseif($request->role == "7" || $request->role == 7){
            $user->assignRole('editor');
        }

        
        // image
        if($request->hasFile('image')){
            $image = $request->image;
            $fileName = time().'_'. uniqid() .'.'. $image->getClientOriginalExtension();
            Storage::putFileAs('public/user', $image, $fileName);
            
            $user->avatar = 'storage/user/' . $fileName;
        }

        $user->save();

        Session::flash('success', 'User updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user){
            foreach($user->referrals as $user){
                $user->update(['referrer_id' => null ]);
            }
            $user->forceDelete();

            Session::flash('success', 'User deleted successfully');
        }
        return redirect()->back();
    }

    public function profile(){
        $user = auth()->user();
        $transactions = Transaction::orderBy('created_at', 'desc')->where('wallet_id', $user->wallet->id)->take(20)->get();

        return view('admin.user.profile', compact(['user', 'transactions']));
    }

    public function update_profile(Request $request)
    {
        $user = auth()->user();

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => "required|email|max:255|unique:users,email,$user->id",
            'password' => 'sometimes|nullable|min:8',
            'facebook' => 'sometimes|nullable|url',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->facebook = $request->facebook;
        $user->skype = $request->skype;
        $user->address = $request->address;
        $user->description = $request->description;
        
        // password
        if($request->has('password') && $request->password){
            $user->password = bcrypt($request->password);
        }
        
        // image
        if($request->hasFile('image')){
            $image = $request->image;
            $fileName = time().'_'. uniqid() .'.'. $image->getClientOriginalExtension();
            Storage::putFileAs('public/user', $image, $fileName);
            
            $user->avatar = 'storage/user/' . $fileName;
        }

        $user->save();

        Session::flash('success', 'Profile updated successfully');
        return redirect()->back();
    }

    public function affiliate(){
        $users = User::where('role_id', 2)->paginate(30);

        return view('admin.user.index', compact(['users']));
    }

    public function user_kyc(){
        $lists = VerifyIdentity::with('user')->latest()->paginate(30);

        return view('admin.user.kyc', compact('lists'));
    }

    public function verify_kyc($id){
        $kyc = VerifyIdentity::find($id);

        if($kyc){
            $kyc->status = true;
            $kyc->save();

            // set verification on user;
            $user = $kyc->user;
            $user->kyc_verification = true;
            $user->save();

            Session::flash('success', 'Identity Verified');
        }
        return redirect()->back();
    }

    public function user_kyc_edit($id){
        $kyc = VerifyIdentity::find($id);
        
        if($kyc){
            return view('admin.user.kyc-edit', compact('kyc'));
        }else {
            return redirect()->route('user.kyc');
        }
    }
}
