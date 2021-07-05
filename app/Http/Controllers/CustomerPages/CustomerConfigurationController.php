<?php

namespace App\Http\Controllers\CustomerPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;
use App\Barbershop;
use App\History;
use App\Identity;
use File;

class CustomerConfigurationController extends Controller
{
    // Profile Things
    public function profile(){
        $uID = auth()->user()->id;
        $barber = Barbershop::select('name')->where('owner_id',$uID)->get()->first();

        return view('Front.CustomerConfiguration.profile',compact('barber'));
    }

    public function updateProfile(Request $request){
        $id = auth()->user()->id;
        $user = User::findOrFail($id);

        $error = array(
            'email.required' => 'Kolom Email tidak boleh kosong!',
            'email.unique' => 'Email sudah digunakan!',
            'avatar.mimes' => 'Mohon gunakan format gambar : .jpeg | .jpg | .png',
            'avatar.max' => 'Ukuran gambar anda melebihi 4MB!',
            'address.required' => 'Kolom Alamat tidak boleh kosong!'
        );

        $validateData = $request->validate([
            'email' => 'required|unique:users,email,'.$user->id,
            'avatar' => 'image|mimes:jpeg,png,jpg|max:4096',
            'address' => 'required'
        ],$error);
        if( $request->avatar){
            $upAvatar = 'user-'.date('dmYhis').'.'.$request->avatar->getClientOriginalExtension();
            $request->avatar->move('assets/images/users/avatar/',$upAvatar);
            File::delete('assets/images/users/avatar/'.auth()->user()->avatar);

            $user->avatar = $upAvatar;
        }

        $history = History::where('nama',$user->name)->get();
        if($history){
            History::where('nama','=',auth()->user()->name)->update(array('nama' => $request->name));
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->latitude = $request->lat;
        $user->longitude = $request->long;
        $user->save();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = $request->name;
        $history->aksi = "Edit";
        $history->keterangan = "Akun '".auth()->user()->email."' merubah profilenya.";
        $history->save();

        return back()->with('message','Profile Berhasil diubah !');
    }

    // Password Things
    public function updatePassword(Request $request){
        $error = array(
            'oldPassword.required' => 'Password Lama tidak boleh kosong!',
            'newPassword.required' => 'Password Baru tidak boleh kosong!',
            'newPassword.min' => 'Password tidak boleh kurang dari 8 karakter!',
            'confirmPassword.min' => 'Password tidak boleh kurang dari 8 karakter!',
            'confirmPassword.same' => 'Konfirmasi password baru anda tidak cocok !'
        );

        $request->validate([
            'oldPassword' => ['required', new MatchOldPassword],
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'min:8|same:newPassword',
        ],$error);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->newPassword)]);

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Edit";
        $history->keterangan = "Akun '".auth()->user()->email."' merubah passwordnya.";
        $history->save();

        return back()->with('message','Password berhasil diperbarui !');
    }

    // Verify Identity 
    public function getVerify(){
        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }elseif (session('info')) {
            Alert::info(session('info'));
        }

        return view('Front.CustomerConfiguration.verify');
    }

    // Store Verify
    public function putVerify(Request $request){

        $error = array(
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
        ],$error);

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

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Tambah";
        $history->keterangan = "Akun '".auth()->user()->email."' mengajukan verifikasi identitas.";
        $history->save();

        return back()->with('info','Proses verifikasi telah diajukan!');
    }

    // Activity Customer
    public function activity(){
        $activity = History::where('user_id',auth()->user()->id)->orderBy('id','desc')->get();

        return view('Front.CustomerConfiguration.activity',compact('activity'));
    }
}
