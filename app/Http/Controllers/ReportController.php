<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Courses;

class ReportController extends Controller
{
    public function index(){
        $courses = Courses::with('users') 
        ->whereHas('users', function ($query) { 
            $query->where('userId', session('user_id'));
        })->get();

        $attendance = Attendance::with('students','courses') 
            ->whereHas('students', function ($query) { 
                $query->where('userId', session('user_id'));
            })
            ->get();

            return view('reports', compact('attendance','courses'));
    }

    public function generate(Request $request){
        $courses = Courses::with('users') 
        ->whereHas('users', function ($query) { 
            $query->where('userId', session('user_id'));
        })->get();

        $courseId = $request->courseId;
        $date = $request->date;

        $attendance = Attendance::with('students','courses') 
            ->whereHas('students', function ($query) use ($courseId) { 
                $query->where('userId', session('user_id'));
            })
            ->where('courseId', $courseId)
            ->where('attendanceDate', $date)
            ->get();

        return view('reports', compact('attendance','courses'));
    }
}
