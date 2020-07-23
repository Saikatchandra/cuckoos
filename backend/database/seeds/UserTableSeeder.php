<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = bcrypt('12345678');

        // user 1 
        $user = User::create([
            'name' => 'Zakir Hossen',
            'email' => 'web.zakirbd@gmail.com',
            'password' => $password,
            'username' => 'devzakir',
            'phone' => '01625592566',
            'role_id' => 5,
            'isVerified' => true,
        ]);
        $user->assignRole('superadmin');
        // Create Wallet for the user
        $user->wallet()->create(['balance' => 0]);
    }
}
