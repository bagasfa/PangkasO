<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Identity;
use App\History;
use App\Barbershop;
use App\Hairstyle;
use File;
use Auth;

class AuthController extends Controller
{
    // Halaman Login
    public function login(){
        if(Auth::check()){
            return back();
        }else{
            return view('Auth.login');
        }
    }

    // Proses Login
    public function postLogin(Request $request){

        // Checking Email dan Password
        if(Auth::attempt($request->only('email','password'))){
            // Jika Berhasil Login
            $role = auth()->user()->id_role;
            // Superadmin, Admin, Owner Login
            if ($role == 1 || $role == 2 || $role == 3) {
                
                if($role == 1 || $role == 2){
                    $url = '/admin-panel/dashboard';
                }
                elseif($role == 3){
                    $url = '/owner-panel/dashboard';
                }

                // Get User Location by IP Address
                if ($position = Location::get()) {
                    // Writing History
                    $history = new History;
                    $history->user_id = auth()->user()->id;
                    $history->nama = auth()->user()->name;
                    $history->aksi = "Login";
                    $history->keterangan = "Lokasi login '".$position->cityName.", ".$position->regionName.", ".$position->countryName."' dengan IP address :'".$position->ip."'";
                    $history->save();
                }

                return redirect($url)->with('message', 'Welcome, '.auth()->user()->name);
            }
            // Customer Login
            elseif($role == 4){
                // Get User Location by IP Address
                if ($position = Location::get()) {
                    // Writing History
                    $history = new History;
                    $history->user_id = auth()->user()->id;
                    $history->nama = auth()->user()->name;
                    $history->aksi = "Login";
                    $history->keterangan = "Lokasi login '".$position->cityName.", ".$position->regionName.", ".$position->countryName."' dengan IP address :'".$position->ip."'";
                    $history->save();
                }

                return Redirect::to($request->request->get('http_referrer'))->with('message', 'Welcome, '.auth()->user()->name);
            }
        }
        // Email atau Password salah
        return redirect('/login')->with('bye', 'Email atau Password anda Salah!');
    }

    // Registrasi User Baru Sebagai Owner
    public function register(Request $request){
        $messages = array(
            'email.required' => 'Kolom Email tidak boleh kosong!',
            'email.unique' => 'Email sudah digunakan!',
            'avatar.mimes' => 'Mohon gunakan format gambar : .jpeg | .jpg | .png',
            'avatar.max' => 'Ukuran gambar anda melebihi 4MB!',
            'password.required' => 'Kolom Password tidak boleh kosong!',
            'password.min' => 'Password tidak boleh kurang dari 8 karakter!',
            'phone_number.required' => 'Kolom Nomor Telepon tidak boleh kosong!',
            'phone_number.unique' => 'Nomor Telpon sudah digunakan!'
        );

        $validateData = $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg|max:4096',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'phone_number' => 'required|unique:users',
        ],$messages);

        if($request->avatar){
            $upAvatar = 'user-'.date('dmYhis').'.'.$request->avatar->getClientOriginalExtension();
            $request->avatar->move('assets/images/users/avatar', $upAvatar);

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->id_role = 3;
            $user->avatar = $upAvatar;
            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->phone_number = $request->phone_number;
            $user->save();
        }else{
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->id_role = 3;
            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->phone_number = $request->phone_number;
            $user->save();
        }
    
        // Writing History
        $history = new History;
        $history->user_id = $user->id;
        $history->nama = $user->name;
        $history->aksi = "Register";
        $history->keterangan = "Registrasi Akun baru dengan email '".$user->email."'";
        $history->save();

        // Login sebagai Owner
        Auth::attempt($request->only('email','password'));

        // Create Barbershop menu for owner
        $barbershop = new Barbershop;
        $barbershop->owner_id = auth()->user()->id;
        $barbershop->save();

        // Get User Location by IP Address for Login History
        if ($position = Location::get()) {
            // Writing History
            $history = new History;
            $history->user_id = auth()->user()->id;
            $history->nama = auth()->user()->name;
            $history->aksi = "Login";
            $history->keterangan = "Lokasi login '".$position->cityName.", ".$position->regionName.", ".$position->countryName."' dengan IP address :'".$position->ip."'";
            $history->save();
        }
        // Redirect Dashboard
        return redirect('/owner-panel/dashboard')->with('message', 'Welcome, '.auth()->user()->name);
    }

    // Delete Account
    public function deleteAccount(Request $request){
        $messages = array(
            'password.required' => 'Password tidak boleh kosong!'
        );
        $request->validate([
            'password' => 'required'
        ],$messages);

        // Konfirmasi Password sebelum menghapus akun
        $checkPassword = Hash::check($request->password,auth()->user()->password);

        if($checkPassword == 'true'){
            $uID = auth()->user()->id;
            $barber = Barbershop::where('owner_id',$uID)->get()->first();
            $identity = Identity::where('user_id',$uID)->get()->first();
            $hairstyle = Hairstyle::where('barbershop_id',$barber->id)->get();

            // Delete Avatar
            File::delete('assets/images/users/avatar/'.auth()->user()->avatar);
            // Delete KTP
            File::delete('assets/images/users/identity/'.$identity->ktp);
            // Delete Selfie KTP
            File::delete('assets/images/users/identity/'.$identity->ktp_user);
            // Delete Banner
            File::delete('assets/images/barbershop/banner/'.$barber->banner);
            foreach($hairstyle as $h){
                File::delete('assets/images/barbershop/hairstyle/'.$h->images);
            }

            // Writing History
            $history = new History;
            $history->user_id = 1;
            $history->nama = auth()->user()->name;
            $history->aksi = "Hapus";
            $history->keterangan = "User '".auth()->user()->name."' menghapus akunnya sendiri.";
            $history->save();

            $user = User::find($uID);
            History::where('id',$user->id)->delete();
            $user->delete();

            return redirect('/')->with('bye', 'Kami bersedih kehilangan kamu 😔');
        }else{

            // Writing History
            $history = new History;
            $history->user_id = 1;
            $history->nama = auth()->user()->name;
            $history->aksi = "Hapus";
            $history->keterangan = "Percobaan penghapusan akun oleh user '".auth()->user()->name."'.";
            $history->save();

            return back()->with('error','Password konfirmasi salah!');
        }    
    }

    // Proses Logout
    public function logout(){
        Auth::logout();
        return redirect('/')->with('bye', 'See you later!');
    }
}
