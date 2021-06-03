<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    public function index(){
        return view('Front.index');
    }

    public function dashboard(){
        $user = User::all();

        return view('Back.Dashboard.dashboard',compact('user'));
    }
}
