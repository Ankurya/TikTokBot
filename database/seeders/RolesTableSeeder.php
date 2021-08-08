<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Enums\RoleEnums;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name'          => RoleEnums::ADMIN,
                'description'   => 'Handles everything!'
            ],
            [
                'name'          => RoleEnums::USER,
                'description'   => 'Handles own data!'
            ]
        ];

        foreach ($roles as $role) {
            Role::create([
                'name'          => $role['name'],
                'description'   => $role['description']
            ]);
        }
    }
}
