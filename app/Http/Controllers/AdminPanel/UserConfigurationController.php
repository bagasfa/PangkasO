<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserConfigurationController extends Controller
{
    // Profile Things
    public function profile(){
        return view('Back.UserConfiguration.profile');
    }

    public function editProfile(){

    }

    // Password Things
    public function password(){
        return view('Back.UserConfiguration.password');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'oldPassword' => ['required', new MatchOldPassword],
            'newPassword' => ['required'],
            'confirmPassword' => ['same:newPassword'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->newPassword)]);

        return redirect('/admin-panel/dashboard')->with('message','Password berhasil diperbarui !');
    }

}
