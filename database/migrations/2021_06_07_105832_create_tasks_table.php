<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tasks')){
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('refNum', 255)->nullable();;
            $table->string('main_alarm', 255)->nullable();
            $table->string('Work_type', 255)->nullable();;
            $table->string('Voltage_level', 255)->nullable();
            $table->string('make', 255)->nullable();
            $table->string('pm', 255)->nullable();
            $table->date('task_Date')->nullable();
            $table->string('equip',255)->nullable();
            $table->unsignedBigInteger('eng_id')->unsigned();
            $table->unsignedBigInteger('station_id')->unsigned();
            $table->string('problem',255)->nullable();
            $table->foreign('eng_id')->references('id')->on('engineers');
            $table->foreign('station_id')->references('id')->on('stations');
            $table->string('notes',255)->nullable();
            $table->string('status',255)->nullable();
            $table->string('user',255)->nullable();
            $table->string('color',255)->nullable();
            $table->timestamps();
          });
         
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}