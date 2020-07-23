<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'slug', 'category_id', 'image', 'description', 'information', 'stock', 'price', 'sale_price', 'sku', 'brand_id', 'comission', 'origin', 'recommended'];

    public function galleries(){
        return $this->hasMany(ProductGallery::class);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function category(){
        return $this->belongsTo(ProductCategory::class);
    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }

    public function brand(){
        return $this->belongsTo(ProductBrand::class);
    }

    public function rating(){
        return $this->hasMany(Rating::class);
    }

    
}
