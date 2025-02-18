<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Students;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index($id){
        $course = Courses::where('courseId', $id)->get();

        $students = Students::with('users') 
            ->whereHas('users', function ($query) { 
                $query->where('userId', session('user_id'));
            })
            ->get();
        
        $attendance = Attendance::with('students','courses') 
            ->whereHas('students', function ($query) { 
                $query->where('userId', session('user_id'));
            })
            ->where('courseId', $id)
            ->get();    

        $totalStudents = $students->count();    

        return view('attendance', compact('course', 'students','totalStudents','attendance'));
    }

    public function store(Request $request)
    {
        $attendanceData = $request->input('attendanceStatus');
        $courseId = $request->input('courseId');
        $date = Carbon::today()->toDateString();

        foreach ($attendanceData as $studentId => $status) {
            Attendance::create([
            "studentId" => $studentId,
            "courseId" => $courseId,
            "attendanceDate" => $date,
            "attendanceStatus" => $status,
            ]);
        }

        return redirect('/attendance/' . $courseId)->with('success', 'Attendance recorded successfully!'); 
    }
}
