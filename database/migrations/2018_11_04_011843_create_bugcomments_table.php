<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBugcommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bugcomments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('comment',500);
            $table->unsignedInteger('bug_id');
            $table->unsignedInteger('staff_id');
            $table->foreign('bug_id')->references('id')->on('bugs')->onDelete('cascade');
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
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
        Schema::dropIfExists('bugcomments');
    }
}
