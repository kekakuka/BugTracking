<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->enum('status', ['waiting','pass','failed','testing','closed'])->default('waiting');
            $table->enum('classification', ['manual','automatic'])->default('manual');
            $table->double('planTime',4,1)->default(0);
            $table->double('costTime',4,1)->nullable();
            $table->string('description',500)->nullable();
            $table->unsignedInteger('testcase_id');
            $table->unsignedInteger('setting_id');
            $table->unsignedInteger('staff_id')->nullable();
            $table->unsignedInteger('testsuite_id')->nullable()->default(null);
            $table->foreign('testsuite_id')->references('id')->on('testsuites');
            $table->foreign('testcase_id')->references('id')->on('testcases');
            $table->foreign('staff_id')->references('id')->on('staff');
            $table->foreign('setting_id')->references('id')->on('settings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
