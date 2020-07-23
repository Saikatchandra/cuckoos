<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([ 'name' => 'Customer' ]);
        Role::create([ 'name' => 'Affiliate' ]);
        Role::create([ 'name' => 'Seller' ]);
        Role::create([ 'name' => 'Vendor' ]);
        Role::create([ 'name' => 'Super Admin' ]);
        Role::create([ 'name' => 'Admin' ]);
        Role::create([ 'name' => 'Editor' ]);
    }
}
