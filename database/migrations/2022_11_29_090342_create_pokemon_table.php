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
        $directions = ['front', 'back'];
        $sprites = ['default', 'female', 'shiny', 'shiny_female'];

        Schema::create('pokemon', function (Blueprint $table) use($directions, $sprites) {
            $table->id();

            $table->string('name');

            //eerder dirty dan wat anders
            foreach($directions as $direction) {
                foreach($sprites as $sprite) {
                    $table->string("{$direction}_{$sprite}")->nullable();
                }
            }

            $table->integer('height');
            $table->integer('weight');

            $table->integer('order');

            $table->string('species');
            $table->string('form');

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
        Schema::dropIfExists('pokemon');
    }
};
