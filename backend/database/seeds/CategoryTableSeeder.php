<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ProductCategory::create([
            'name' => 'Fashion',
            'slug' => 'fashion',
        ]);
        
        App\ProductCategory::create([
            'name' => 'Supermarket',
            'slug' => 'supermarket',
        ]);

        App\ProductCategory::create([
            'name' => 'Electronics',
            'slug' => 'electronics',
        ]);

        App\ProductCategory::create([
            'name' => 'Baby & Toys',
            'slug' => 'baby-toys',
        ]);

        App\ProductCategory::create([
            'name' => 'Fitness sport',
            'slug' => 'fitness-sport',
        ]);

        App\ProductCategory::create([
            'name' => 'Clothing',
            'slug' => 'clothing',
        ]);

        App\ProductCategory::create([
            'name' => 'Furnitures',
            'slug' => 'furnitures',
        ]);
    }
}
