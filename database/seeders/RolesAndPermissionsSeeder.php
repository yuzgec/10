<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Temel izinleri oluştur
        $permissions = [
            'access-go',
            'view-dashboard',
            'manage-users',
            'manage-roles',
            'manage-products',
            'manage-categories',
            'manage-brands',
            'manage-attributes',
            'manage-orders',
            'manage-customers',
            'manage-settings',
            'manage-services',
            'manage-pages',
            'manage-teams',
            'manage-blogs',
            'manage-comments',
            'manage-media',
            'manage-payments',
            'manage-reports',
            'manage-notifications',
            'manage-seo',
            'manage-sitemap',
            'manage-backup',
            'manage-logs',
            'manage-cache',
            'manage-maintenance',
            'manage-updates',
            'manage-translations'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Admin rolü oluştur ve tüm izinleri ver
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        // Editor rolü oluştur ve bazı izinleri ver
        $role = Role::create(['name' => 'editor']);
        $role->givePermissionTo([
            'access-go',
            'view-dashboard',
            'manage-products',
            'manage-categories',
            'manage-brands',
            'manage-attributes',
        ]);
    }
}
