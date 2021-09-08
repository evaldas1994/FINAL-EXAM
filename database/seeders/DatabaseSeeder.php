<?php

namespace Database\Seeders;

use App\Models\Lake;
use App\Models\User;
use App\Models\Region;
use App\Models\Ticket;
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
        User::factory(9)->create();

        Region::factory(10)->create();
        Lake::factory(20)->create();
        Ticket::factory(40)->create();
    }
}
