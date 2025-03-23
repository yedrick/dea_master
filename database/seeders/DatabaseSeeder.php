<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\CivilStatus;
use App\Models\Country;
use App\Models\Level;
use App\Models\MembershipStatus;
use App\Models\Ministry;
use App\Models\Profession;
use App\Models\User;
use App\Models\Subject;
use App\Models\Zone;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PHPUnit\Framework\Constraint\Count;
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
        // $this->call([
        //     NodeSeeder::class
        // ]);
        $users = [
            [
                'name' => 'admin',
                'email' => 'yerfe717@gmail.com',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'subadmin',
                'email' => 'subadmin@gmail.com',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Dani',
                'email' => 'danielita240894@gmail.com',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'wendy',
                'email' => 'wendy@gmail.com',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'valeria',
                'email' => 'valeria@gmail.com',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'register',
                'email' => 'registro@gmail.com',
                'password' => bcrypt('12345678'),
            ]
        ];

        User::insert($users);

        $permissions = [
            'edit',
            'delete',
            'create',
            'view',
            'export',
            'view-user',
            'view-person',
            'view-parameter',
            'view-youth'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear roles y asignar permisos
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo($permissions);

        $subadmin = Role::firstOrCreate(['name' => 'subadmin']);
        $subadmin->givePermissionTo(['edit', 'create', 'view',  'view-person', 'view-parameter']);

        $register = Role::firstOrCreate(['name' => 'register']);
        $register->givePermissionTo(['create', 'view', 'edit', 'view-person', 'view-parameter']);

        $youth = Role::firstOrCreate(['name' => 'youth']);
        $youth->givePermissionTo(['edit', 'create', 'view', 'view-youth']);


        $user = User::find(1);
        $user->assignRole($admin);

        $user = User::find(2);
        $user->assignRole($subadmin);

        $user = User::find(3);
        $user->assignRole($youth);

        $user = User::find(4);
        $user->assignRole($youth);

        $user = User::find(5);
        $user->assignRole($youth);

        $user = User::find(6);
        $user->assignRole($register);

        //paises
        $countries = [
            [
                'name' => 'Bolivia',
                'code' => 'BO',
            ]
        ];

        Country::insert($countries);

        //ciudades
        $cities = [
            [
                'name' => 'La Paz',
                'country_id' => 1,
                'code' => 'LP',
            ],
            [
                'name' => 'Cochabamba',
                'country_id' => 1,
                'code' => 'CB',
            ],
            [
                'name' => 'Santa Cruz',
                'country_id' => 1,
                'code' => 'SC',
            ],
            [
                'name' => 'Oruro',
                'country_id' => 1,
                'code' => 'OR',
            ],
            [
                'name' => 'Potosi',
                'country_id' => 1,
                'code' => 'PT',
            ],
            [
                'name' => 'Sucre',
                'country_id' => 1,
                'code' => 'SU',
            ],
            [
                'name' => 'Tarija',
                'country_id' => 1,
                'code' => 'TJ',
            ],
            [
                'name' => 'Beni',
                'country_id' => 1,
                'code' => 'BN',
            ],
            [
                'name' => 'Pando',
                'country_id' => 1,
                'code' => 'PD',
            ]
        ];

        City::insert($cities);

        ///borrar

        // $zones = [
        //     [
        //         'name' => 'Zona Sur',
        //         'details' => 'Zona Sur',
        //     ],
        //     [
        //         'name' => 'Zona Norte',
        //         'details' => 'Zona Norte',
        //     ],
        //     [
        //         'name' => 'Zona Central',
        //         'details' => 'Zona Central',
        //     ],
        //     [
        //         'name' => 'Zona Este',
        //         'details' => 'Zona Este',
        //     ],
        //     [
        //         'name' => 'Zona Oeste',
        //         'details' => 'Zona Oeste',
        //     ],
        // ];

        // Zone::insert($zones);

        // //esatdo civiles
        $status = [
            [
                'name' => 'Soltero',
            ],
            [
                'name' => 'Casado',
            ],
            [
                'name' => 'Divorciado',
            ],
            [
                'name' => 'Viudo',
            ],
            [
                'name' => 'Union Libre',
            ],
        ];
        CivilStatus::insert($status);


        // $ministerios = [
        //     [
        //         'name' => 'Escuela dominical',
        //     ],
        //     [
        //         'name' => 'Jovenes',
        //     ],
        //     [
        //         'name' => 'Mujeres',
        //     ],
        // ];
        // Ministry::insert($ministerios);

        // //estados de membresia
        $membresia = [
            [
                'name' => 'Activo',
            ],
            [
                'name' => 'Inactivo',
            ],
            [
                'name' => 'En proceso',
            ],
            [
                'name' => 'Expulsado',
            ],
        ];
        MembershipStatus::insert($membresia);

        // $profeciones = [
        //     [
        //         'name' => 'Ingeniero',
        //     ],
        //     [
        //         'name' => 'Medico',
        //     ],
        //     [
        //         'name' => 'Abogado',
        //     ],
        //     [
        //         'name' => 'Profesor',
        //     ],
        //     [
        //         'name' => 'Estudiante',
        //     ],
        //     [
        //         'name' => 'Otro',
        //     ]
        // ];
        // Profession::insert($profeciones);
    }
}
