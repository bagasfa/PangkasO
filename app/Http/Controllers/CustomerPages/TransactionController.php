<?php

namespace App\Http\Controllers\CustomerPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Barbershop;
use App\Hairstyle;
use App\Transaction;
use App\User;
use App\History;

class TransactionController extends Controller
{
    public function order(Request $request){
        $barbershop = Barbershop::where('id',$request->barbershop_id)->first();
        $hairstyle = Hairstyle::where('id',$request->hairstyle_id)->first();

        if($request->jenis_layanan == 'COD'){
            $transaction = new Transaction;
            $transaction->user_id = auth()->user()->id;
            $transaction->hairstyle_id = $request->hairstyle_id;
            $transaction->barbershop_id = $request->barbershop_id;
            $transaction->jenis_layanan = 'COD';
            $transaction->harga = $hairstyle->price;
            $transaction->status = 'Pending';
            $transaction->pesan = $request->pesan;
            $transaction->jam_booking = $request->time.' | '.date('d-m-Y');
            $transaction->lokasi = $request->lokasi;
            $transaction->save();

            $layanan = 'Cash On Delivery';
        }elseif($request->jenis_layanan == 'AO'){
            $transaction = new Transaction;
            $transaction->user_id = auth()->user()->id;
            $transaction->hairstyle_id = $request->hairstyle_id;
            $transaction->barbershop_id = $request->barbershop_id;
            $transaction->jenis_layanan = 'AO';
            $transaction->harga = $hairstyle->price;
            $transaction->status = 'Pending';
            $transaction->pesan = $request->pesan;
            $transaction->jam_booking = '-';
            $transaction->lokasi = $barbershop->latitude.','.$barbershop->longitude;
            $transaction->save();

            $layanan = 'Antrian Online';
        }
            // Writing History
            $history = new History;
            $history->user_id = auth()->user()->id;
            $history->nama = auth()->user()->name;
            $history->aksi = "Order";
            $history->keterangan = "Akun '".auth()->user()->name."' melakukan transaksi dengan jenis layanan '".$layanan."'.";
            $history->save();

        return back()->with('message','Order anda sedang diproses!'); 
    }

    public function showOrders(){
        $uID = auth()->user()->id;
        $orders = Transaction::where('user_id',$uID)->orderBy('id','desc')->get();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Front.Transactions.order', compact('orders'));
    }

    public function history(){
        $uID = auth()->user()->id;
        $orders = Transaction::where('user_id',$uID)->orderBy('id','desc')->get();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Front.Transactions.history', compact('orders'));
    }

    public function cancel($id){
        $transaksi = Transaction::find($id);
        if($transaksi->status == 'Pending'){
            $transaksi->status = 'Canceled';
            $transaksi->save();

            // Writing History
            $history = new History;
            $history->user_id = auth()->user()->id;
            $history->nama = auth()->user()->name;
            $history->aksi = "Cancel";
            $history->keterangan = "Akun '".auth()->user()->name."' membatalkan orderannya : '".$transaksi->no_antrian."'.";
            $history->save();

            return back()->with('message','Berhasil membatalkan orderan');

        }elseif($transaksi->status == 'Confirmed'){
            $transaksi->status = 'Requested';
            $transaksi->save();

            // Writing History
            $history = new History;
            $history->user_id = auth()->user()->id;
            $history->nama = auth()->user()->name;
            $history->aksi = "Request";
            $history->keterangan = "Akun '".auth()->user()->name."' meminta orderannya : '".$transaksi->no_antrian."' dibatalkan.";
            $history->save();

            return back()->with('info','Sedang meminta konfirmasi pembatalan order ke Barbershop');
        }
 
    }

    public function abort($id){
        $transaksi = Transaction::find($id);
        if($transaksi->status == 'Requested'){
            $transaksi->status = 'Confirmed';
            $transaksi->save();

            // Writing History
            $history = new History;
            $history->user_id = auth()->user()->id;
            $history->nama = auth()->user()->name;
            $history->aksi = "Cancel";
            $history->keterangan = "Akun '".auth()->user()->name."' membatalkan request pembatalan sebelumnya.";
            $history->save();
        }
        
        return back()->with('message','Berhasil membatalkan request pembatalan');
    }
}
