<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'avatar', 'phone', 'address', 'dob', 'description', 'facebook', 'skype', 'referrer_id', 'username', 'isVerified', 'otp', 'otp_expire', 'kyc_verification',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'role_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    
    /**
    * The accessors to append to the model's array form.
    *
    * @var array
    */
    protected $appends = ['referral_link', 'role_name'];

    /**
     * Get the user's role name.
     *
     * @param  string  $value
     * @return string
     */
    public function getRoleNameAttribute()
    {
        return $this->role_name = $this->role->name;
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    /**`
     * A user has a referrer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id', 'id');
    }

    /**
     * A user has many referrals.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referrals()
    {
        return $this->hasMany(User::class, 'referrer_id', 'id');
    }

    /**
    * Get the user's referral link.
    *
    * @return string
    */
    public function getReferralLinkAttribute()
    {
        $siteURL = env("SITE_URL", "https://cuckoos.shop"); 
        
        return $this->referral_link = $siteURL . '/register?ref=' . $this->username;
    }


    /** 
     * A user has many Level 1 referrals
     *
     * @return \Illuminate\Database\Eloquent\Relations\Hasmany
     */
    public function level1(){
        return $this->hasMany(ReferralList::class, 'parent_id', 'id')->where('level','=', 1);
    }
    
    /** 
     * A user has many Level 2 referrals
     *
     * @return \Illuminate\Database\Eloquent\Relations\Hasmany
     */
    public function level2(){
        return $this->hasMany(ReferralList::class, 'parent_id', 'id')->where('level','=', 2);
    }

    /** 
     * A user has many Level 3 referrals
     *
     * @return \Illuminate\Database\Eloquent\Relations\Hasmany
     */
    public function level3(){
        return $this->hasMany(ReferralList::class, 'parent_id', 'id')->where('level','=', 3);
    }

    /** 
     * A user has many Level 4 referrals
     *
     * @return \Illuminate\Database\Eloquent\Relations\Hasmany
     */
    public function level4(){
        return $this->hasMany(ReferralList::class, 'parent_id', 'id')->where('level','=', 4);
    }

    /** 
     * A user has many Level 5 referrals
     *
     * @return \Illuminate\Database\Eloquent\Relations\Hasmany
     */
    public function level5(){
        return $this->hasMany(ReferralList::class, 'parent_id', 'id')->where('level','=', 5);
    }

    /** 
     * A user has many Level 6 referrals
     *
     * @return \Illuminate\Database\Eloquent\Relations\Hasmany
     */
    public function level6(){
        return $this->hasMany(ReferralList::class, 'parent_id', 'id')->where('level','=', 6);
    }

    /** 
     * A user has many Level 7 referrals
     *
     * @return \Illuminate\Database\Eloquent\Relations\Hasmany
     */
    public function level7(){
        return $this->hasMany(ReferralList::class, 'parent_id', 'id')->where('level','=', 7);
    }

    /** 
     * A user has many Level 8 referrals
     *
     * @return \Illuminate\Database\Eloquent\Relations\Hasmany
     */
    public function level8(){
        return $this->hasMany(ReferralList::class, 'parent_id', 'id')->where('level','=', 8);
    }

    /** 
     * A user has many Level 9 referrals
     *
     * @return \Illuminate\Database\Eloquent\Relations\Hasmany
     */
    public function level9(){
        return $this->hasMany(ReferralList::class, 'parent_id', 'id')->where('level','=', 9);
    }

    /** 
     * A user has many Level 10 referrals
     *
     * @return \Illuminate\Database\Eloquent\Relations\Hasmany
     */
    public function level10(){
        return $this->hasMany(ReferralList::class, 'parent_id', 'id')->where('level','=', 10);
    }

    /** 
     * A user has one wallet
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wallet(){
        return $this->hasOne(Wallet::class);
    }

    /**
     * Create transaction for user wallet
     */
    public function transaction($amount, $type){
        $wallet = $this->wallet;
        if($type == 1){
            $wallet->transactions()->create(['amount' => $amount, 'type' => 1, 'user_id' => $this->id, 'status' => 1,]);
            // Transaction::create([
            //     'wallet_id' => $wallet->id,
            //     'type' => 1,
            //     'amount' => $amount,
            //     'status' => 1,
            //     'user_id' => $this->id,
            // ]);
            $wallet->increment('balance', $amount);
        }else {
            $wallet->transactions()->create(['amount' => $amount, 'type' => 0, 'user_id' => $this->id, 'status' => 1,]);
            // Transaction::create([
            //     'wallet_id' => $wallet->id,
            //     'type' => 0,
            //     'amount' => $amount,
            //     'status' => 1,
            //     'user_id' => $this->id,
            // ]);
            $wallet->decrement('balance', $amount);
        }
    }

    public function identity(){
        return $this->hasOne(VerifyIdentity::class);
    }

    public function rating(){
        return $this->hasMany(Rating::class);
    }
}
