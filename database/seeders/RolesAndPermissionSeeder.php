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
        $roles = config('roles');
        foreach ($roles as $role => $permissions) {
            Role::truncate();
            Permission::truncate();
            DB::beginTransaction();
            collect($permissions)->each(function ($permission) {
                Permission::updateOrCreate([
                    'name' => $permission,],
                    ['guard_name' => 'api']
                );

            });

            Role::updateOrCreate(
                ['name' => $role,],
                ['guard_name' => 'api']
            )->syncPermissions($permissions);
            DB::commit();
        }
    }
}
