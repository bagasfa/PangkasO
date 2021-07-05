<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\TransaksiExport;
use App\Barbershop;
use App\Hairstyle;
use App\Transaction;
use App\User;
use App\History;
use Alert;
use DataTables;
use PDF;
use Excel;
use DB;

class TransactionController extends Controller
{
    public function orders(){
        $uID = auth()->user()->id;
        $barber = Barbershop::where('owner_id',$uID)->get()->first();
        $pending = Transaction::where('barbershop_id',$barber->id)->where('status','Pending')->get();
        $request = Transaction::where('barbershop_id',$barber->id)->where('status','Requested')->get();
        $confirmed = Transaction::where('barbershop_id', $barber->id)->where('status','Confirmed')->get();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.Transactions.order', compact('barber','pending','confirmed','request'));
    }
    // For Owner Panel
    // History transaksi card style
    public function history(){
        $uID = auth()->user()->id;
        $barber = Barbershop::where('owner_id',$uID)->get()->first();
        $orders = Transaction::where('barbershop_id',$barber->id)->orderBy('id','desc')->get();
        $counter = Transaction::where('barbershop_id',$barber->id)->where('status','Rejected')
                                                                  ->orWhere('status','Canceled')
                                                                  ->orWhere('status','Completed')
                                                                  ->count();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.Transactions.history', compact('barber','orders','counter'));
    }
    // Load Data Transaksi Owner
    public function LoadDataTransaksiBarber(){
        $barber = Barbershop::where('owner_id',auth()->user()->id)->first();
        $transaksi = DB::table('transactions')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->join('barbershop', 'transactions.barbershop_id', '=', 'barbershop.id')
            ->join('hairstyle', 'transactions.hairstyle_id', '=', 'hairstyle.id')
            ->select('transactions.*', 'users.name AS username', 'barbershop.name AS barbername', 'hairstyle.name AS hairname')
            ->where('transactions.barbershop_id',$barber->id)
            ->where('status','Rejected')
            ->orWhere('status','Canceled')
            ->orWhere('status','Completed')
            ->orderBy('id','desc')
            ->get();

            return Datatables::of($transaksi)->addIndexColumn()
            ->editColumn('updated_at', function($transaksi){
                return date('H:i:s | d-m-Y', strtotime($transaksi->updated_at));
            })
            ->make(true);
    }

    // For Admin Panel
    // History transaksi card style
    public function historyAdmin(){
        $orders = Transaction::orderBy('id','desc')->get();
        $counter = Transaction::where('status','Rejected')
                                ->orWhere('status','Canceled')
                                ->orWhere('status','Completed')
                                ->count();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.Transactions.history', compact('orders','counter'));
    }

    // History transaksi Table style
    public function LoadTableTransaksi(){
        return view('Back.DataTables.Transaksi.TransaksiDatatable');
    }
    // Load Data Transaksi Admin
    public function LoadDataTransaksi(){
        $transaksi = DB::table('transactions')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->join('barbershop', 'transactions.barbershop_id', '=', 'barbershop.id')
            ->join('hairstyle', 'transactions.hairstyle_id', '=', 'hairstyle.id')
            ->select('transactions.*', 'users.name AS username', 'barbershop.name AS barbername', 'hairstyle.name AS hairname')
            ->where('status','Rejected')
            ->orWhere('status','Canceled')
            ->orWhere('status','Completed')
            ->orderBy('id','desc')
            ->get();

            return Datatables::of($transaksi)->addIndexColumn()
            ->editColumn('updated_at', function($transaksi){
                return date('H:i:s | d-m-Y', strtotime($transaksi->updated_at));
            })
            ->addColumn('aksi', function($row){
                $btn =  '<a href="javascript:void(0)" data-id="'.$row->id.'" data-antri="'.$row->no_antri.'" class="btn btn-outline-danger btn-delete-transaksi">
                <i class="fas fa-trash"></i>
                </a>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    // Hapus Transaksi
    public function destroy($id){

        $transaksi = Transaction::find($id);
        $transaksi->delete();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Hapus";
        $history->keterangan = "Menghapus Transaksi : '".$transaksi->no_antri."'.";
        $history->save();

        return response([
            'message' => "delete sukses"
        ]);
    }

    public function confirm($id){
        $transaksi = Transaction::find($id);

        $barbershop = Barbershop::where('owner_id',auth()->user()->id)->first();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;

        if($transaksi->status == 'Requested'){
            // Tolak pembatalan :: Request -> Confirmed
            $history->aksi = "Reject";
            $history->keterangan = "Akun Barbershop '".$barbershop->name."' menolak request pembatalan order : '".$transaksi->no_antri."'.";
            $history->save();

            $url = back()->with('success','Berhasil menolak request pembatalan');

        }elseif($transaksi->status == 'Pending'){
            // Menerima Order :: Pending -> Confirmed
            $history->aksi = "Confirm";
            $history->keterangan = "Akun Barbershop '".$barbershop->name."' menerima orderan '".$transaksi->no_antri."'.";
            $history->save();

            $url = back()->with('success','Berhasil menerima orderan');
        }

        $transaksi->status = 'Confirmed';
        $transaksi->save();

        return $url;
        
    }

    public function reject($id){
        $transaksi = Transaction::find($id);
        $transaksi->status = 'Rejected';
        $transaksi->save();

        $barbershop = Barbershop::where('owner_id',auth()->user()->id)->first();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Reject";
        $history->keterangan = "Akun Barbershop '".$barbershop->name."' menolak orderan '".$transaksi->no_antri."'.";
        $history->save();

        return back()->with('success','Berhasil menolak orderan');
    }

    public function cancel($id){
        $transaksi = Transaction::find($id);
        $transaksi->status = 'Canceled';
        $transaksi->save();

        $barbershop = Barbershop::where('owner_id',auth()->user()->id)->first();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Confirm";
        $history->keterangan = "Akun Barbershop '".$barbershop->name."' meng-konfirmasi pembatalan : '".$transaksi->no_antri."'.";
        $history->save();

        return back()->with('success','Berhasil mengkonfirmasi pembatalan orderan');
        
    }

    public function complete($id){
        $transaksi = Transaction::find($id);
        $transaksi->status = 'Completed';
        $transaksi->save();

        $barbershop = Barbershop::where('owner_id',auth()->user()->id)->first();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Complete";
        $history->keterangan = "Akun Barbershop '".$barbershop->name."' menyelesaikan orderan : '".$transaksi->no_antri."'.";
        $history->save();

        return back()->with('success','Berhasil menyelesaikan order');
    }

    public function close(Request $request){

        $id = $request->id;
        $transaksi = Transaction::find($id);
        $transaksi->pesan = $request->pesan;
        $transaksi->status = 'Canceled';
        $transaksi->save();

        $barbershop = Barbershop::where('owner_id',auth()->user()->id)->first();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Confirm";
        $history->keterangan = "Akun Barbershop '".$barbershop->name."' membatalkan orderan : '".$transaksi->no_antri."' dengan alasan tertentu.";
        $history->save();

        return back()->with('success','Berhasil membatalkan orderan');
    }

    // Export Excel
    public function excel()
    {
        if(auth()->user()->id_role != 3){
            return Excel::download(new TransaksiExport, date('his-dmY').'-'.auth()->user()->name.'.xlsx');
        }else{
            $barber = Barbershop::where('owner_id',auth()->user()->id)->first();
            return Excel::download(new TransaksiExport, date('his-dmY').'-'.$barber->name.'.xlsx');
        }
    }
}
