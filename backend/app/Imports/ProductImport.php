<?php

namespace App\Imports;

use App\Product;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'title' => $row['name'],
            'slug' => Str::slug($row['name']),
            'category_id' => $row['category_id'],
            'brand_id' => $row['brand_id'],
            'image' => 'image',
            'price' => $row['price'],
            'sale_price' => $row['sale_price'],
            'stock' => $row['stock'],
            'sku' => Str::slug($row['sku']),
            'description' => $row['description'],
            'information' => $row['information'],
            'comission' => $row['comission']
        ]);
    }
}
