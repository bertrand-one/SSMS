<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Courses extends Model
{
    use HasFactory;

    protected $fillable = [
        "courseName",
        "courseDescription",
        "duration",
        "userId",
    ];

    public function users()
    {
        return $this->belongsTo(Users::class ,'userId', 'userId'); 
    }
}
