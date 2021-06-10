<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\History;
use DataTables;

class HistoryController extends Controller
{
    public function history(){
        $counter = History::count();

        return view('Back.Dashboard.history',compact('counter'));
    }

    public function LoadTableHistory(){
        return view('Back.DataTables.History.HistoryDatatable');
    }

    public function LoadDataHistory(){
        $history = History::all();

            return Datatables::of($history)->addIndexColumn()
            ->editColumn('created_at', function($history){
                return date('h:i:s | d-m-Y', strtotime($history->created_at));
            })->make(true);
    }
}
