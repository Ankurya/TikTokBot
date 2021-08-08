<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Account;
use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::create([
            'user_id'     => User::skip(1)->first()->id,  
            'account_key' => '4wIDfSjkxkqYBYNF4FrftFbJTNPsil2e'
        ]);
    }
}
