<?php

use Illuminate\Database\Seeder;

class ProductBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ProductBrand::create([
            'name' => 'Microsoft',
            'slug' => 'microsoft'
        ]);

        App\ProductBrand::create([
            'name' => 'Dell',
            'slug' => 'dell'
        ]);

        App\ProductBrand::create([
            'name' => 'Oracle',
            'slug' => 'oracle'
        ]);

        App\ProductBrand::create([
            'name' => 'Amazon',
            'slug' => 'amazon'
        ]);

        App\ProductBrand::create([
            'name' => 'Nasa',
            'slug' => 'nasa'
        ]);
        
        App\ProductBrand::create([
            'name' => 'Tesla',
            'slug' => 'tesla'
        ]);
    }
}
