<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'customer']);
        $role = Role::create(['name' => 'affiliate']);
        $role = Role::create(['name' => 'seller']);
        $role = Role::create(['name' => 'vendor']);
        $role = Role::create(['name' => 'superadmin']);
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'editor']);

        Permission::create(['name' => 'user index']);
        Permission::create(['name' => 'user create']);
        Permission::create(['name' => 'user edit']);
        Permission::create(['name' => 'user delete']);
        Permission::create(['name' => 'user view']);
        Permission::create(['name' => 'user kyc']);
        Permission::create(['name' => 'kyc verify']);
        
        Permission::create(['name' => 'category index']);
        Permission::create(['name' => 'category create']);
        Permission::create(['name' => 'category edit']);
        Permission::create(['name' => 'category delete']);
        Permission::create(['name' => 'category view']);
        
        Permission::create(['name' => 'subcategory index']);
        Permission::create(['name' => 'subcategory create']);
        Permission::create(['name' => 'subcategory edit']);
        Permission::create(['name' => 'subcategory delete']);
        Permission::create(['name' => 'subcategory view']);

        Permission::create(['name' => 'product index']);
        Permission::create(['name' => 'product create']);
        Permission::create(['name' => 'product edit']);
        Permission::create(['name' => 'product delete']);
        Permission::create(['name' => 'product view']);
        Permission::create(['name' => 'product import']);
        Permission::create(['name' => 'product gallery']);
        Permission::create(['name' => 'gallery edit']);
        Permission::create(['name' => 'gallery delete']);
        Permission::create(['name' => 'product attribute']);
        Permission::create(['name' => 'attribute delete']);

        Permission::create(['name' => 'brand index']);
        Permission::create(['name' => 'brand create']);
        Permission::create(['name' => 'brand edit']);
        Permission::create(['name' => 'brand delete']);
        Permission::create(['name' => 'brand view']);

        Permission::create(['name' => 'campaign index']);
        Permission::create(['name' => 'campaign create']);
        Permission::create(['name' => 'campaign edit']);
        Permission::create(['name' => 'campaign delete']);
        Permission::create(['name' => 'campaign view']);
        Permission::create(['name' => 'campaign product']);

        Permission::create(['name' => 'slider index']);
        Permission::create(['name' => 'slider create']);
        Permission::create(['name' => 'slider edit']);
        Permission::create(['name' => 'slider delete']);
        Permission::create(['name' => 'slider view']);
       

        Permission::create(['name' => 'order index']);
        Permission::create(['name' => 'order create']);
        Permission::create(['name' => 'order edit']);
        Permission::create(['name' => 'order delete']);
        Permission::create(['name' => 'order view']);
        
        Permission::create(['name' => 'shipping index']);
        Permission::create(['name' => 'shipping create']);
        Permission::create(['name' => 'shipping edit']);
        Permission::create(['name' => 'shipping delete']);
        Permission::create(['name' => 'shipping view']);
        
        Permission::create(['name' => 'billing index']);
        Permission::create(['name' => 'billing create']);
        Permission::create(['name' => 'billing edit']);
        Permission::create(['name' => 'billing delete']);
        Permission::create(['name' => 'billing view']);
        
        Permission::create(['name' => 'coupon index']);
        Permission::create(['name' => 'coupon create']);
        Permission::create(['name' => 'coupon edit']);
        Permission::create(['name' => 'coupon delete']);
        Permission::create(['name' => 'coupon view']);
        
        Permission::create(['name' => 'setting index']);

        Permission::create(['name' => 'comission index']);

        Permission::create(['name' => 'transaction index']);
        Permission::create(['name' => 'transaction edit']);
        Permission::create(['name' => 'transaction request']);

        // $permission = Permission::create(['name' => 'edit articles']);
        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);

        // $role->syncPermissions($permissions);
        // $permission->syncRoles($roles);

        // $role->revokePermissionTo($permission);
        // $permission->removeRole($role);
    }
}
