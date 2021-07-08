<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use App\History;
use App\User;
use App\Barbershop;
use App\Hairstyle;
use App\Transaction;

class HomeController extends Controller
{
    public function index(){
        //Delete History 30 Hari Sekali 
        History::where('created_at', '<', Carbon::now()->subDays(30))->delete();

        $barbershop = Barbershop::whereNotNull('name')->limit(4)->get();
        $male = Hairstyle::where('gender','male')->orderBy('id','desc')->limit(4)->get();
        $female = Hairstyle::where('gender','female')->orderBy('id','desc')->limit(4)->get();

        return view('Front.home',compact('barbershop','male', 'female'));
    }

    public function search(Request $request){
        $data = Hairstyle::where('name', 'LIKE', '%'.$request->search.'%')->get();

        return view('Front.Hairstyle.search',compact('data'));
    }

    public function pendingCounter(){
        $data = Transaction::where('status','Pending')->where('user_id',auth()->user()->id)->count();

        if($data !=null){
            return response()->json([
                "message" => "Succes",
                "values" => $data,
            ]);
        }
        else{
            return response()->json([
                "message" => "Empty",
                'values' => "",
            ]);
        }
    }

    public function adminDashboard(){
        $user = User::all();
        $transaksi = Transaction::orderBy('id','desc')->get();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.Dashboard.dashboard',compact('user','transaksi'));
    }

    public function ownerDashboard(){
        $user = User::all();
        $uID = auth()->user()->id;
        $barber = Barbershop::where('owner_id',$uID)->first();
        $transaksi = Transaction::where('barbershop_id',$barber->id)
                                                                    ->where('status','Pending')
                                                                    ->where('status','Requested')
                                                                    ->where('status','Confirmed')
                                                                    ->orderBy('id','desc')->get();
        $layanan = Transaction::all();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.Dashboard.dashboard',compact('user','barber','transaksi','layanan'));
    }
}
