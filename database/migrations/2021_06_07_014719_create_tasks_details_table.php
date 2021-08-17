<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        if(!Schema::hasTable('tasks_details')){

        Schema::create('tasks_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_task');
            $table->string('refNum', 255);
            $table->foreign('id_task')->references('id')->on('tasks')->onDelete('cascade');
            $table->string('ssname',255);
            $table->string('Work_type', 255)->nullable();;
            $table->date('task_Date')->nullable();
            $table->string('equip',255)->nullable();
            $table->string('problem',255)->nullable();
            $table->date('report_date')->nullable();
            $table->string('eng_name',255)->nullable();
            $table->string('notes',255)->nullable();
            $table->string('status',255);
            $table->string('action_take',255);
            $table->string('user',300);
            $table->string('reason',255);
            $table->string('add_more',255);
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
        Schema::dropIfExists('tasks_details');
    }
}