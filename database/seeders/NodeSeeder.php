<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class NodeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Menu::insert([
            [
                'id' => 1,
                'name' => 'user',
                'label' => 'Usuarios',
                'is_multi' => false,
                'is_node' => true,
                'order' => 1,
                'parent_id' => null,
                'icon' => null,
                'permission' => null,
                'role' => null
            ],
            [
                'id' => 2,
                'name' => 'people',
                'label' => 'Personas',
                'is_multi' => false,
                'is_node' => true,
                'order' => 2,
                'parent_id' => null,
                'icon' => null,
                'permission' => null,
                'role' => null
            ],
            [
                'id' => 3,
                'name' => 'Parameter',
                'label' => 'Parametros',
                'is_multi' => true,
                'is_node' => true,
                'order' => 3,
                'parent_id' => null,
                'icon' => null,
                'permission' => null,
                'role' => null
            ],
            [
                'id' => 4,
                'name' => 'country',
                'label' => 'Paises',
                'is_multi' => false,
                'is_node' => true,
                'order' => 1,
                'parent_id' => 3,
                'icon' => null,
                'permission' => null,
                'role' => null
            ],
            [
                'id' => 5,
                'name' => 'city',
                'label' => 'Ciudades',
                'is_multi' => false,
                'is_node' => true,
                'order' => 2,
                'parent_id' => 3,
                'icon' => null,
                'permission' => null,
                'role' => null
            ],
            [
                'id' => 6,
                'name' => 'zone',
                'label' => 'Zonas',
                'is_multi' => false,
                'is_node' => true,
                'order' => 3,
                'parent_id' => 3,
                'icon' => null,
                'permission' => null,
                'role' => null
            ],
            [
                'id' => 7,
                'name' => 'civil-status',
                'label' => 'Estados Civiles',
                'is_multi' => false,
                'is_node' => true,
                'order' => 4,
                'parent_id' => 3,
                'icon' => null,
                'permission' => null,
                'role' => null
            ],
            [
                'id' => 8,
                'name' => 'membership-status',
                'label' => 'Estado de Membresias',
                'is_multi' => false,
                'is_node' => true,
                'order' => 5,
                'parent_id' => 3,
                'icon' => null,
                'permission' => null,
                'role' => null
            ],
            [
                'id' => 9,
                'name' => 'ministry',
                'label' => 'Ministerios',
                'is_multi' => false,
                'is_node' => true,
                'order' => 6,
                'parent_id' => 3,
                'icon' => null,
                'permission' => null,
                'role' => null
            ],
            [
                'id' => 10,
                'name' => 'profession',
                'label' => 'Profesiones',
                'is_multi' => false,
                'is_node' => true,
                'order' => 7,
                'parent_id' => 3,
                'icon' => null,
                'permission' => null,
                'role' => null
            ],
            [
                'id' => 11,
                'name' => 'youths',
                'label' => 'Jovenes',
                'is_multi' => true,
                'is_node' => true,
                'order' => 8,
                'parent_id' => null,
                'icon' => null,
                'permission' => null,
                'role' => null
            ],
            [
                'id' => 12,
                'name' => 'youth',
                'label' => 'Jovenes',
                'is_multi' => false,
                'is_node' => true,
                'order' => 8,
                'parent_id' => 11,
                'icon' => null,
                'permission' => null,
                'role' => null
            ],
            [
                'id' => 13,
                'name' => 'type-score',
                'label' => 'Tipo Puntajes',
                'is_multi' => false,
                'is_node' => true,
                'order' => 1,
                'parent_id' => 11,
                'icon' => null,
                'permission' => null,
                'role' => null
            ],
            [
                'id' => 14,
                'name' => 'youth-score',
                'label' => 'Puntaje de Jovenes',
                'is_multi' => false,
                'is_node' => true,
                'order' => 2,
                'parent_id' => 11,
                'icon' => null,
                'permission' => null,
                'role' => null
            ],
            [
                'id' => 15,
                'name' => 'view-young-pst',
                'label' => 'Añadir Puntos',
                'is_multi' => false,
                'is_node' => false,
                'order' => 2,
                'parent_id' => 11,
                'icon' => null,
                'permission' => null,
                'role' => null
            ]
        ]);
    }
}
