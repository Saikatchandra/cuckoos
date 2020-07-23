<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $fillable = ['sku', 'type', 'name', 'value', 'price', 'stock', 'product_id'];
}
