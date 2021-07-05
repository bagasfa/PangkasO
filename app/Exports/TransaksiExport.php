<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Transaction;

class TransaksiExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {   
        if(auth()->user()->id_role != 3){
            $transaksi = Transaction::where('status','Rejected')
                                        ->orWhere('status','Canceled')
                                        ->orWhere('status','Completed')
                                        ->get();
        }else{
            $transaksi = Transaction::where('user_id',auth()->user()->id)
                                        ->orWhere('status','Rejected')
                                        ->orWhere('status','Canceled')
                                        ->orWhere('status','Completed')
                                        ->get();
        }

        return view('Back.Transactions.export', compact('transaksi'));
    }
}
