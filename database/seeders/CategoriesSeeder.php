<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("insert into categories(id, name) values (97, 'Department');
                    insert into categories(id, name) values (10007, 'Not Defined');
                    insert into categories(id, name) values (10029, 'Frozen');
                    insert into categories(id, name) values (10042, 'Nuts');
                    insert into categories(id, name) values (10236, 'Cut Fruit/Veg');
                    insert into categories(id, name) values (10265, 'Melon');
                    insert into categories(id, name) values (10280, 'Squash');
                    insert into categories(id, name) values (10352, 'Reduction');
                    insert into categories(id, name) values (10384, 'Berries-Fruit');
                    insert into categories(id, name) values (10389, 'Root Veg');
                    insert into categories(id, name) values (10390, 'Summer Veg');
                    insert into categories(id, name) values (10391, 'Winter Veg');
                    insert into categories(id, name) values (10445, 'Citrus');
                    insert into categories(id, name) values (10446, 'Exotic');
                    insert into categories(id, name) values (10447, 'Tree Fruit');
                    insert into categories(id, name) values (10448, 'Tropical Fruit');
                    insert into categories(id, name) values (10449, 'Stone Fruit');
                    insert into categories(id, name) values (10478, 'Tropical')");
    }
}
