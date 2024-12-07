<?php

namespace Database\Seeders;

use App\Models\Departemen;
use App\Models\Permission_group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Departemenpermissionseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissiongroup = Permission_group::firstOrCreate([
            'name' => 'Departemen'
        ]);

        Permission::firstOrCreate([
            'name' => 'departemen.index',
            'id_permission_group' => $permissiongroup->id
        ]);

        Permission::firstOrCreate([
            'name' => 'departemen.create',
            'id_permission_group' => $permissiongroup->id
        ]);

        Permission::firstOrCreate([
            'name' => 'departemen.edit',
            'id_permission_group' => $permissiongroup->id
        ]);

        Permission::firstOrCreate([
            'name' => 'departemen.store',
            'id_permission_group' => $permissiongroup->id
        ]);

        Permission::firstOrCreate([
            'name' => 'departemen.update',
            'id_permission_group' => $permissiongroup->id
        ]);


        Permission::firstOrCreate([
            'name' => 'departemen.delete',
            'id_permission_group' => $permissiongroup->id
        ]);

        $permissions = Permission::where('id_permission_group', $permissiongroup->id)->get();
        $roleID = 1;
        $role = Role::findById($roleID);
        $role->givePermissionTo($permissions);

        Departemen::firstOrCreate([
            'kode_dept' => 'PDD',
            'nama_dept' => 'Pendidikan'
        ]);

        Departemen::firstOrCreate([
            'kode_dept' => 'SDM',
            'nama_dept' => 'MSDM'
        ]);

        Departemen::firstOrCreate([
            'kode_dept' => 'SPR',
            'nama_dept' => 'SARANA PRASARANA'
        ]);

        Departemen::firstOrCreate([
            'kode_dept' => 'DKW',
            'nama_dept' => 'DAKWAH'
        ]);

        Departemen::firstOrCreate([
            'kode_dept' => 'KEU',
            'nama_dept' => 'KEUANGAN'
        ]);

        Departemen::firstOrCreate([
            'kode_dept' => 'EKM',
            'nama_dept' => 'EKONOMI'
        ]);

        Departemen::firstOrCreate([
            'kode_dept' => 'HLO',
            'nama_dept' => 'HALO'
        ]);

        Departemen::firstOrCreate([
            'kode_dept' => 'SKR',
            'nama_dept' => 'SEKRETARIAT'
        ]);
    }
}
