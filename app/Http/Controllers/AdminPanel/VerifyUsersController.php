<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Identity;
use App\History;
use File;

class VerifyUsersController extends Controller
{
    // All Owner Things
    public function owners(){
        $pending = User::where('verify_status','Processed')->where('id_role',3)->count();
        $approved = User::where('verify_status','Approved')->where('id_role',3)->count();
        $data_pending = DB::table('identity')
            ->join('users', 'identity.user_id', '=', 'users.id')
            ->select('identity.*', 'users.verify_status', 'users.name', 'users.id_role')
            ->where('users.verify_status','Processed')
            ->where('users.id_role',3)
            ->paginate(20);
        $data_approved = DB::table('identity')
            ->join('users', 'identity.user_id', '=', 'users.id')
            ->select('identity.*', 'users.verify_status', 'users.name', 'users.id_role')
            ->where('users.verify_status','Approved')
            ->where('users.id_role',3)
            ->paginate(20);

            if (session('approved')) {
                Alert::success(session('approved'));
            }elseif(session('rejected')){
                Alert::info(session('rejected'));
            }
            
        return view('Back.UsersManagement.VerifyUsers.owners',compact('pending','approved','data_pending','data_approved'));
    }

    public function approve($id){
        $identity = Identity::find($id);
        $userId = $identity->user_id;
        $identity->updated_at = now();
        $identity->save();

        $users = User::find($userId);
        $name = $users->name;
        $role = $users->id_role;
        $users->verify_status = 'Approved';
        $users->save();

        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Approve";
        $history->keterangan = "Approve Verifikasi Identitas milik Akun '".$name;
        $history->save();

        if($role == 3){
            return redirect('/admin-panel/verify-owners')->with('approved','Identitas dari '.$name.' berhasil diverifikasi!');
        }elseif($role == 4){
            return redirect('/admin-panel/verify-customers')->with('approved','Identitas dari '.$name.' berhasil diverifikasi!');
        }
    }

    public function reject($id){
        $identity = Identity::findOrFail($id);
        $identity->delete();

        $userId = $identity->user_id;

        // Hapus Scan KTP
        $ktp = Identity::where('user_id',$id)->value('ktp');
        File::delete('/assets/images/users/identity/'.$ktp);
        // Hapus Selfie dengan KTP
        $ktp_user = Identity::where('user_id',$id)->value('ktp_user');
        File::delete('/assets/images/users/identity/'.$ktp_user);
    
        $users = User::find($userId);
        $name = $users->name;
        $role = $users->id_role;
        $users->verify_status = 'Rejected';
        $users->save();

        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Reject";
        $history->keterangan = "Reject Verifikasi Identitas milik Akun '".$name;
        $history->save();

        if($role == 3){
            return redirect('/admin-panel/verify-owners')->with('success','Identitas dari '.$name.' berhasil direject!');
        }elseif($role == 4){
            return redirect('/admin-panel/verify-customers')->with('success','Identitas dari '.$name.' berhasil direject!');
        }
    }

    // All Customer Things
    public function customers(){
        $pending = User::where('verify_status','Processed')->where('id_role',4)->count();
        $approved = User::where('verify_status','Approved')->where('id_role',4)->count();
        $data_pending = DB::table('identity')
            ->join('users', 'identity.user_id', '=', 'users.id')
            ->select('identity.*', 'users.verify_status', 'users.name', 'users.id_role')
            ->where('users.verify_status','Processed')
            ->where('users.id_role',4)
            ->paginate(20);
        $data_approved = DB::table('identity')
            ->join('users', 'identity.user_id', '=', 'users.id')
            ->select('identity.*', 'users.verify_status', 'users.name', 'users.id_role')
            ->where('users.verify_status','Approved')
            ->where('users.id_role',4)
            ->paginate(20);

        return view('Back.UsersManagement.VerifyUsers.customers', compact('pending','approved','data_pending','data_approved'));
    }

}
