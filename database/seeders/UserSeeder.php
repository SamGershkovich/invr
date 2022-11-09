<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Sharron Scollard",
            'role_id' => 1,
            'employee_number' => 11111,
            'password' => '$2y$10$xeqDYObRLb22EwBH7G7i5eBasgKFpABCkNlDqwcVi88VvajMlvTZe',
            'remember_token' => NULL,
        ]);         
        // DB::table('users')->insert([
        //     'name' => "Sam Gershkovich",
        //     'role_id' => 2,
        //     'employee_number' => 27301,
        //     'password' => '$2y$10$xeqDYObRLb22EwBH7G7i5eBasgKFpABCkNlDqwcVi88VvajMlvTZe',
        //     'remember_token' => NULL,
        // ]);        
        DB::table('users')->insert([
            'name' => "Joel Hagen",
            'role_id' => 3,
            'employee_number' => 33333,
            'password' => '$2y$10$xeqDYObRLb22EwBH7G7i5eBasgKFpABCkNlDqwcVi88VvajMlvTZe',
            'remember_token' => NULL,
        ]);        
        DB::table('users')->insert([
            'name' => "Joe Johnson",
            'role_id' => 4,
            'employee_number' => 44444,
            'password' => '$2y$10$xeqDYObRLb22EwBH7G7i5eBasgKFpABCkNlDqwcVi88VvajMlvTZe',
            'remember_token' => NULL,
        ]);         
    }
}
