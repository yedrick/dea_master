<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\User;
use App\Models\Subject;
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
            ],
            [
                'name' => 'profesor',
                'email' => 'profe@gmail.com',
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

    $padre = Role::firstOrCreate(['name' => 'padre']);
    $padre->givePermissionTo(['view', 'list']);

    $tutores = Role::firstOrCreate(['name' => 'tutores']);
    $tutores->givePermissionTo(['view', 'list']);

    $profesor = Role::firstOrCreate(['name' => 'profesor']);
    $profesor->givePermissionTo(['view', 'list']);

    $user = User::find(1);
    $user->assignRole($admin);

    $user2 = User::find(2);
    $user2->assignRole($padre);

    $user2 = User::find(3);
    $user2->assignRole($tutores);

    $user3 = User::find(4);
    $user3->assignRole($profesor);

    // ceracion de level a ,b , c
    $levels = [
        ['name' => 'primaria'],
        ['name' => 'secundaria'],
        ['name' => 'preparatoria'],
        ['name' => 'universidad'],
    ];
    Level::insert($levels);

    // creacion de grades
    $grades = [
        ['name' => '1'],
        ['name' => '2'],
        ['name' => '3'],
        ['name' => '4'],
        ['name' => '5'],
        ['name' => '6'],
        ['name' => '7'],
        ['name' => '8'],
        ['name' => '9'],
        ['name' => '10'],
        ['name' => '11'],
        ['name' => '12'],
    ];
    \App\Models\Grade::insert($grades);

    $courses=[
        ['name'=>'A'],
        ['name'=>'B'],
        ['name'=>'C'],
        ['name'=>'D'],
        ['name'=>'E'],
        ['name'=>'F']
    ];
    \App\Models\Course::insert($courses);

    $quarters=[
    ];


    $this->call([
        SubjectSeeder::class,
    ]);

    }
}
