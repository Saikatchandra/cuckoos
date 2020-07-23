<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolePermissionSeeder::class);
        $this->call(AssignPermissionSeeder::class);
        $this->call(RoleSeeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ProductBrandSeeder::class);
        $this->call(ComissionSeeder::class);


        // factory design
        $products = factory('App\Product', 100)->create();
        
        foreach($products as $product){
            factory('App\ProductGallery')->create(['product_id' => $product->id]);
            factory('App\ProductGallery')->create(['product_id' => $product->id]);
            factory('App\ProductGallery')->create(['product_id' => $product->id]);
            factory('App\ProductGallery')->create(['product_id' => $product->id]);
            factory('App\ProductGallery')->create(['product_id' => $product->id]);
            factory('App\ProductGallery')->create(['product_id' => $product->id]);
        }
    }
}
