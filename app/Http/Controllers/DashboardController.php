<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Courses;
use App\Models\Grades;
use App\Models\Students;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $students = Students::with('users') 
            ->whereHas('users', function ($query) { 
                $query->where('userId', session('user_id'));
            })
            ->get();
        $totalStudents = $students->count();
        
        $courses = Courses::with('users') 
            ->whereHas('users', function ($query) { 
                $query->where('userId', session('user_id'));
            })
            ->get();    
        $totalCourses = $courses->count();

        $today = Carbon::today()->toDateString();

        $attendance = Attendance::with('students') 
            ->whereHas('students', function ($query) { 
                $query->where('userId', session('user_id'));
            })
            ->where('attendanceDate', $today)
            ->get();

            $present = Attendance::with('students') 
            ->whereHas('students', function ($query) { 
                $query->where('userId', session('user_id'));
            })
            ->where('attendanceDate', $today)
            ->where('attendanceStatus', 'present')
            ->get();
        $totalpresent = $present->count();    
        $totalAttendance = $attendance->count();  
        
        $attendanceRate = ($totalpresent / $totalAttendance) * 100;





        $grades = Grades::with('students') 
            ->whereHas('students', function ($query) { 
                $query->where('userId', session('user_id'));
            })
            ->where('examDate', $today)
            ->get();

            $won = Grades::with('students') 
            ->whereHas('students', function ($query) { 
                $query->where('userId', session('user_id'));
            })
            ->where('examDate', $today)
            ->where('grade', 'A')
            ->get();
        $totalWon = $won->count();    
        $totalGrades = $grades->count();  
        
        $attendanceRate = ($totalpresent / $totalAttendance) * 100;
        $gradesRate = ($totalWon / $totalGrades) * 100;

        return view('dashboard', compact('totalStudents','totalCourses','attendanceRate','gradesRate'));
    }
}
