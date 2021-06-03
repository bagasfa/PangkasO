@extends('Back.Template.layouts.app')

@section('title', 'Profile')

@section('content')
<section class="section">
  
  <div class="section-header">
    <h1>
      Update Profile
    </h1>
  </div>
  <center>
  <div class="section-body">
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
          <div class="card-body text-center">
            <div class="form-group">
                Bergabung sejak {{ auth()->user()->created_at->diffForHumans() }}
              </div>
            <form action="{{ url('/admin-panel/profile/update') }}" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
              <!-- Foto -->
              <div class="avatar-upload">
                <div class="avatar-edit">
                    <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg" />
                    <label for="imageUpload"></label>
                </div>
                @if(auth()->user()->avatar == !NULL)
                  <a href="{{ asset('assets/images/users/avatar/'.auth()->user()->avatar) }}" class="zoom">
                @else
                  <a href="{{ asset('assets/img/dummy/avatar/no-avatar.jpg') }}" class="zoom">
                @endif
                  <div class="avatar-preview">
                    @if(auth()->user()->avatar == !NULL)
                      <div id="imagePreview" style="background-image: url('{{url('assets/images/users/avatar/'.auth()->user()->avatar)}}');"></div>
                    @else
                      <div id="imagePreview" style="background-image: url('{{url('assets/img/dummy/avatar/no-avatar.jpg')}}');"></div>
                    @endif
                  </div>
                </a>
              </div>
              
              <!-- Nama -->
              <div class="form-group profile-input">
                <label for="inputNama">Nama</label>
                <input name="name" type="text" class="form-control" id="inputNama" placeholder="Nama" value="{{auth()->user()->name}}" required="">
              </div>
              <!-- Email -->
              <div class="form-group profile-input">
                  <label for="inputEmail">E-mail</label>
                  <input name="email" type="email" class="form-control" id="inputEmail" placeholder="E-Mail" value="{{auth()->user()->email}}" required="">
              </div>
              <!-- Gender -->
              <div class="form-group">
                <label for="gender">Jenis Kelamin</label><br>
                @if(auth()->user()->gender == 'L')
                <input class="form-check-input" type="radio" name="gender" value="L" id="gender" checked="">Laki - Laki
                <input class="form-check-input" type="radio" name="gender" value="P" id="gender">Perempuan
                @elseif(auth()->user()->gender == 'P')
                <input class="form-check-input" type="radio" name="gender" value="L" id="gender">Laki - Laki
                <input class="form-check-input" type="radio" name="gender" value="P" id="gender" checked="">Perempuan
                @endif
              </div>
              <!-- Phone -->
              <div class="form-group">
                <label for="phone">Nomor Telepon</label>
                <input name="phone" type="tel" class="form-control" id="phone" placeholder="Nomor Telepon" value="{{auth()->user()->phone_number}}" required="">
              </div>
              <!-- Address -->
              <div class="form-group">
                <label for="address">Alamat</label>
                <textarea name="address" id="address" class="form-control" required="">{{auth()->user()->address}}</textarea>
              </div>
              
              <br>
              <div class="form-group text-center">
                <a href="{{url('admin-panel/dashboard')}}">
                  <button type="button" class="btn btn-danger col-md-3 col-lg-3">BATAL</button>
                </a>
                <button type="submit" class="btn btn-primary col-md-3 col-lg-3">SIMPAN</button>
              </div>
              </form>
          </div>
        </div>
      </div>  
  </div>
</center>
</section>
@endsection
