<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin=Role::create([
            'name'=>'Super Admin',
            'slug'=>'super-admin'
        ]);
       $admin=Role::create([
        'name'=>'Organization Admin',
        'slug'=>'organization-admin'
       ]);
       $staff=Role::create([
        'name'=>'staff',
        'slug'=>'staff'
       ]);
       $permissions=[
        'manage-organizations',
        'manage-branchs',
        'manage-services',
        'manage-appointments',
        'manage-queues',
        'view-dashboard'
       ];

       foreach($permissions as $perm){
             $permission=Permission::create([
                'name'=>ucwords(str_replace('-',' ',$perm)),'slug'=>$perm
             ]);
             $superAdmin->permissions()->attach($permission);
       }

       $admin->permissions()->attach(
        Permission::whereIn('slug',[
            'manage-branchs',
            'manage-services',
            'manage-appointments',
            'manage-queues'
        ])->pluck('id')
       );

       $staff->permissions()->attach(
        Permission::whereIn('slug',[
            'manage-queues'
        ])->pluck('id')
       );
    }
}
