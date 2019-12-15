<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('cards', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('life');
            $table->integer('costs');
            $table->integer('abilities');
            $table->integer('strength');
            $table->integer('category');
            $table->string('picture');
            $table->unsignedBigInteger('cart_type_id');
            $table->unsignedBigInteger('rarity_id');

            $table->foreign('cart_type_id')
                ->references('id')
                ->on('card_types')
                ->onDelete('cascade');
            $table->foreign('rarity_id')
                ->references('id')
                ->on('rarities')
                ->onDelete('cascade');

            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
