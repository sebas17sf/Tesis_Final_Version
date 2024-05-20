<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{

    public function run(): void
    {
        $roles = [
            ['Tipo' => 'Administrador'],
            ['Tipo' => 'Estudiante'],
            ['Tipo' => 'DirectorVinculacion'],
            ['Tipo' => 'ParticipanteVinculacion'],
            ['Tipo' => 'Vinculacion'],
            ['Tipo' => 'Director-Departamento'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate($role);
        }
    }
}
