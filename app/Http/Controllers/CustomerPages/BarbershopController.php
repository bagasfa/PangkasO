<?php

namespace App\Http\Controllers\CustomerPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Barbershop;
use App\Hairstyle;
use App\User;

class BarbershopController extends Controller
{
    public function url($url){
        $barbershop = Barbershop::where('url',$url)->get()->first();
        $user = User::where('id',$barbershop->owner_id)->first();
        $hairstyle = Hairstyle::where('barbershop_id',$barbershop->id)->get();

        return view('Front.Barbershop.home' ,compact('barbershop','hairstyle','user'));
    }

    public function barbershop(){
        $barbershop = Barbershop::whereNotNull('name')->orderBy('id','desc')->get();

        return view('Front.Barbershop.barbershop',compact('barbershop'));
    }
}
