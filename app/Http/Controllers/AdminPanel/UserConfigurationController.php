<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Identity;
use App\User;

class UserConfigurationController extends Controller
{
    // Profile Things
    public function profile(){
        return view('Back.UserConfiguration.profile');
    }

    public function updateProfile(Request $request){
        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        $validateData = $request->validate([
            'email' => 'required|unique:users,email,'.$user->id,
            'avatar' => 'image|mimes:jpeg,png,jpg|max:8192'
        ]);
        if( $request->avatar){
                    $upAvatar = 'user-'.date('dmYhis').'.'.$request->avatar->getClientOriginalExtension();
                    $request->avatar->move('assets/images/users/avatar/', $upAvatar);
                    $user->avatar = $upAvatar;
            }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->save();

        $role = auth()->user()->id_role;

        if($role == 1 || $role == 2){
            $url = '/admin-panel/dashboard';
        }
        elseif($role == 3){
            $url = '/owner-panel/dashboard';
        }

        return redirect($url)->with('message','Profile Berhasil diubah !');
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

    public function getVerify(){
        if (session('info')) {
                Alert::info(session('info'));
        }
        return view('Back.UserConfiguration.verify');
    }

    public function putVerify(Request $request){

        $upKtp = $request->nik.'identity -'.date('dmYhis').'.'.$request->ktp->getClientOriginalExtension();
        $request->ktp->move('assets/images/users/identity', $upKtp);

        $upSelfie = $request->nik.'selfie -'.date('dmYhis').'.'.$request->ktp_user->getClientOriginalExtension();
        $request->ktp_user->move('assets/images/users/identity', $upSelfie);
        
        $uID = auth()->user()->id;
        $verify = new Identity;
        $verify->nik = $request->nik;
        $verify->ktp = $upKtp;
        $verify->ktp_user = $upSelfie;
        $verify->user_id = $uID;
        $verify->save();

        $user = User::findOrFail($uID);
        $user->verify_status = 'Processed';
        $user->save();

        return redirect('/owner-panel/get-verify')->with('info','Proses verifikasi telah diajukan!');
    }

}
