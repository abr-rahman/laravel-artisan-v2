<?php
namespace App\Repositories;

use App\Models\Permission;
use App\Models\Role;

class RoleRepository implements RoleInterface
{
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role ;
    }

    public function all()
    {
       return $this->role->all();
    }

    public function find($id)
    {
       return $this->role->find($id);
    }

    public function create(array $data, $permissions)
    {
        // $role = $this->role->create($data);

        // $permissions = $this->getPermissionsForRole($data['name']);
        // $role->permissions()->sync($permissions);

        // return $role;

        return $this->role->create($data)->permissions()->sync(
                    $permissions,
                    ['name' => 'demo name']
                );
    }

    public function update(array $data, $id)
    {
        return $this->role->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->role->destroy($id);
    }

    public function getPermissionsForRole(string $roleName): array
    {
        $permissionsMapping = [
            'superadmin' => ['category_view', 'category_create', 'category_edit', 'category_delete'],
            'admin' => ['category_view', 'category_create'],
            'Accountant' => ['category_view'],
        ];

        $permissionNames = $permissionsMapping[$roleName] ?? [];
        $permissionModels = Permission::whereIn('name', $permissionNames)->get();

        return $permissionModels->pluck('id')->toArray();
    }
}

