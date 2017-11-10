<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'units', 'category', 'default_min_capacity_fall', 'default_min_capacity_spring'
    ];

    /**
     * Check if Course offered in a Semester or not
     *
     * @param $semester_id
     * @return bool
     */
    public function offered($semester_id)
    {
        return ($this->semesters()->find($semester_id) == null) ? false : true;
    }

    /**
     * Course has many relationship with Semester
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function semesters()
    {
        return $this->belongsToMany('App\Models\Semester')->withTimestamps();
    }

    /**
     * Course has many relationship with Student
     *
     * @param $semester_id
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students($semester_id)
    {
        return $this->belongsToMany('App\Models\Student')->wherePivot('semester_id', $semester_id);;
    }
}
