<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Enums\RoleEnums;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'              => 'Super Admin',
                'email'             => 'superadmin@ttb.com',
                'password'          => Hash::make('ttb123'),
                'role'              => RoleEnums::ADMIN
            ],
            [
                'name'              => 'John Doe',
                'email'             => 'johndoe@ttb.com',
                'password'          => Hash::make('ttb123'),
                'role'              => RoleEnums::USER
            ]
        ];

        foreach ($users as $user) {
            $user_entry = User::create([
                'name'              => $user['name'],
                'email'             => $user['email'],
                'password'          => $user['password'],
                'email_verified_at' => Carbon::now()
            ]);

            $user_entry->roles()->save(Role::where('name', $user['role'])->first());
        }
    }
}
