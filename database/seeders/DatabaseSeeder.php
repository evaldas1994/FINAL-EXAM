<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'password' => '00555',
            'email' => 'Evaldas.tuleikis@gmail.com'
        ]);
//         User::factory(10)->create();
    }
}
