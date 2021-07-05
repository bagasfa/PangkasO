<?php

namespace App\Http\Controllers\CustomerPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaction;
use App\Barbershop;
use App\Hairstyle;
use App\Rating;
use App\History;

class RatingController extends Controller
{
    public function hairstyle(Request $request, Hairstyle $id) {
      $rating = new Rating;
      $rating->user_id = auth()->user()->id;
      $rating->rating = $request->hairstyle;
      $id->ratings()->save($rating);

      // Merubah row Rating Hairstyle
      $transaksi = Transaction::where('id',$request->order_id)->first();
      $transaksi->hairstyle_rating = $request->hairstyle;
      $transaksi->save();

      $hair = Hairstyle::where('id',$transaksi->hairstyle_id)->first();

      // Writing History
      $history = new History;
      $history->user_id = auth()->user()->id;
      $history->nama = auth()->user()->name;
      $history->aksi = "Rate";
      $history->keterangan = "Akun '".auth()->user()->name."' memberikan rating hairstyle : '".$hair->name."'.";
      $history->save();

      return redirect()->back()->with('message','Terimakasih telah memberikan rating :)');
    }

    public function barbershop(Request $request, Barbershop $id) {
      $rating = new Rating;
      $rating->user_id = auth()->user()->id;
      $rating->rating = $request->barbershop;
      $id->ratings()->save($rating);

      // Merubah row Rating Barbershop
      $transaksi = Transaction::where('id',$request->order_id)->first();
      $transaksi->barbershop_rating = $request->barbershop;
      $transaksi->save();

      $barber = Barbershop::where('id',$transaksi->barbershop_id)->first();

      // Writing History
      $history = new History;
      $history->user_id = auth()->user()->id;
      $history->nama = auth()->user()->name;
      $history->aksi = "Rate";
      $history->keterangan = "Akun '".auth()->user()->name."' memberikan rating kepada : '".$barber->name."'.";
      $history->save();

      return redirect()->back()->with('message','Terimakasih telah memberikan rating :)');
    }
}
