<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        $arr = ['users','customers','crm', 'page', 'service','settings','workflow','offer','blog','faq', 'slider', 'gallery', 'product', 'brand'];

        // İzinleri oluşturun
        Permission::create(['name'=> 'crm']);
        Permission::create(['name'=> 'shop']);
        Permission::create(['name'=> 'site']);
        
        foreach($arr as $i){
            Permission::create(['name'=> $i. ' show']);
            Permission::create(['name'=> $i. ' index']);
            Permission::create(['name'=> $i. ' edit']);
            Permission::create(['name'=> $i. ' create']);
            Permission::create(['name'=> $i. ' store']);
            Permission::create(['name'=> $i. ' update']);
            Permission::create(['name'=> $i. ' delete']);
            Permission::create(['name'=> $i. ' recovery']);
        }

        $role = Role::create(['name' => 'customer']);
        $role->givePermissionTo(['crm']);

        $role = Role::create(['name' => 'website']);
        $role = Role::create(['name' => 'shop']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        
    }
}
