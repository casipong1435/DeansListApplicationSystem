<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminHome(){
        return view('admin.home');
    }

    public function AdminAccount(){
        return view('admin.account');
    }

    public function AdminPrograms(){
        return view('admin.programs');
    }
}
