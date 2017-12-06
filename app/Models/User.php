<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'email', 'password', 'role', 'last_visit_time'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function isStudent(){
        return $this->role == 'student';
    }
    public function isAdmin(){
        return $this->role == 'admin';
    }
    public function student()
    {
        return $this->hasOne('App\Models\Student');
    }
}
