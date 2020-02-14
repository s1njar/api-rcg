<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('ability');
            $table->integer('type');
            $table->integer('target');
            $table->char('calc_operator');
            $table->integer('calc_value');
            $table->integer('range');
            $table->string('target_attribute')->nullable();
            $table->integer('target_card_type')->nullable();
            $table->integer('source_rarity')->nullable();
            $table->integer('source_card_type')->nullable();

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
        Schema::dropIfExists('abilities');
    }
}
