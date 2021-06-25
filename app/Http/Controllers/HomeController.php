<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use App\History;
use App\User;
use App\Barbershop;

class HomeController extends Controller
{
    public function index(){
        //Delete History 30 Hari Sekali 
        History::where('created_at', '<', Carbon::now()->subDays(30))->delete();

        return view('Front.index');
    }

    public function adminDashboard(){
        $user = User::all();
        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.Dashboard.dashboard',compact('user'));
    }

    public function ownerDashboard(){
        $user = User::all();
        $uID = auth()->user()->id;
        $barber = Barbershop::select('name')->where('owner_id',$uID)->get()->first();
        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.Dashboard.dashboard',compact('user','barber'));
    }
}
