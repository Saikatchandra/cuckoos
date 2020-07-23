<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Setting::create([
            'site_name' => 'eCommerce Multivendor Platform',
            'copyright' => '© 2020 eCommerce.com',
            'email' => 'web.zakirbd@gmail.com',
            'address' => 'Dhaka, Dhaka Division, Bangladesh Road# 16/B, Adabor',
        ]);

    }
}
