<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert([
            'name' => "Sam Gershkovich",
            'role_id' => 1,
            'employee_number' => 27301,
            'password' => '$2y$10$xeqDYObRLb22EwBH7G7i5eBasgKFpABCkNlDqwcVi88VvajMlvTZe',
            'remember_token' => NULL,
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
