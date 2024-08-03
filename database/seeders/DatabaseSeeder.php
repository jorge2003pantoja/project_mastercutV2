<?php

namespace Database\Seeders;

use App\Models\User;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear roles
        $adminRole = Role::create(['name' => 'admin']);
        $barberoRole = Role::create(['name' => 'barbero']);
        $userRole = Role::create(['name' => 'user']);

        // Crear permisos
        $permissions = [
            'create-workers',
            'edit-workers',
            'delete-workers',
            'view-workers',
            'create-services',
            'delete-services',
            'edit-services',
            'view-services',
            'view-appointments',
            'confirm-appointments',
            'cancel-appointments',
            'create-appointments',
            'view-own-appointments',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Asignar permisos a roles
        $adminRole->givePermissionTo([
            'create-workers',
            'edit-workers',
            'delete-workers',
            'view-workers',
            'create-services',
            'edit-services',
            'delete-services',
            'view-services',
        ]);

        $barberoRole->givePermissionTo([
            'view-appointments',
            'confirm-appointments',
            'cancel-appointments',
        ]);

        $userRole->givePermissionTo([
            'create-appointments',
            'view-own-appointments',
            'cancel-appointments',
        ]);

        /* User::factory(10)->create();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
    }
}

