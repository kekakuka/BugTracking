<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bugs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->enum('state', ['open','rejected','assigned','test','reOpened','closed','deferred'])->default('open');
            $table->string('description',1000);
            $table->enum('severity', [1,2,3,4,5])->default(5);
            $table->enum('priority', [1,2,3,4,5])->default(5);
            $table->unsignedInteger('bugRPN')->storedAs('severity*priority');
            $table->date('estimatedFixDate')->nullable();
            $table->date('actualFixDate')->nullable();
            $table->enum('taxonomy', ['functional','system', 'process', 'data', 'code', 'documentation', 'standards', 'other', 'duplicate', 'NAP', 'badUnit', 'RCN', 'unknown'])->nullable();
            $table->unsignedInteger('test_id');
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bugs');
    }
}
