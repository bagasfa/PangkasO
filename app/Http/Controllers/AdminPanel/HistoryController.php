<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\History;
use DataTables;

class HistoryController extends Controller
{
    public function history(){
        $counter = History::count();
        
        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.Dashboard.history',compact('counter'));
    }

    public function LoadTableHistory(){
        return view('Back.DataTables.History.HistoryDatatable');
    }

    public function LoadDataHistory(){
        $history = History::orderBy('id','desc')->get();

        return Datatables::of($history)->addIndexColumn()
        ->editColumn('created_at', function($history){
            return date('H:i:s | d-m-Y', strtotime($history->created_at));
        })->make(true);
    }
}
