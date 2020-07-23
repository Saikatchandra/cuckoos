<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $guarded = [];

    protected $dates = [ 'start_date', 'end_date'];

    public function products(){
        return $this->belongsToMany(Product::class, 'campaign_product');
    }
}
