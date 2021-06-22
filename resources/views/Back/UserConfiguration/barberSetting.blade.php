@extends('Back.Template.layouts.app')

@section('title', 'Barbershop Setting')

@section('content')
<section class="section">
  
  <div class="section-header">
    <h1>
      Setting Barbershop
    </h1>
  </div>
  <center>
  <div class="section-body">
    <div class="col-12">
        <div class="card">
          <div class="card-body text-center">
            <div class="form-group">
                Bergabung sejak {{ auth()->user()->created_at->diffForHumans() }}
              </div>
            <form action="{{ url('/owner-panel/update-barbershop') }}" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
              
              <!-- Nama -->
              <div class="form-group profile-input">
                <label for="inputNama">Nama Barbershop</label>
                <input name="name" type="text" class="form-control" id="inputNama" placeholder="Nama Barbershop" value="{{$barber->name}}">
              </div>
              <!-- Phone -->
              <div class="form-group profile-input">
                <label for="phone_number">Nomor Telepon</label>
                <input name="phone_number" type="tel" class="form-control" id="phone_number" placeholder="Nomor Telepon" value="{{$barber->phone_number}}">
              </div>
              <!-- Address -->
              <div class="form-group profile-input">
                <label for="address">Alamat</label>
                <textarea name="address" id="address" class="form-control" required="">{{$barber->address}}</textarea>
              </div>
              
              <br>
              <div class="form-group text-center">
                <button type="submit" class="btn btn-primary col">SIMPAN</button>
              </div>
              </form>
          </div>
        </div>
      </div>  
  </div>
</center>
</section>
@endsection