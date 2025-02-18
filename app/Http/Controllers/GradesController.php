<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Courses;
use App\Models\Grades;
use Carbon\Carbon;

class GradesController extends Controller
{
    public function index($id){ 
        $course = Courses::where('courseId', $id)->get();

        $students = Students::with('users') 
            ->whereHas('users', function ($query) { 
                $query->where('userId', session('user_id'));
            })
            ->get();

        $grades = Grades::with('students') 
            ->whereHas('students', function ($query) { 
                $query->where('userId', session('user_id'));
            })
            ->where('courseId', $id)
            ->get();    

        $totalStudents = $students->count();   

        return view('grades', compact('students','totalStudents','course','grades'));
    }

    public function store(Request $request)
    {
        $gradesData = $request->input('grade');
        $courseId = $request->input('courseId');
        $date = Carbon::today()->toDateString();

        foreach ($gradesData as $studentId => $grade) {
            Grades::create([
            "studentId" => $studentId,
            "courseId" => $courseId,
            "examDate" => $date,
            "grade" => $grade,
            ]);
        }

        return redirect('/grades/' . $courseId)->with('success', 'Grades recorded successfully!'); 
    }
}
