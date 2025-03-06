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
        $users=[[
            'name' => 'admin',
            'email' => 'yerfe717@gmail.com',
            'password' => bcrypt('12345678'),
            ],


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

    $user = User::find(1);
    $user->assignRole($admin);

    //paises
    $countries=[
        [
            'name' => 'Bolivia',
            'code' => 'BO',
        ],
        [
            'name' => 'Peru',
            'code' => 'PE',
        ],
        [
            'name' => 'Argentina',
            'code' => 'AR',
        ],
        [
            'name' => 'Colombia',
            'code' => 'CO',
        ],
        [
            'name' => 'Venezuela',
            'code' => 'VE',
        ],
        [
            'name' => 'Ecuador',
            'code' => 'EC',
        ],

    ];

    Country::insert($countries);

    //ciudades
    $cities=[
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

    $zones=[
        [
            'name' => 'Zona Sur',
            'details' => 'Zona Sur',
        ],
        [
            'name' => 'Zona Norte',
            'details' => 'Zona Norte',
        ],
        [
            'name' => 'Zona Central',
            'details' => 'Zona Central',
        ],
        [
            'name' => 'Zona Este',
            'details' => 'Zona Este',
        ],
        [
            'name' => 'Zona Oeste',
            'details' => 'Zona Oeste',
        ],
    ];

    Zone::insert($zones);

    //esatdo civiles
    $status=[
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


    $ministerios=[
        [
            'name' => 'Escuela dominical',
        ],
        [
            'name' => 'Jovenes',
        ],
        [
            'name' => 'Mujeres',
        ],
    ];
    Ministry::insert($ministerios);

    //estados de membresia
    $membresia=[
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

    $profeciones=[
        [
            'name' => 'Ingeniero',
        ],
        [
            'name' => 'Medico',
        ],
        [
            'name' => 'Abogado',
        ],
        [
            'name' => 'Profesor',
        ],
        [
            'name' => 'Estudiante',
        ],
        [
            'name' => 'Otro',
        ]
    ];
    Profession::insert($profeciones);

    }
}
