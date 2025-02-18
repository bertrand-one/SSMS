<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Users;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    public function index(){
        $courses = Courses::with('users') 
            ->whereHas('users', function ($query) { 
                $query->where('userId', session('user_id'));
            })
            ->get();

        $totalCourses = $courses->count();

        return view('courses', compact('courses', 'totalCourses'));
    }

    public function addcourse (Request $request){

        try{
            $userId = Session::get('user_id'); 

            $data = $request->merge(['userId' => $userId]);

            Courses::create($data->all());

            return back()->with('success','Course added successfully');

        } catch(\Exception $e){
            return back()->with('error','failed to add course! try again later.'.$e);
        }
    }
}
