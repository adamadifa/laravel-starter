<?php

namespace Database\Seeders;

use App\Models\Permission_group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Tahunajaranpermissionseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissiongroup = Permission_group::create([
            'name' => 'Tahun Ajaran'
        ]);

        Permission::create([
            'name' => 'tahunajaran.index',
            'id_permission_group' => $permissiongroup->id
        ]);

        Permission::create([
            'name' => 'tahunajaran.create',
            'id_permission_group' => $permissiongroup->id
        ]);

        Permission::create([
            'name' => 'tahunajaran.edit',
            'id_permission_group' => $permissiongroup->id
        ]);

        Permission::create([
            'name' => 'tahunajaran.store',
            'id_permission_group' => $permissiongroup->id
        ]);

        Permission::create([
            'name' => 'tahunajaran.update',
            'id_permission_group' => $permissiongroup->id
        ]);


        Permission::create([
            'name' => 'tahunajaran.delete',
            'id_permission_group' => $permissiongroup->id
        ]);

        $permissions = Permission::where('id_permission_group', $permissiongroup->id)->get();
        $roleID = 1;
        $role = Role::findById($roleID);
        $role->givePermissionTo($permissions);
    }
}
