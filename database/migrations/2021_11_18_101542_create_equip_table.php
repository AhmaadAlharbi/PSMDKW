<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equip', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('station_id')->unsigned();
            $table->string('voltage-level',255)->nullable();
            $table->string('eqiup_number',255)->nullable();
            $table->string('equip_name',255)->nullable();
            $table->foreign('station_id')->references('id')->on('stations');
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
        Schema::dropIfExists('equip');
    }
}