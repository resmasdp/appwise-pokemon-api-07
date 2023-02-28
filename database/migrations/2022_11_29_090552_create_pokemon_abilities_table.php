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
        Schema::create('pokemon_abilities', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('pokemon_id')->unsigned();
            $table->bigInteger('ability_id')->unsigned();

            $table->timestamps();
        });

        Schema::table('pokemon_abilities', function (Blueprint $table) {
            $table->foreignId('pokemon_id')->constrained();
            $table->foreignId('ability_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pokemon_abilities');
    }
};
