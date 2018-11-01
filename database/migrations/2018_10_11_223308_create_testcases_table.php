<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestcasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testcases', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('description',500)->nullable();
            $table->string('name',100);
            $table->unsignedInteger('usecase_id');
            $table->foreign('usecase_id')->references('id')->on('usecases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testcases');
    }
}
