<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Users;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            "UserName" => "required|unique:users|max:255",
            "password" => "required|min:5",
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try{
            Users::create([
               "UserName"=> $request->UserName,
               "password"=> Hash::make($request->password),
            ]);

            return redirect()->route("login")->with('success','Account created successfully then login to your account');

        } catch(\Exception $e){
            return back()->with('error','failed to create account! try again later.'.$e);
        }
    }

    public function login(Request $request){
        $credentials= Validator::make($request->all(),[
            "UserName"=>"required",
            "password"=>"required",
        ]);

        if($credentials->fails()){
            return back()->withErrors($credentials);
        }

        $user = Users::where("UserName", $request->UserName)->first();
        
        if($user && Hash::check($request->password,$user->password)){
            Session::put('user_id', $user->userId);
            Session::put('username', $user->UserName);
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }
    
    }


    public function logout(Request $request)
    {
        Session::forget('user_id'); 
        Session::forget('username'); 

        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 

        return redirect('/login');
    }
}
