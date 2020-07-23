<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $role = Role::where('name', 'superadmin')->first();
        $permissions = Permission::all();

        foreach($permissions as $permission){
            $role->givePermissionTo($permission);
        }

        $role = Role::where('name', 'admin')->first();
        if($role){
           $permission =  Permission::where('name', 'user index')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'user create')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'user edit')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'user view')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'user kyc')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'user kyc verify')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'category index')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'category create')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'category edit')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'category view')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'subcategory index')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'subcategory create')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'subcategory edit')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'subcategory view')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'product index')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'product create')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'product edit')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'product view')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'product import')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'product gallery')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'gallery edit')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'product attribute')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'brand index')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'brand create')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'brand edit')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'brand view')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'campaign index')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'campaign create')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'campaign edit')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'campaign view')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'campaign product')->first();
           $role->givePermissionTo($permission);
            
            $permission =  Permission::where('name', 'slider index')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'slider create')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'slider edit')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'slider view')->first();
           $role->givePermissionTo($permission);

           $permission =  Permission::where('name', 'order index')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'order create')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'order edit')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'order view')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'shipping index')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'shipping create')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'shipping edit')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'shipping view')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'billing index')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'billing create')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'billing edit')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'billing view')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'coupon index')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'coupon create')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'coupon edit')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'coupon view')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'setting index')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'comission index')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'transaction index')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'transaction edit')->first();
           $role->givePermissionTo($permission);
           $permission =  Permission::where('name', 'transaction request')->first();
           $role->givePermissionTo($permission);
        }

        $role = Role::where('name', 'editor')->first();
        
        if($role){
            $permission = Permission::where('name', 'category index')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'category create')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'category edit')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'category view')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'subcategory index')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'subcategory create')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'subcategory edit')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'subcategory view')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'product index')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'product create')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'product edit')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'product view')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'product import')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'product gallery')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'gallery edit')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'product attribute')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'brand index')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'brand create')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'brand edit')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'brand view')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'campaign index')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'campaign create')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'campaign edit')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'campaign view')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'campaign product')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'order index')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'order create')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'order edit')->first();
            $role->givePermissionTo($permission);
            $permission = Permission::where('name', 'order view')->first();
            $role->givePermissionTo($permission);
        }
    }
}
