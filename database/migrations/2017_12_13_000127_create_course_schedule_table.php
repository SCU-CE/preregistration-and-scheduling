<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('semester_id')->unsigned()->index();
            $table->integer('course_id')->unsigned();
            $table->integer('group_number');
            $table->integer('instructor_id')->unsigned();
            $table->string('course_color');
            $table->string('weekday_1');
            $table->string('classroom_1')->nullable();
            $table->time('start_time_1');
            $table->time('end_time_1');
            $table->string('weekday_2')->nullable();
            $table->string('classroom_2')->nullable();
            $table->time('start_time_2')->nullable();
            $table->time('end_time_2')->nullable();
            $table->string('exam_date')->nullable();
            $table->string('exam_date_unix')->nullable();
            $table->time('exam_time')->nullable();
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('instructor_id')->references('id')->on('instructors')->onDelete('cascade');
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
        Schema::dropIfExists('course_schedule');
    }
}
