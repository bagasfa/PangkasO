<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;
use App\Barbershop;
use App\Banner;
use App\History;
use File;

class BarbershopController extends Controller
{
    // Setting Barbershop Top Navbar
    public function setting(){
        $uID = auth()->user()->id;
        $barber = Barbershop::where('owner_id',$uID)->get()->first();
        $banner = Banner::where('barbershop_id',$barber->id)->get()->first();
        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.UserConfiguration.barberSetting',compact('barber','banner'));
    }

    // Setup Barbershop (First time setup)
    public function setup(){
        $uID = auth()->user()->id;
        $barber = Barbershop::where('owner_id',$uID)->get()->first();
        $banner = Banner::where('barbershop_id',$barber->id)->get()->first();
        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.UserConfiguration.setup',compact('barber','banner'));
    }

    // Update Barbershop Data
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
            'address.required' => 'Kolom Alamat tidak boleh kosong!',
        );

        $validateData = $request->validate([
            'banner' => 'image|mimes:jpeg,png,jpg|max:4096',
            'name' => 'required|unique:barbershop,name,'.$barber->id,
            'phone_number' => 'required|unique:barbershop,phone_number,'.$barber->id,
            'address' => 'required'
        ],$messages);

        
        if($request->service_preferences != NULL){
            $barber->service_preferences = $request->service_preferences;
        }
        $barber->name = $request->name;
        $barber->phone_number = $request->phone_number;
        $barber->address = $request->address;
        $barber->url = strtolower($request->name);
        $barber->latitude = $request->lat;
        $barber->longitude = $request->long;
        $barber->save();

        if($request->banner != NULL){
            $upBanner = $barber->id.'-'.date('dmYhis').'.'.$request->banner->getClientOriginalExtension();
            $request->banner->move('assets/images/barbershop/banner/',$upBanner);

            $banner->picture = $upBanner;
            $banner->save();
        }

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Edit";
        $history->keterangan = "Akun '".auth()->user()->name."' mengubah data Barbershopnya.";
        $history->save();

        return redirect('owner-panel/dashboard')->with('success','Berhasil memperbarui data Barbershop');
    }

    // Banner Things
    public function banner(){
        $uID = auth()->user()->id;
        $barber = Barbershop::where('owner_id',$uID)->get()->first();
        $banner = Banner::where('barbershop_id',$barber->id)->get()->first();
        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.BarbershopManagement.banner',compact('barber','banner'));
    }

    public function bannerUpdate(Request $request){
        $uID = auth()->user()->id;
        $barber = Barbershop::where('owner_id',$uID)->get()->first();
        $banner = Banner::where('barbershop_id',$barber->id)->get()->first();

        $upBanner = $barber->id.'-'.date('dmYhis').'.'.$request->banner->getClientOriginalExtension();
        $request->banner->move('assets/images/barbershop/banner/',$upBanner);
        File::delete('assets/images/barbershop/banner/'.$banner->picture);

        $banner->picture = $upBanner;
        $banner->save();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Edit";
        $history->keterangan = "Akun '".auth()->user()->name."' mengubah Banner Barbershopnya.";
        $history->save();

        return redirect('owner-panel/banner')->with('success','Berhasil memperbarui Banner');
    }

    // Service Preference Things
    public function servicePref(){
        $uID = auth()->user()->id;
        $barber = Barbershop::where('owner_id',$uID)->get()->first();
        $banner = Banner::where('barbershop_id',$barber->id)->get()->first();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.BarbershopManagement.servicePref',compact('barber','banner'));
    }

    public function servicePrefUpdate(Request $request){
        $uID = auth()->user()->id;
        $barber = Barbershop::where('owner_id',$uID)->get()->first();

        $barber->service_preferences = $request->service_preferences;
        $barber->save();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Edit";
        $history->keterangan = "Akun '".auth()->user()->name."' mengubah Jenis Pelayanannya.";
        $history->save();

        return redirect('/owner-panel/service-pref')->with('success','Berhasil Mengganti Jenis Pelayanan');
    }
}
