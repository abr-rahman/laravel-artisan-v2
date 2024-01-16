<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        foreach ($this->getRolesArray() as $roleData) {
            $role = Role::create([
                'name' => $roleData['name'],
            ]);
            $permissions = $this->getPermissionsForRole($roleData['name']);
            $role->permissions()->sync($permissions);
            $role->permissions()->attach($permissions, ['permission_name' => json_encode($permissions)]);
        }
    }

    public function getRolesArray(): array
    {
        $roles = array(
            array('id' => '1', 'name' => 'superadmin'),
            array('id' => '2', 'name' => 'admin'),
            array('id' => '3', 'name' => 'Accountant'),
        );
        return $roles;
    }

    public function getPermissionsForRole(string $roleName): array
    {
        $permissionsMapping = [
            'superadmin' => ['category_view', 'category_create', 'category_edit', 'category_delete'],
            'admin' => ['category_view', 'category_create'],
            'Accountant' => ['category_view'],
        ];

        $permissionModels = Permission::whereIn('name', $permissionsMapping[$roleName] ?? [])->get();

        return $permissionModels->pluck('id')->toArray();
    }
}
