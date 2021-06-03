<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Roles;

class RolesController extends Controller
{
    public function index(){
        $roles = Roles::select('role_name','created_at')->paginate(10);
        $counter = Roles::count();

        return view('Back.UsersManagement.roles',compact('roles','counter'));
    }
}
