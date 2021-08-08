<?php

use App\Models\Role;
use Illuminate\Database\Seeder;
use Database\Seeders\ApisTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\AccountsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ApisTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
    }
}
