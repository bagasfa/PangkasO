<?php

namespace App\Http\Controllers\CustomerPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Barbershop;
use App\Hairstyle;

class BarbershopController extends Controller
{
    public function url($url){
        $barbershop = Barbershop::where('url',$url)->get()->first();
        $hairstyle = Hairstyle::where('barbershop_id',$barbershop->id)->get();

        return view('Front.Barbershop.home' ,compact('barbershop','hairstyle'));
    }
}
