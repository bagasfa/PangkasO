<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UsersDataController extends Controller
{

    // Admin Things
    public function admins(Request $request){
        $admin = User::where('id_role',2)->when($request->search, function($query) use($request){
            $query->where('name', 'LIKE', '%'.$request->search.'%');
        })->paginate(20);
        $counter = User::where('id_role',2)->count();

        return view('Back.UsersManagement.UsersData.admin', compact('admin','counter'));
    }

    public function addAdmin(Request $request){
        $validateData = $request->validate([
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:8192'
        ]);
        $upAvatar = 'user-'.date('dmYhis').'.'.$request->avatar->getClientOriginalExtension();
        $request->avatar->move('assets/images/users/avatar', $upAvatar);
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->id_role = $request->role;
        $user->avatar = $upAvatar;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->phone_number = $request->phone;
        $user->save();
        return redirect('/admin-panel/admins')->with('message', 'Berhasil menambahkan Admin!');
    }

    // Owner Things
    public function owners(Request $request){
        $owner = User::where('id_role',3)->when($request->search, function($query) use($request){
            $query->where('name', 'LIKE', '%'.$request->search.'%');
        })->paginate(20);
        $counter = User::where('id_role',3)->count();

        return view('Back.UsersManagement.UsersData.owner', compact('owner','counter'));
    }

    public function addOwner(Request $request){
        $validateData = $request->validate([
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:8192'
        ]);
        $upAvatar = 'user-'.date('dmYhis').'.'.$request->avatar->getClientOriginalExtension();
        $request->avatar->move('assets/images/users/avatar', $upAvatar);
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->id_role = $request->role;
        $user->avatar = $upAvatar;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->phone_number = $request->phone;
        $user->save();
        return redirect('/admin-panel/owners')->with('message', 'Berhasil menambahkan Owners!');
    }

    // Customer Things
    public function customers(Request $request){
        $customer = User::where('id_role',4)->when($request->search, function($query) use($request){
            $query->where('name', 'LIKE', '%'.$request->search.'%');
        })->paginate(20);
        $counter = User::where('id_role',4)->count();

        return view('Back.UsersManagement.UsersData.customer', compact('customer','counter'));
    }
}
