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
        Schema::create('move_version_groups', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('version_group_id')->unsigned();
            $table->bigInteger('move_id')->unsigned();

            $table->timestamps();
        });

        Schema::table('move_version_groups', function (Blueprint $table) {
            $table->foreignId('version_group_id')->constrained();
            $table->foreignId('move_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moves');
    }
};
