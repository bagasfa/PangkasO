<?php

namespace App\Http\Controllers\CustomerPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Barbershop;
use App\Hairstyle;

class HairstyleController extends Controller
{
    public function hairstyle(){
        $hairstyle = Hairstyle::orderBy('id','desc')->get();

        return view('Front.Hairstyle.hairstyle', compact('hairstyle'));
    }

    public function maleHairstyle(){
        $hairstyle = Hairstyle::where('gender','male')->orderBy('id','desc')->get();
        
        return view('Front.Hairstyle.male', compact('hairstyle'));
    }

    public function femaleHairstyle(){
        $hairstyle = Hairstyle::where('gender','female')->orderBy('id','desc')->get();
        
        return view('Front.Hairstyle.female', compact('hairstyle'));
    }

    public function selectedHairstyle($url,$id){
        $barbershop = Barbershop::where('url',$url)->first();
        $hairstyle = Hairstyle::where('id',$id)->first();

        return view('Front.Hairstyle.detail',compact('barbershop','hairstyle'));
    }
}
