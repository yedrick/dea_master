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

    $user5 = User::find(5);
    $user5->assignRole($padre);

    $user6 = User::find(6);
    $user6->assignRole($padre);

    $user7 = User::find(7);
    $user7->assignRole($profesor);



    // ceracion de level a ,b , c
    $levels = [
        ['name' => 'inicial'],
        ['name' => 'primaria'],
        ['name' => 'secundaria'],
    ];
    Level::insert($levels);

    // creacion de grades
    $grades = [
        ['name' => '1','level_id'=>1],
        ['name' => '2','level_id'=>1],
        // primaria
        ['name' => '1' ,'level_id'=>2],
        ['name' => '2','level_id'=>2],
        ['name' => '3','level_id'=>2],
        ['name' => '4','level_id'=>2],
        ['name' => '5','level_id'=>2],
        ['name' => '6','level_id'=>2],
        //secundaria
        ['name' => '1','level_id'=>3],
        ['name' => '2','level_id'=>3],
        ['name' => '3','level_id'=>3],
        ['name' => '4','level_id'=>3],
        ['name' => '5','level_id'=>3],
        ['name' => '6','level_id'=>3],

    ];
    \App\Models\Grade::insert($grades);

    $courses=[
        // inicial
        ['name'=>'A','grade_id'=>1],
        ['name'=>'B','grade_id'=>1],

        ['name'=>'B','grade_id'=>2],
        ['name'=>'A','grade_id'=>2],

        // primaria

        ['name'=>'A','grade_id'=>3],
        ['name'=>'B','grade_id'=>3],
        ['name'=>'C','grade_id'=>3],
        ['name'=>'D','grade_id'=>3],

        ['name'=>'A','grade_id'=>4],
        ['name'=>'B','grade_id'=>4],
        ['name'=>'C','grade_id'=>4],
        ['name'=>'D','grade_id'=>4],

        ['name'=>'A','grade_id'=>5],
        ['name'=>'B','grade_id'=>5],
        ['name'=>'C','grade_id'=>5],
        ['name'=>'D','grade_id'=>5],

        ['name'=>'A','grade_id'=>6],
        ['name'=>'B','grade_id'=>6],
        ['name'=>'C','grade_id'=>6],
        ['name'=>'D','grade_id'=>6],

        ['name'=>'A','grade_id'=>7],
        ['name'=>'B','grade_id'=>7],
        ['name'=>'C','grade_id'=>7],
        ['name'=>'D','grade_id'=>7],

        ['name'=>'A','grade_id'=>8],
        ['name'=>'B','grade_id'=>8],
        ['name'=>'C','grade_id'=>8],
        ['name'=>'D','grade_id'=>8],

        //secundaria

        ['name'=>'A','grade_id'=>9],
        ['name'=>'B','grade_id'=>9],
        ['name'=>'C','grade_id'=>9],
        ['name'=>'D','grade_id'=>9],

        ['name'=>'A','grade_id'=>10],
        ['name'=>'B','grade_id'=>10],
        ['name'=>'C','grade_id'=>10],
        ['name'=>'D','grade_id'=>10],

        ['name'=>'A','grade_id'=>11],
        ['name'=>'B','grade_id'=>11],
        ['name'=>'C','grade_id'=>11],
        ['name'=>'D','grade_id'=>11],

        ['name'=>'A','grade_id'=>12],
        ['name'=>'B','grade_id'=>12],
        ['name'=>'C','grade_id'=>12],
        ['name'=>'D','grade_id'=>12],

        ['name'=>'A','grade_id'=>13],
        ['name'=>'B','grade_id'=>13],
        ['name'=>'C','grade_id'=>13],
        ['name'=>'D','grade_id'=>13],

        ['name'=>'A','grade_id'=>14],
        ['name'=>'B','grade_id'=>14],
        ['name'=>'C','grade_id'=>14],
        ['name'=>'D','grade_id'=>14],

    ];
    \App\Models\Course::insert($courses);

    $subjects = [
        ['name' => 'Desarrollo Personal y Social'],
        ['name' => 'Lenguaje y Comunicación'],
        ['name' => 'Matemáticas'],
        ['name' => 'Ciencias Naturales'],
        ['name' => 'Ciencias Sociales'],
        ['name' => 'Educación Musical'],
        ['name' => 'Psicomotricidad'],
        ['name' => 'Educación Física'],
        ['name' => 'Vida Comunitaria y Valores'],
        ['name' => 'Computación básica'],
        ['name' => 'Física'],
        ['name' => 'Química'],
        ['name' => 'Matematicas'],
        ['name' => 'Biología'],
        ['name' => 'Filosofía y Psicología'],
        ['name' => 'Sociología'],
        ['name' => 'Filosofía y Ética'],
        ['name' => 'Robotica'],
    ];
    \App\Models\Subject::insert($subjects);

    $quarters = [
        ['name' => 'Primer Trimestre'],
        ['name' => 'Segundo Trimestre'],
        ['name' => 'Tercero Trimestre'],
    ];
    \App\Models\Quarter::insert($quarters);

    $teachers=[
        ['user_id'=>7,'subject_id'=>1,'course_id'=>1]
    ];
    \App\Models\Teacher::insert($teachers);

    // $this->call([
    //     SubjectSeeder::class,
    // ]);

    }
}
