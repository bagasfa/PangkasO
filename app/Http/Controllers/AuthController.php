<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
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
                return redirect($url)->with('message', 'Welcome, '.auth()->user()->name);
            }
            // Customer Login
            elseif($role == 4){
                return Redirect::to($request->request->get('http_referrer'))->with('message', 'Welcome, '.auth()->user()->name);
            }
        }
        // Email atau Password salah
        return redirect('/login')->with('bye', 'Email atau Password anda Salah!');
    }

    // Registrasi User Baru Sebagai Customer
    public function register(Request $request){
        $validateData = $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'phone_number' => 'required|unique:users,phone_number',
        ]);
        $upAvatar = 'user-'.date('dmYhis').'.'.$request->avatar->getClientOriginalExtension();
        $request->avatar->move('assets/images/users/avatar', $upAvatar);
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->id_role = 4;
        $user->avatar = $upAvatar;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->save();

        // Login sebagai Customer
        Auth::attempt($request->only('email','password'));
        // Redirect Home
        return Redirect::to($request->request->get('http_referrer'))->with('message', 'Welcome, '.auth()->user()->name);
        
    }

    // Proses Logout
    public function logout(){
        Auth::logout();
        return redirect('/')->with('bye', 'See you later!');
    }
}
