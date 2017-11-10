<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'role', 'last_visit_time'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Check if user is Student or not
     *
     * @return mixed
     */
    public function isStudent(){
        return $this->role == 'student';
    }

    /**
     * Check if user is Admin or not
     *
     * @return mixed
     */
    public function isAdmin(){
        return $this->role == 'admin';
    }


    /**
     * User has one relationship with Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function student()
    {
        return $this->hasOne('App\Models\Student');
    }
}
