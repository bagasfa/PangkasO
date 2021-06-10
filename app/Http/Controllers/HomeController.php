<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\History;
use App\User;

class HomeController extends Controller
{
    public function index(){
        //Delete History 30 Hari Sekali 
        History::where('created_at', '<', Carbon::now()->subDays(30))->delete();

        return view('Front.index');
    }

    public function adminDashboard(){
        $user = User::all();

        return view('Back.Dashboard.dashboard',compact('user'));
    }

    public function ownerDashboard(){
        $user = User::all();

        return view('Back.Dashboard.dashboard',compact('user'));
    }
}
