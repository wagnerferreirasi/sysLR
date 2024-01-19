<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        #prexis permissions
        $prefix = ['cashier_', 'client_', 'package_', 'place_', 'destiny_', 'route_', 'report_', 'warning_', 'password_', 'user_', 'payment_'];

        foreach ($prefix as $p) {
            if ($p == 'cashier_'){
                Permission::create(['name' => $p . 'open']);
                Permission::create(['name' => $p . 'close']);
                Permission::create(['name' => $p . 'withdraw']);
                Permission::create(['name' => $p . 'deposit']);
                Permission::create(['name' => $p . 'transfer']);

            }
            Permission::create(['name' => $p . 'view']);
            Permission::create(['name' => $p . 'create']);
            Permission::create(['name' => $p . 'edit']);
            Permission::create(['name' => $p . 'delete']);
            Permission::create(['name' => $p . 'full_access']);
        }

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'user']);
        //$role->givePermissionTo(['package_full_access']);

        // or may be done by chaining
        $role = Role::create(['name' => 'manager']);
            //->givePermissionTo(['']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'master']);
        $role->givePermissionTo(Permission::all());
    }
}
