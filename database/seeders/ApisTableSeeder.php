<?php

namespace Database\Seeders;

use App\Models\Api;
use Illuminate\Database\Seeder;

class ApisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apis = [
            [
                'platform'  => 'TikApi',
                'api_key'   =>  'vOHsuJfqr8LFyYitEPYWEs606pXvvpVF'
            ]
        ];

        foreach ($apis as $api) {
            Api::create([
                'platform'  => $api['platform'],
                'api_key'   => $api['api_key']
            ]);
        }
    }
}
