<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    protected $fillable = [
        'name', 'code', 'units', 'category', 'default_min_capacity_fall', 'default_min_capacity_spring'
    ];
    public function offered($semester)
    {
        return ($this->semesters()->find($semester->id) == null) ? false : true;
    }
    public function min_capacity($semester)
    {
        return DB::table('course_semester')->where('semester_id', $semester->id)->where('course_id', $this->id)->first()->min_capacity;
    }
    public function semesters()
    {
        return $this->belongsToMany('App\Models\Semester')->withTimestamps();
    }
    public function students($semester_id)
    {
        return $this->belongsToMany('App\Models\Student')->wherePivot('semester_id', $semester_id);;
    }
}
