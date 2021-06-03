<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;

class AuthController extends Controller
{
    // Halaman Login
    public function login(){
        return view('Auth.login');
    }

    // Proses Login
    public function postLogin(Request $request){
        // Checking Email dan Password
        if(Auth::attempt($request->only('email','password'))){
            // Jika Berhasil Login
            // dd('success');
            return redirect('/admin-panel/dashboard')->with('message', 'Welcome, '.auth()->user()->name);
        }
        // Email atau Password salah
        return redirect('/login')->with('bye', 'Email atau Password anda Salah!');
    }

    // Registrasi User Baru Sebagai User
    public function register(Request $request){
        $validateData = $request->validate([
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:8192'
        ]);
        $upAvatar = 'user-'.date('dmYhis').'.'.$request->avatar->getClientOriginalExtension();
        $request->avatar->move('assets/users/avatar', $upAvatar);
        
        $users = new User;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = bcrypt($request->password);
        $users->id_role = $request->role;
        $users->avatar = $upAvatar;
        $users->gender = $request->gender;
        $users->address = $request->address;
        $users->phone_number = $request->phone;
        $users->save();
        return redirect('/login')->with('message', 'Registrasi berhasil!');
    }

    // Proses Logout
    public function logout(){
        Auth::logout();
        return redirect('/')->with('bye', 'See you later!');
    }
}
