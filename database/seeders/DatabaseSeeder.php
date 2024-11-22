<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $users=[[
            'name' => 'admin',
            'email' => 'yerfe717@gmail.com',
            'password' => bcrypt('12345678'),
            ],
            [
            'name' => 'subadmin',
            'email' => 'sudadmin@gmail.com',
            'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'tutor2',
                'email' => 'tutor2@gmail.com',
                'password' => bcrypt('123'),
            ],
            [
                'name' => 'tutor1',
                'email' => 'tutor1@gmail.com',
                'password' => bcrypt('123'),
            ],
            [
                'name' => 'padre2',
                'email' => 'padre2@gmail.com',
                'password' => bcrypt('123'),
            ],
            [
                'name' => 'padre1',
                'email' => 'padre1@gmail.com',
                'password' => bcrypt('123'),
            ]
        ];

    User::insert($users);

    $permissions = [
        'edit',
        'delete',
        'create',
        'view',
        'list'
    ];

    foreach ($permissions as $permission) {
        Permission::firstOrCreate(['name' => $permission]);
    }

    // Crear roles y asignar permisos
    $admin = Role::firstOrCreate(['name' => 'admin']);
    $admin->givePermissionTo($permissions);

    $subadmin = Role::firstOrCreate(['name' => 'subadmin']);
    $subadmin->givePermissionTo(['edit', 'create', 'view', 'list']);

    $member = Role::firstOrCreate(['name' => 'padre']);
    $member->givePermissionTo(['view', 'list']);

    $member = Role::firstOrCreate(['name' => 'tutores']);
    $member->givePermissionTo(['view', 'list']);

    $member = Role::firstOrCreate(['name' => 'profesor']);
    $member->givePermissionTo(['view', 'list']);

    $user = User::find(1);
    $user->assignRole($admin);

    // $user_new = User::find(2);
    // $user_new->assignRole($subadmin);


    // creacion de roles
    // $admin = Role::create(['name' => 'admin']);
    // $permission = Permission::create(
    //     ['name' => 'edit'],
    //     ['name' => 'delete'],
    //     ['name' => 'create'],
    //     ['name' => 'view'],
    //     ['name' => 'list']
    // );

    // $admin->syncPermissions($permission);
    // $permission->syncPermissions($admin);


    // $permission = Permission::create(
    //     ['name' => 'edit'],
    //     ['name' => 'create'],
    //     ['name' => 'view'],
    //     ['name' => 'list']
    // );
    // $superAdmin = Role::create(['name' => 'super-admin']);
    // $superAdmin->syncPermissions($permission);
    // $permission->syncPermissions($superAdmin);

    // $permission = Permission::create(
    //     ['name' => 'view'],
    //     ['name' => 'list']
    // );
    // $miembro = Role::create(['name' => 'miembro']);
    // $miembro->syncPermissions($permission);
    // $permission->syncPermissions($miembro);


    }
}
