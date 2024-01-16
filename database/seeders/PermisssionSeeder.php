<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisssionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        foreach ($this->permissionArray() as $permissionData) {
            Permission::updateOrCreate(
                ['name' => $permissionData['name']],
                $permissionData
            );
        }
    }

    public function permissionArray(): array
    {
        $permissions = array(
            array('id' => 1,'name'=> 'category_view'),
            array('id' => 2,'name'=> 'category_create'),
            array('id' => 3,'name'=> 'category_edit'),
            array('id' => 4,'name'=> 'category_delete'),
            array('id' => 5,'name'=> 'brand_view'),
        );
        return $permissions;
    }
}
