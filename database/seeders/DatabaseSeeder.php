<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create([
            'name' => 'Evaldas',
            'surname' => 'Tuleikis',
            'password' => Hash::make('00555'),
            'email' => 'Evaldas.tuleikis@gmail.com'
        ]);

        Region::factory(10)->create();
    }
}
