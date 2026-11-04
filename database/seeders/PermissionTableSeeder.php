<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            // ===== Dashboard =====
            'dashboard-access',
           
            // ===== User Permissions =====
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            // ===== Role Permissions =====
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'manage-permissions',

            // ===== Blog Permissions =====
            'blog-list',
            'blog-create',
            'blog-edit',
            'blog-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
