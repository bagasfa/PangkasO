<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Hairstyle;
use App\Barbershop;
use App\History;
use Validator;
use File;

class HairstyleController extends Controller
{
    // Halaman Male Hairstyle
    public function male(){
        $uID = auth()->user()->id;
        $barber = Barbershop::where('owner_id',$uID)->get()->first();
        $hairstyle = Hairstyle::where('gender','male')->where('barbershop_id',$barber->id)->get();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.BarbershopManagement.maleHairstyle',compact('barber','hairstyle'));
    }

    // Halaman Female Hairstyle
    public function female(){
        $uID = auth()->user()->id;
        $barber = Barbershop::where('owner_id',$uID)->get()->first();
        $hairstyle = Hairstyle::where('gender','female')->where('barbershop_id',$barber->id)->get();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Back.BarbershopManagement.femaleHairstyle',compact('barber','hairstyle'));
    }

    // Tambah Hairstyle
    public function add(Request $request){
        $error = array(
            'name.required' => 'Kolom Nama Barbershop tidak boleh kosong!',
            'images.required' => 'Mohon masukan gambar preview Hairstyle!',
            'images.mimes' => 'Mohon gunakan format gambar : .jpeg | .jpg | .png',
            'images.max' => 'Ukuran gambar anda melebihi 4MB!',
            'price.required' => 'Kolom Nomor Telpon tidak boleh kosong!'
        );

        $validateData = $request->validate([
            'images' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'name' => 'required',
            'price' => 'required'
        ],$error);

        $upImages = $request->barbershop_id.'-'.date('dmYhis').'.'.$request->images->getClientOriginalExtension();
        $request->images->move('assets/images/barbershop/hairstyle/',$upImages);

        $hairstyle = new Hairstyle;
        $hairstyle->name = $request->name;
        $hairstyle->gender = $request->gender;
        $hairstyle->price = $request->price;
        $hairstyle->deskripsi = $request->deskripsi;
        $hairstyle->barbershop_id = $request->barbershop_id;
        $hairstyle->images = $upImages;
        $hairstyle->save();

        // URL
        if($hairstyle->gender == 'male'){
            $url = 'owner-panel/hairstyle/male';
        }elseif($hairstyle->gender == 'female'){
            $url = 'owner-panel/hairstyle/female';
        }

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Tambah";
        $history->keterangan = "Akun '".auth()->user()->name."' menambahkan Hairstyle ".$hairstyle->name." pada Barbershopnya.";
        $history->save();

        return redirect($url)->with('success','Berhasil menambahkan Hairstyle');
    }

    // Edit Hairstyle (Kirim data-id ke Modal)
    public function edit($id)
    {
        $data = Hairstyle::find($id);

        if($data !=null){
            return response()->json([
                "message" => "Succes",
                "values" => $data,
            ]);
        }
        else{
            return response()->json([
                "message" => "Empty"
            ]);
            return response($res);
        }

    }

    // Update Hairstyle (Submit Final Data)
    public function update(Request $request, $id)
    {
        if($request->hasFile('images')){
            // Dengan Update Gambar
            $messsages = array(
                'name.required' => 'Kolom Nama Barbershop tidak boleh kosong!',
                'images.mimes' => 'Mohon gunakan format gambar : .jpeg | .jpg | .png',
                'images.max' => 'Ukuran gambar anda melebihi 4MB!',
                'price.required' => 'Kolom Nomor Telpon tidak boleh kosong!'
            );
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'images' => 'image|mimes:jpeg,png,jpg|max:4096',
                'price' => 'required'
            ],$messsages);

            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return response()->json([
                    'error' => $error,
                  ]);
             }else{
                $hairstyle = Hairstyle::find($id);
                $upImages = $hairstyle->barbershop_id.'-'.date('dmYhis').'.'.$request->images->getClientOriginalExtension();
                $request->images->move('assets/images/barbershop/hairstyle/',$upImages);
                File::delete('assets/images/barbershop/hairstyle/'.$hairstyle->images);

                $hairstyle->name = $request->name;
                $hairstyle->price = $request->price;
                $hairstyle->deskripsi = $request->deskripsi;
                $hairstyle->images= $upImages;
                $hairstyle->save();

                return response()->json([
                    'message' => 'Success'
                ]);
             }
        }else{
            // Tanpa Update Gambar
            $messsages = array(
                'name.required' => 'Kolom Nama Barbershop tidak boleh kosong!',
                'price.required' => 'Kolom Nomor Telpon tidak boleh kosong!'
            );
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'price' => 'required'
            ],$messsages);
            if ($validator->fails()) {
                $error = $validator->errors()->first();
                
                return response()->json([
                    'error' => $error,
                ]);
            }else{
                $hairstyle = Hairstyle::find($id);
                $hairstyle->name = $request->name;
                $hairstyle->price = $request->price;
                $hairstyle->deskripsi = $request->deskripsi;
                $hairstyle->save(); 
            
            return response()->json([
                'message' => 'Success'
            ]);
            }
        }

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Edit";
        $history->keterangan = "Akun '".auth()->user()->name."' mengubah data Hairstyle ".$hairstyle->name." pada Barbershopnya.";
        $history->save();
    }

    // Hapus Hairstyle
    public function destroy($id){
        $hairstyle = Hairstyle::find($id);
        File::delete('assets/images/barbershop/hairstyle/'.$hairstyle->images);

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Hapus";
        $history->keterangan = "Menghapus Hairstyle '".$hairstyle->name."'";
        $history->save();

        $hairstyle->delete();

        return response([
            'message' => 'deleted'
        ]);
    }
}
