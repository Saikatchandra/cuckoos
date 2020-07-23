<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['name', 'slug', 'product_count'];

    public function subcategory(){
        return $this->hasOne(SubCategory::class);
    }
}
