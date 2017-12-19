<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleEvaluationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_evaluation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('session_id')->unsigned()->index();
            $table->integer('schedule_id')->unsigned()->index();
            $table->integer('student_id')->unsigned()->index();
            $table->string('privacy');
            $table->string('suggested_weekday_1')->nullable();
            $table->time('suggested_start_time_1')->nullable();
            $table->time('suggested_end_time_1')->nullable();
            $table->string('suggestion_reason_1',250)->nullable();
            $table->string('suggested_weekday_2')->nullable();
            $table->time('suggested_start_time_2')->nullable();
            $table->time('suggested_end_time_2')->nullable();
            $table->string('suggestion_reason_2',250)->nullable();
            $table->string('suggested_exam_date')->nullable();
            $table->string('suggested_exam_date_unix')->nullable();
            $table->time('suggested_exam_time')->nullable();
            $table->string('exam_suggestion_reason',250)->nullable();
            $table->foreign('session_id')->references('id')->on('evaluation_sessions')->onDelete('cascade');
            $table->foreign('schedule_id')->references('id')->on('course_schedule')->onDelete('cascade');
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
        Schema::dropIfExists('schedule_evaluation');
    }
}
