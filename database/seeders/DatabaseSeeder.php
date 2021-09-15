<?php

namespace Database\Seeders;

use App\Models\Lake;
use App\Models\User;
use App\Models\Region;
use App\Models\Ticket;
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
//        User::factory(1)->create([
//            'name' => 'Evaldas',
//            'surname' => 'Tuleikis',
//            'password' => Hash::make('00555'),
//            'email' => 'Evaldas.tuleikis@gmail.com'
//        ]);
        User::factory(9)->create();

        $regions = [
            'Klaipėda',
            'Telšiai',
            'Šiauliai',
            'Panevėžys',
            'Utena',
            'Tauragė',
            'Kaunas',
            'Marijampolė',
            'Vilnius',
            'Alytus'
        ];
        for ($i=0; $i < count($regions); $i++) {
            Region::factory()->create(['name' => $regions[$i]]);
        }

        $lakes = [
            ["name" => "Kalotės ežeras", "region_id" => 1],
            ["name" => "Mumlaukio ežeras", "region_id" => 1],
            ["name" => "Trinyčių ežeras", "region_id" => 1],
            ["name" => "Laukžemių tvenkinys", "region_id" => 1],
            ["name" => "Malūno tvenkinys", "region_id" => 1],
            ["name" => "Plocio ežeras", "region_id" => 1],

            ["name" => "Masčio ežeras", "region_id" => 2],
            ["name" => "Ilgio ežeras", "region_id" => 2],
            ["name" => "Durbino ežeras", "region_id" => 2],
            ["name" => "Germanto ežeras", "region_id" => 2],
            ["name" => "Tausalo ežeras", "region_id" => 2],
            ["name" => "Gelžio ežeras", "region_id" => 2],
            ["name" => "Kurmio ežeras", "region_id" => 2],
            ["name" => "Šekščio ežeras", "region_id" => 2],

            ["name" => "Rėkyvos ežeras", "region_id" => 3],
            ["name" => "Talkšos ežeras", "region_id" => 3],
            ["name" => "Ginkūnų ežeras", "region_id" => 3],
            ["name" => "Kairių ežeras", "region_id" => 3],
            ["name" => "Prūdelio ežeras", "region_id" => 3],
            ["name" => "Švedės tvenkinys", "region_id" => 3],
            ["name" => "Gudelių ežeras", "region_id" => 3],
            ["name" => "Šilų tvenkinys", "region_id" => 3],
            ["name" => "Pailių tvenkinys", "region_id" => 3],
            ["name" => "Bijotės ežeras", "region_id" => 3],
            ["name" => "Bubių tvenkinys", "region_id" => 3],
            ["name" => "Geluvos ežeras", "region_id" => 3],

            ["name" => "Paežerio ežeras", "region_id" => 4],
            ["name" => "Nevėžio senvagės ežeras", "region_id" => 4],
            ["name" => "Panevėžio senvagės tvenkinys", "region_id" => 4],
            ["name" => "Pukiškio ežeras", "region_id" => 4],
            ["name" => "Liberiškio tvenkinys", "region_id" => 4],
            ["name" => "Pašilių ežeras", "region_id" => 4],
            ["name" => "Juodžio ežeras", "region_id" => 4],
            ["name" => "Paviešečių tvenkinys", "region_id" => 4],
            ["name" => "Pilvino ežeras", "region_id" => 4],
            ["name" => "Glitėno ežeras", "region_id" => 4],
            ["name" => "Vėjeliškių ežeras", "region_id" => 4],
            ["name" => "Staniūnų tvenkinys", "region_id" => 4],

            ["name" => "Vyžuonaičio ežeras", "region_id" => 5],
            ["name" => "Kigelio ežeras", "region_id" => 5],
            ["name" => "Kigio ežeras", "region_id" => 5],
            ["name" => "Klykių ežeras", "region_id" => 5],
            ["name" => "Lukno ežeras", "region_id" => 5],
            ["name" => "Šeduikių ežeras", "region_id" => 5],
            ["name" => "Raudžio ežeras", "region_id" => 5],
            ["name" => "Ilgio ežeras", "region_id" => 5],
            ["name" => "Vėdurinis ežeras", "region_id" => 5],

            ["name" => "Zumpės tvenkinys", "region_id" => 6],
            ["name" => "Tauragės tvenkinys", "region_id" => 6],
            ["name" => "Draudenių ežeras", "region_id" => 6],
            ["name" => "Šilinio ežeras", "region_id" => 6],
            ["name" => "Buveinių ežeras", "region_id" => 6],
            ["name" => "Gličio ežeras", "region_id" => 6],
            ["name" => "Dargaičių tvenkinys", "region_id" => 6],

            ["name" => "Lampėdžio ežeras", "region_id" => 7],
            ["name" => "Didysis ežeras", "region_id" => 7],
            ["name" => "Dvaro ežeras", "region_id" => 7],
            ["name" => "Dobilijos ežeras", "region_id" => 7],
            ["name" => "Kauno HE tvenkinys", "region_id" => 7],
            ["name" => "Paežerojaus ežeras", "region_id" => 7],
            ["name" => "Ešerinės ežeras", "region_id" => 7],
            ["name" => "Kauno marių ežeras", "region_id" => 7],
            ["name" => "Pociūnų tvenkinys", "region_id" => 7],
            ["name" => "Romainių tvenkinys", "region_id" => 7],

            ["name" => "Marijampolės tvenkinys", "region_id" => 8],
            ["name" => "Liudvinavo ežeras", "region_id" => 8],
            ["name" => "Leiciškių ežeras", "region_id" => 8],
            ["name" => "Kalnynų ežeras", "region_id" => 8],
            ["name" => "Netičkampio tvenkinys", "region_id" => 8],
            ["name" => "Žaltyčio ežeras", "region_id" => 8],
            ["name" => "Amalvo ežeras", "region_id" => 8],
            ["name" => "Stebuliškių tvenkinys", "region_id" => 8],
            ["name" => "Vasakų ežeras", "region_id" => 8],
            ["name" => "Žervyno ežeras", "region_id" => 8],

            ["name" => "Žalieji ežerai", "region_id" => 9],
            ["name" => "Tapelių ežeras", "region_id" => 9],
            ["name" => "Balsio ežeras", "region_id" => 9],
            ["name" => "Balžio ežeras", "region_id" => 9],
            ["name" => "Gelūžės ežeras", "region_id" => 9],
            ["name" => "Gulbino ežeras", "region_id" => 9],
            ["name" => "Antavilio ežeras", "region_id" => 9],
            ["name" => "Pupojų ežeras", "region_id" => 9],
            ["name" => "Gineitiškių ežeras", "region_id" => 9],
            ["name" => "Juodžio ežeras", "region_id" => 9],
            ["name" => "Salotės ežeras", "region_id" => 9],
            ["name" => "Skarbelio ežeras", "region_id" => 9],

            ["name" => "Ūdrijos ežeras", "region_id" => 10],
            ["name" => "Luksnėnų ežeras", "region_id" => 10],
            ["name" => "Dailidės ežeras", "region_id" => 10],
            ["name" => "Radžiūnų ežeras", "region_id" => 10],
            ["name" => "Likiškėlių ežeras", "region_id" => 10],
            ["name" => "Ilgio ežeras", "region_id" => 10],
            ["name" => "Gudelių ežeras", "region_id" => 10],
            ["name" => "Talokių ežeras", "region_id" => 10],
            ["name" => "Kavalio ežeras", "region_id" => 10],
            ["name" => "Alovės ežeras", "region_id" => 10],


        ];
        for ($i=0; $i < count($lakes); $i++) {
            Lake::factory()->create($lakes[$i]);
        }
//        Lake::factory(20)->create();
        Ticket::factory(40)->create();
    }
}
