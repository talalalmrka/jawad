<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    public function roles()
    {
        return [
            [
                'name' => 'admin',
                'guard_name' => 'web',
                'permissions' => [
                    'manage users',
                    'manage posts',
                    'manage roles',
                    'manage permissions',
                ],
            ],
            [
                'name' => 'manager',
                'guard_name' => 'web',
                'permissions' => [
                    'manage users',
                    'manage posts',
                ],
            ],
            [
                'name' => 'member',
                'guard_name' => 'web',
                'permissions' => [],
            ],

        ];
    }

    public function permissions()
    {
        $permissions = [];
        foreach ($this->roles() as $role) {
            $permissions = array_merge($permissions, $role['permissions']);
        }
        return array_unique($permissions);
    }

    public function createPermissions()
    {
        $permissions = $this->permissions();
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $this->createPermissions();
        $roles = $this->roles();
        foreach ($roles as $item) {

            $role = Role::create(Arr::only($item, ['name', 'guard_name']));
            $permissions = Permission::whereIn('name', $item['permissions'])->get();
            if ($role) {
                $role->syncPermissions($permissions);
            }
        }
    }
}
