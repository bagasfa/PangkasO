<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Barbershop;
use App\Banner;

class BarbershopController extends Controller
{
    public function setup(){
        $uID = auth()->user()->id;
        $barber = Barbershop::where('owner_id',$uID)->get()->first();
        $banner = Banner::where('barbershop_id',$barber->id)->get()->first();

        return view('Back.UserConfiguration.setup',compact('barber','banner'));
    }

    public function update(Request $request){
        $uID = auth()->user()->id;
        $barber = Barbershop::where('owner_id',$uID)->get()->first();
        $banner = Banner::where('barbershop_id',$barber->id)->get()->first();

        $messages = array(
            'name.required' => 'Kolom Nama Barbershop tidak boleh kosong!',
            'name.unique' => 'Nama Barbershop sudah digunakan!',
            'banner.mimes' => 'Mohon gunakan format gambar : .jpeg | .jpg | .png',
            'banner.max' => 'Ukuran gambar anda melebihi 4MB!',
            'phone_number.required' => 'Kolom Nomor Telpon tidak boleh kosong!',
            'phone_number.unique' => 'Nomor sudah digunakan!',
            'service_preferences.required' => 'Kolom Jenis Pelayanan tidak boleh kosong!',
            'address.required' => 'Kolom Alamat tidak boleh kosong!',
        );

        $validateData = $request->validate([
            'banner' => 'image|mimes:jpeg,png,jpg|max:4096',
            'name' => 'required|unique:barbershop,name',
            'service_preferences' => 'required',
            'phone_number' => 'required|unique:barbershop,phone_number',
            'address' => 'required'
        ],$messages);

        $upBanner = $request->name.'-'.date('dmYhis').'.'.$request->banner->getClientOriginalExtension();
        $request->banner->move('assets/images/barbershop/banner/', $upBanner);

        $barber->name = $request->name;
        $barber->service_preferences = $request->service_preferences;
        $barber->phone_number = $request->phone_number;
        $barber->address = $request->address;
        $barber->save();

        $banner->picture = $upBanner;
        $banner->save();

        return redirect('owner-panel/dashboard')->with('success','Berhasil melengkapi data Barbershop');
    }
}
