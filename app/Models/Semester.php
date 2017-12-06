<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'semester', 'year',
    ];
    public function courses()
    {
        return $this->belongsToMany('App\Models\Course')->withTimestamps();
    }
    public function students()
    {
        return $this->belongsToMany('App\Models\Student', 'course_student');
    }
}
