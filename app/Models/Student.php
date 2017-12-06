<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    protected $fillable = [
        'student_id', 'first_name', 'last_name', 'entry_year',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function courses()
    {
        return $this->belongsToMany('App\Models\Course')->withTimestamps();
    }
    public function semesters()
    {
        return $this->belongsToMany('App\Models\Semester', 'course_student');
    }
    public function passed_course($id)
    {
        return DB::table('course_student')->where('student_id', $this->id)->where('course_id', $id)->where('semester_id', 1)->count() > 0;
    }
}
