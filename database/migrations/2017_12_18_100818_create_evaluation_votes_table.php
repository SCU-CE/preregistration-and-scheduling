<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_votes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('evaluation_id')->unsigned()->index();
            $table->integer('student_id')->unsigned()->index();
            $table->integer('vote')->default(0);
            $table->foreign('evaluation_id')->references('id')->on('schedule_evaluation')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
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
        Schema::dropIfExists('evaluation_votes');
    }
}
