<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function StudentHome(){
        return view('student.home');
    }

    public function StudentProfile(){
        return view('student.profile');
    }

    public function StudentApplication(){
        return view('student.my-application');
    }
}
