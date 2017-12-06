<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'type', 'message', 'state'
    ];
    protected $table = 'feedbacks';
}
