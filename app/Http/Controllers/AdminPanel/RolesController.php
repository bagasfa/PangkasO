<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Roles;
use App\History;
use DataTables;

class RolesController extends Controller
{
    public function index(Request $request){

        $counter = Roles::count();

        return view('Back.UsersManagement.roles',compact('counter'));
    }

    // Add Roles Data
    public function store(Request $request){
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Tambah";
        $history->keterangan = "Menambahkan Role '".$request->role_name."'";
        $history->save();

        Roles::create($request->all());

        return response([
            'message' => 'successfully'
        ]);
    }

    // Update Role Data
    public function update(Request $request, $id){

        $roles = Roles::find($id);
        if($roles->role_name != $request->role_name){
            $history = new History;
            $history->user_id = auth()->user()->id;
            $history->nama = auth()->user()->name;
            $history->aksi = "Edit";
            $history->keterangan = "Mengedit Role '".$roles->role_name."' menjadi '".$request->role_name."'";
            $history->save();
        }

        $roles->role_name = $request->role_name;
        $roles->save();

        return response([
            'message' => 'update successfully'
        ]);
    }

    // Delete Roles Data
    public function destroy($id){
        $roles = Roles::find($id);
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Hapus";
        $history->keterangan = "Menghapus Role '".$roles->role_name."'";
        $history->save();

        $roles->delete();

        return response([
            'message' => 'deleted'
        ]);
    }

    // Load Template Datatables Roles
    public function LoadTableRoles(){
        return view("Back.DataTables.UsersManagement.RolesDatatable");
    }

    // Load Roles Data to Datatables
    public function LoadDataRoles(){
        $roles = Roles::all();

            return Datatables::of($roles)->addIndexColumn()
            ->editColumn('created_at', function($roles){
                return date('H:i:s | d-m-Y', strtotime($roles->created_at));
            })
            ->addColumn('aksi', function($row){
                $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" data-role_name="'.$row->role_name.'" class="btn btn-outline-primary btn-aksi btn-edit-roles" class="mr-3">
                <i class="fas fa-pen"></i>
                </a>';
                $btn = $btn. '<a href="javascript:void(0)" data-id="'.$row->id.'" data-role_name="'.$row->role_name.'" class="btn btn-outline-danger btn-delete-roles">
                <i class="fas fa-trash"></i>
                </a>';
                return $btn;
         })
         ->rawColumns(['aksi'])
            ->make(true);
    }
}
