<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use App\User;
use App\Barbershop;
use App\History;
use DB;
use File;
use DataTables;

class BarbershopController extends Controller
{   
    // Admin Panel Things
    public function barbershop(){
        $counter = Barbershop::whereNotNull('name')->count();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.UsersManagement.BarbershopData.barbershop', compact('counter'));
    }

    public function LoadTableBarbershop(){
        return view('Back.DataTables.UsersManagement.BarbershopDatatable');
    }

    public function LoadDataBarbershop(){
        $barbershop = DB::table('barbershop')
            ->join('users', 'barbershop.owner_id', '=', 'users.id')
            ->select('barbershop.*', 'users.name AS username')
            ->whereNotNull('barbershop.name')
            ->orderBy('id','desc')
            ->get();

            return Datatables::of($barbershop)->addIndexColumn()
            ->editColumn('created_at', function($barbershop){
                return Carbon::parse($barbershop->created_at)->diffForHumans();
            })
            ->make(true);
    }
    // End of Admin Panel Things


    // Owner Panel Things
    // Setting Barbershop Top Navbar
    public function setting(){
        $uID = auth()->user()->id;
        $barber = Barbershop::where('owner_id',$uID)->get()->first();
        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.UserConfiguration.barberSetting',compact('barber'));
    }

    // Setup Barbershop (First time setup)
    public function setup(){
        $uID = auth()->user()->id;
        $barber = Barbershop::where('owner_id',$uID)->get()->first();
        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.UserConfiguration.setup',compact('barber'));
    }

    // Update Barbershop Data
    public function update(Request $request){
        $uID = auth()->user()->id;
        $barber = Barbershop::where('owner_id',$uID)->get()->first();

        $messages = array(
            'name.required' => 'Kolom Nama Barbershop tidak boleh kosong!',
            'name.unique' => 'Nama Barbershop sudah digunakan!',
            'banner.max' => 'Ukuran gambar anda melebihi 4MB!',
            'phone_number.required' => 'Kolom Nomor Telpon tidak boleh kosong!',
            'phone_number.unique' => 'Nomor sudah digunakan!',
            'address.required' => 'Kolom Alamat tidak boleh kosong!',
        );

        $validateData = $request->validate([
            'banner' => 'image|max:4096',
            'name' => 'required|unique:barbershop,name,'.$barber->id,
            'phone_number' => 'required|unique:barbershop,phone_number,'.$barber->id,
            'address' => 'required'
        ],$messages);

        if($request->banner != NULL){
            $upBanner = $barber->id.'-'.date('dmYhis').'.'.$request->banner->getClientOriginalExtension();
            $request->banner->move('assets/images/barbershop/banner/',$upBanner);

            $barber->banner = $upBanner;
        }

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
        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.BarbershopManagement.banner',compact('barber'));
    }

    public function bannerUpdate(Request $request){
        $uID = auth()->user()->id;
        $barber = Barbershop::where('owner_id',$uID)->get()->first();

        $upBanner = $barber->id.'-'.date('dmYhis').'.'.$request->banner->getClientOriginalExtension();
        $request->banner->move('assets/images/barbershop/banner/',$upBanner);
        File::delete('assets/images/barbershop/banner/'.$barber->banner);

        $barber->banner = $upBanner;
        $barber->save();

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

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.BarbershopManagement.servicePref',compact('barber'));
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
    // End of Owner Panel Things
}
