<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBugassignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bugassigns', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('bug_id');
            $table->unsignedInteger('staff_id');
            $table->foreign('bug_id')->references('id')->on('bugs');
            $table->foreign('staff_id')->references('id')->on('staff');
            $table->enum('status', ['assigned','finished'])->default('assigned');
            $table->double('costTime',4,1)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bugassigns');
    }
}
