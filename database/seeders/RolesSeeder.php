<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("insert into roles(name) values ('Manager');
                    insert into roles(name) values ('Assitant Manager');
                    insert into roles(name) values ('Supervisor');
                    insert into roles(name) values ('Customer Service Rep.');");
    }
}
