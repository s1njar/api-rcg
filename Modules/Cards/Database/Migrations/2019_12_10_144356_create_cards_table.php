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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->integer('life');
            $table->integer('moral');
            $table->integer('strength');
            $table->integer('speed');
            $table->integer('range');
            $table->string('image');
            $table->unsignedBigInteger('card_type_id')->nullable();
            $table->unsignedBigInteger('rarity_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->integer('status')->default(1);

            $table->foreign('card_type_id')
                ->references('id')
                ->on('card_types')
                ->onDelete('cascade');
            $table->foreign('rarity_id')
                ->references('id')
                ->on('rarities')
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
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
