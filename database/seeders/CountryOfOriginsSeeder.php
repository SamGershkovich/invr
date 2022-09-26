<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryOfOriginsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("insert into country_of_origins(id, name) values (1, 'belgium');
                        insert into country_of_origins(id, name) values (2, 'brazil');
                        insert into country_of_origins(id, name) values (3, 'canada');
                        insert into country_of_origins(id, name) values (4, 'china');
                        insert into country_of_origins(id, name) values (5, 'costa rica');
                        insert into country_of_origins(id, name) values (6, 'dominican republic');
                        insert into country_of_origins(id, name) values (7, 'greece');
                        insert into country_of_origins(id, name) values (8, 'guatemala');
                        insert into country_of_origins(id, name) values (9, 'honduras');
                        insert into country_of_origins(id, name) values (10, 'iran');
                        insert into country_of_origins(id, name) values (11, 'italy');
                        insert into country_of_origins(id, name) values (12, 'mexico');
                        insert into country_of_origins(id, name) values (13, 'mexico/usa');
                        insert into country_of_origins(id, name) values (14, 'peru');
                        insert into country_of_origins(id, name) values (15, 'south africa');
                        insert into country_of_origins(id, name) values (16, 'spain');
                        insert into country_of_origins(id, name) values (17, 'usa');
                        insert into country_of_origins(id, name) values (18, 'vietnam');
                        insert into country_of_origins(id, name) values (0, '<no entry>');
                        insert into country_of_origins(id, name) values (19, 'chile');
                        insert into country_of_origins(id, name) values (20, 'serbia');
                        insert into country_of_origins(id, name) values (21, 'netherlands');
                        insert into country_of_origins(id, name) values (22, 'uk');
                        insert into country_of_origins(id, name) values (23, 'israel');
                        insert into country_of_origins(id, name) values (24, 'new zealand');
                        insert into country_of_origins(id, name) values (25, 'new zealand/costa rica');
                        insert into country_of_origins(id, name) values (26, 'new zealand/usa')");
    }
}
