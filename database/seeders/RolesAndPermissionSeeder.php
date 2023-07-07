<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();

        Role::truncate();
        Permission::truncate();

        $roles = config('roles');
        foreach ($roles as $role => $permissions) {

            DB::beginTransaction();
            collect($permissions)->each(function ($permission) {
                Permission::updateOrCreate([
                    'name' => $permission,],
                    ['guard_name' => 'sanctum']
                );

            });

            Role::updateOrCreate(
                ['name' => $role,],
                ['guard_name' => 'sanctum']
            )->syncPermissions($permissions);
            DB::commit();
        }
    }
}
