<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Identity;
use App\User;
use App\History;
use Illuminate\Support\Facades\DB;

class UserConfigurationController extends Controller
{
    // Profile Things
    public function profile(){
        return view('Back.UserConfiguration.profile');
    }

    public function updateProfile(Request $request){
        $id = auth()->user()->id;
        $user = User::findOrFail($id);

        $messages = array(
            'email.required' => 'Kolom Email tidak boleh kosong!',
            'email.unique' => 'Email sudah digunakan!',
            'avatar.mimes' => 'Mohon gunakan format gambar : .jpeg | .jpg | .png',
            'avatar.max' => 'Ukuran gambar anda melebihi 4MB!'
        );

        $validateData = $request->validate([
            'email' => 'required|unique:users,email,'.$user->id,
            'avatar' => 'image|mimes:jpeg,png,jpg|max:4096'
        ],$messages);
        if( $request->avatar){
            $upAvatar = 'user-'.date('dmYhis').'.'.$request->avatar->getClientOriginalExtension();
            $request->avatar->move('assets/images/users/avatar/', $upAvatar);
            $user->avatar = $upAvatar;
        }

        $history = History::where('nama',$user->name)->get();
        if($history){
            DB::table('history')->where('nama','=',auth()->user()->name)->update(array('nama' => $request->name));
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->save();

        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = $request->name;
        $history->aksi = "Edit";
        $history->keterangan = "Akun '".auth()->user()->email."' merubah profilenya.";
        $history->save();

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
        $messages = array(
            'oldPassword.required' => 'Password Lama tidak boleh kosong!',
            'newPassword.required' => 'Password Baru tidak boleh kosong!',
            'newPassword.min' => 'Password tidak boleh kurang dari 8 karakter!',
            'confirmPassword.min' => 'Password tidak boleh kurang dari 8 karakter!',
            'confirmPassword.same' => 'Konfirmasi password baru anda tidak cocok !'
        );

        $request->validate([
            'oldPassword' => ['required', new MatchOldPassword],
            'newPassword' => ['required|min:8'],
            'confirmPassword' => ['min:8|same:newPassword'],
        ],$messages);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->newPassword)]);

        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Edit";
        $history->keterangan = "Akun '".auth()->user()->email."' merubah passwordnya.";
        $history->save();

        return redirect('/admin-panel/dashboard')->with('message','Password berhasil diperbarui !');
    }

    public function getVerify(){
        if (session('info')) {
                Alert::info(session('info'));
        }
        return view('Back.UserConfiguration.verify');
    }

    public function putVerify(Request $request){

        $messages = array(
            'nik.required' => 'Kolom NIK tidak boleh kosong!',
            'nik.unique' => 'NIK telah digunakan!',
            'ktp.required' => 'Mohon sertakan scan KTP anda!',
            'ktp.mimes' => 'Mohon gunakan format gambar : .jpeg | .jpg | .png',
            'ktp.max' => 'Ukuran gambar anda melebihi 4MB!',
            'ktp_user.required' => 'Mohon sertakan foto Selfie anda dengan KTP!',
            'ktp_user.mimes' => 'Mohon gunakan format gambar : .jpeg | .jpg | .png',
            'ktp_user.max' => 'Ukuran gambar anda melebihi 4MB!',
        );

        $validateData = $request->validate([
            'nik' => 'required|unique:identity,nik',
            'ktp' => 'image|mimes:jpeg,png,jpg|max:4096',
            'ktp_user' => 'image|mimes:jpeg,jpg,png|max:4096'
        ],$messages);

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

        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Create";
        $history->keterangan = "Akun '".auth()->user()->email."' mengajukan verifikasi identitas.";
        $history->save();

        return redirect('/owner-panel/get-verify')->with('info','Proses verifikasi telah diajukan!');
    }

}
