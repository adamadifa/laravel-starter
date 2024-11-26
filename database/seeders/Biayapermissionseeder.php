<?php

namespace Database\Seeders;

use App\Models\Permission_group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Biayapermissionseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissiongroup = Permission_group::create([
            'name' => 'Biaya'
        ]);

        Permission::create([
            'name' => 'biaya.index',
            'id_permission_group' => $permissiongroup->id
        ]);

        Permission::create([
            'name' => 'biaya.create',
            'id_permission_group' => $permissiongroup->id
        ]);

        Permission::create([
            'name' => 'biaya.edit',
            'id_permission_group' => $permissiongroup->id
        ]);

        Permission::create([
            'name' => 'biaya.store',
            'id_permission_group' => $permissiongroup->id
        ]);

        Permission::create([
            'name' => 'biaya.update',
            'id_permission_group' => $permissiongroup->id
        ]);


        Permission::create([
            'name' => 'biaya.delete',
            'id_permission_group' => $permissiongroup->id
        ]);

        $permissions = Permission::where('id_permission_group', $permissiongroup->id)->get();
        $roleID = 1;
        $role = Role::findById($roleID);
        $role->givePermissionTo($permissions);
    }
}
