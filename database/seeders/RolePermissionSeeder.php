<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::create(['name' => 'Super Admin']);

        $permissions = [
            'user' => [
                'User Create',
                'User Edit',
                'User Delete',
                'User Status'
            ],
            'role' => [
                'Role Create',
                'Role Edit',
                'Role Delete',
                'Role Status'
            ],
            'course' => [
                'Course Create',
                'Course Edit',
                'Course Delete',
                'Course Status',
            ],
        ];

        foreach ($permissions as $key => $permission) {
            foreach ($permission as $group) {
                Permission::create([
                    'name' => $group,
                    'group_name' => $key
                ]);
            }
        }
        $superAdmin->syncPermissions(Permission::all());
    }
}
