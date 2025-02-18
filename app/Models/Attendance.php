<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'studentId',
        'courseId',
        'attendanceDate',
        'attendanceStatus',
    ];

    public function students()
    {
        return $this->belongsTo(Students::class ,'studentId', 'studentId'); 
    }

    public function courses()
    {
        return $this->belongsTo(Courses::class ,'courseId', 'courseId'); 
    }
}
