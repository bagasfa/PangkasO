<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Roles;

class RolesController extends Controller
{
    public function index(Request $request){
        $roles = Roles::when($request->search, function($query) use($request){
            $query->where('role_name', 'LIKE', '%'.$request->search.'%');
        })->paginate(10);
        $counter = Roles::count();

        return view('Back.UsersManagement.roles',compact('roles','counter'));
    }
}
