<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemon_moves', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('pokemon_id')->unsigned();
            $table->bigInteger('move_id')->unsigned();

            $table->timestamps();
        });

        Schema::table('pokemon_moves', function (Blueprint $table) {
            $table->foreign('pokemon_id')
                ->references('id')
                ->on('pokemon')
                ->cascadeOnDelete();

            $table->foreignId('move_id')
                ->references('id')
                ->on('moves')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pokemon_moves');
    }
};
