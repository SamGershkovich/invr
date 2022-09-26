<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->integer('updated_by');
            $table->integer('product_id');
            $table->integer('inventory_date');
            $table->decimal('front_quantity', 8, 2)->default(0);
            $table->decimal('back_quantity', 8, 2)->default(0);
            $table->boolean('front_perpetual')->default(false);
            $table->boolean('back_perpetual')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
