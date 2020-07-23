<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferralList extends Model
{
    protected $guarded = [];

    public function referrals(){
        return $this->hasMany('App\User', 'user_id', 'referrer_id');
    }

    public function parent(){
        return $this->belongsTo('App\User', 'parent_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
