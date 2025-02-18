<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Users;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    public function index(){
        $students = Students::with('users') 
            ->whereHas('users', function ($query) { 
                $query->where('userId', session('user_id'));
            })
            ->get();

        $totalStudents = $students->count();

        return view('students', compact('students', 'totalStudents'));
    }
    public function addstudent (Request $request){

        try{
            $userId = Session::get('user_id'); 

            $data = $request->merge(['userId' => $userId]);

            Students::create($data->all());

            return back()->with('success','Student added successfully');

        } catch(\Exception $e){
            return back()->with('error','failed to add student! try again later.'.$e);
        }
    }
}
