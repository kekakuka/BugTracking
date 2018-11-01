<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsecasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usecases', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('description',500)->nullable();
            $table->string('name',100);
            $table->unsignedInteger('subsystem_id');
            $table->foreign('subsystem_id')->references('id')->on('subsystems');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usecases');
    }
}
