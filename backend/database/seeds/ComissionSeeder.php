<?php

use App\Affiliate;
use Illuminate\Database\Seeder;

class ComissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $affiliate = [ 
            'level1' => 15,
            'level2' => 13,
            'level3' => 12,
            'level4' => 10,
            'level5' => 10,
            'level6' => 10,
            'level7' => 9,
            'level8' => 7,
            'level9' => 7,
            'level10' => 7,
            'cart_percentage' => 10,
            'rupee_to_points' => 1,
            'new_user_points' => 50,
            'referrer_user_points' => 10
        ];

        Affiliate::create($affiliate);
    }
}
