<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;
use App\History;
use App\Identity;
use App\Barbershop;
use Validator;
use File;
use DataTables;

class UsersDataController extends Controller
{

    // Admin Things
    public function admins(){
        $counter = User::where('id_role',2)->count();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.UsersManagement.UsersData.admin', compact('counter'));
    }

    public function storeAdmin(Request $request){

        $messages = array(
            'name.required' => 'Kolom nama tidak boleh kosong!',
            'email.required' => 'Kolom Email tidak boleh kosong!',
            'email.unique' => 'Email telah digunakan!',
            'password.required' => 'Kolom Password tidak boleh kosong!',
            'password.min' => 'Password tidak boleh kurang dari 8 karakter!',
            'phone_number.required' => 'Kolom Nomor Telepon tidak boleh kosong!',
            'phone_number.unique' => 'Nomor Telepon telah digunakan!',
        );

        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'phone_number' => 'required|unique:users,phone_number'
        ],$messages);

        if($validator->fails()){
            $error = $validator->errors()->first();
                return response()->json([
                    'error' => $error,
                ]);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone_number = $request->phone_number;
        $user->id_role = 2;
        $user->remember_token = '';
        $user->save();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Tambah";
        $history->keterangan = "Menambahkan Akun '".$request->email."' sebagai Admin";
        $history->save();

        // Mail::to($request->email)->send(new PenggunaMail());

        return response([
            'message' => 'sukses',
        ]);
    }

    public function destroyAdmin($id){
        // Hapus Avatar
        $owner = User::select('avatar')->where('id', $id)->get()->first();
        File::delete('assets/images/users/avatar/'.$owner);
        // Hapus Scan KTP
        $ktp = Identity::select('ktp')->where('user_id',$id)->get()->first();
        File::delete('assets/images/users/identity/'.$ktp);
        // Hapus Selfie dengan KTP
        $ktp_user = Identity::select('ktp_user')->where('user_id',$id)->get()->first();
        File::delete('assets/images/users/identity/'.$ktp_user);

        $user = User::find($id);
        History::where('id',$user->id)->delete();
        $user->delete();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Hapus";
        $history->keterangan = "Menghapus Akun '".$user->email."' beserta Historynya";
        $history->save();

        return response([
            'message' => "delete sukses"
        ]);
    }

    public function LoadTableUsers(){
        return view('Back.DataTables.UsersManagement.UsersDatatable');
    }

    public function LoadDataAdmin(){
        $admin = User::where('id_role','2')->orderBy('id','desc')->get();

            return Datatables::of($admin)->addIndexColumn()
            ->editColumn('created_at', function($admin){
                return date('H:i:s | d-m-Y', strtotime($admin->created_at));
            })
            ->addColumn('aksi', function($row){
                $btn =  '<a href="javascript:void(0)" data-id="'.$row->id.'" data-name="'.$row->name.'" class="btn btn-outline-danger btn-delete-admin">
                <i class="fas fa-trash"></i>
                </a>';
                return $btn;
         })
         ->rawColumns(['aksi'])
            ->make(true);
    }

    // Owner Things
    public function owners(){
        $counter = User::where('id_role',3)->count();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.UsersManagement.UsersData.owner', compact('counter'));
    }

    public function storeOwner(Request $request){

        $messages = array(
            'name.required' => 'Kolom nama tidak boleh kosong!',
            'email.required' => 'Kolom Email tidak boleh kosong!',
            'email.unique' => 'Email telah digunakan!',
            'password.required' => 'Kolom Password tidak boleh kosong!',
            'phone_number.required' => 'Kolom Nomor Telepon tidak boleh kosong!',
            'phone_number.unique' => 'Nomor Telepon telah digunakan!',
        );

        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'phone_number' => 'required|unique:users,phone_number'
        ],$messages);

        if($validator->fails()){
            $error = $validator->errors()->first();
                return response()->json([
                    'error' => $error,
                ]);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone_number = $request->phone_number;
        $user->id_role = 3;
        $user->remember_token = '';
        $user->save();

        // Create Barbershop for owner
        $barbershop = new Barbershop;
        $barbershop->owner_id = $user->id;
        $barbershop->save();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Tambah";
        $history->keterangan = "Menambahkan Akun '".$request->email."' sebagai Owner";
        $history->save();

        // Mail::to($request->email)->send(new PenggunaMail());

        return response([
            'message' => 'sukses',
        ]);
    }

    public function destroyOwner($id){
        // Hapus Avatar
        $owner = User::select('avatar')->where('id', $id)->get()->first();
        File::delete('assets/images/users/avatar/'.$owner);
        // Hapus Scan KTP
        $ktp = Identity::select('ktp')->where('user_id',$id)->get()->first();
        File::delete('assets/images/users/identity/'.$ktp);
        // Hapus Selfie dengan KTP
        $ktp_user = Identity::select('ktp_user')->where('user_id',$id)->get()->first();
        File::delete('assets/images/users/identity/'.$ktp_user);
        // Hapus Banner Barbershop
        $banner = Barbershop::select('banner')->where('owner_id',$id)->get()->first();
        File::delete('assets/images/barbershop/banner/'.$banner);

        $user = User::find($id);
        History::where('id',$user->id)->delete();
        $user->delete();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Hapus";
        $history->keterangan = "Menghapus Akun '".$user->email."' beserta Historynya";
        $history->save();

        return response([
            'message' => "delete sukses"
        ]);
    }

    public function LoadDataOwner(){
        $owner = User::where('id_role','3')->orderBy('id','desc')->get();

            return Datatables::of($owner)->addIndexColumn()
            ->editColumn('created_at', function($owner){
                return date('H:i:s | d-m-Y', strtotime($owner->created_at));
            })
            ->addColumn('aksi', function($row){
                $btn =  '<a href="javascript:void(0)" data-id="'.$row->id.'" data-name="'.$row->name.'" class="btn btn-outline-danger btn-delete-owner">
                <i class="fas fa-trash"></i>
                </a>';
                return $btn;
         })
         ->rawColumns(['aksi'])
            ->make(true);
    }

    // Customer Things
    public function customers(){
        $counter = User::where('id_role',4)->count();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.UsersManagement.UsersData.customer', compact('counter'));
    }

    public function destroyCustomer($id){
        // Hapus Avatar
        $owner = User::select('avatar')->where('id', $id)->get()->first();
        File::delete('assets/images/users/avatar/'.$owner);
        // Hapus Scan KTP
        $ktp = Identity::select('ktp')->where('user_id',$id)->get()->first();
        File::delete('assets/images/users/identity/'.$ktp);
        // Hapus Selfie dengan KTP
        $ktp_user = Identity::select('ktp_user')->where('user_id',$id)->get()->first();
        File::delete('assets/images/users/identity/'.$ktp_user);

        $user = User::find($id);
        History::where('id',$user->id)->delete();
        $user->delete();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Hapus";
        $history->keterangan = "Menghapus Akun '".$user->email."' beserta Historynya";
        $history->save();

        return response([
            'message' => "delete sukses"
        ]);
    }

    public function LoadDataCustomer(){
        $customer = User::where('id_role','4')->orderBy('id','desc')->get();

            return Datatables::of($customer)->addIndexColumn()
            ->editColumn('created_at', function($customer){
                return date('H:i:s | d-m-Y', strtotime($customer->created_at));
            })
            ->addColumn('aksi', function($row){
                $btn =  '<a href="javascript:void(0)" data-id="'.$row->id.'" data-name="'.$row->name.'" class="btn btn-outline-danger btn-delete-customer">
                <i class="fas fa-trash"></i>
                </a>';
                return $btn;
         })
         ->rawColumns(['aksi'])
            ->make(true);
    }
}
