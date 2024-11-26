<?php

namespace Database\Seeders;

use App\Models\Permission_group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Jenibiayapermissionseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissiongroup = Permission_group::create([
            'name' => 'Jenis Biaya'
        ]);

        Permission::create([
            'name' => 'jenisbiaya.index',
            'id_permission_group' => $permissiongroup->id
        ]);

        Permission::create([
            'name' => 'jenisbiaya.create',
            'id_permission_group' => $permissiongroup->id
        ]);

        Permission::create([
            'name' => 'jenisbiaya.edit',
            'id_permission_group' => $permissiongroup->id
        ]);

        Permission::create([
            'name' => 'jenisbiaya.store',
            'id_permission_group' => $permissiongroup->id
        ]);

        Permission::create([
            'name' => 'jenisbiaya.update',
            'id_permission_group' => $permissiongroup->id
        ]);


        Permission::create([
            'name' => 'jenisbiaya.delete',
            'id_permission_group' => $permissiongroup->id
        ]);

        $permissions = Permission::where('id_permission_group', $permissiongroup->id)->get();
        $roleID = 1;
        $role = Role::findById($roleID);
        $role->givePermissionTo($permissions);
    }
}
