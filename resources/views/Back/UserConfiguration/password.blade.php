@extends('Back.Template.layouts.app')

@section('title', 'Password')

@section('content')
<section class="section">
  
  <div class="section-header">
    <h1>
      Ganti Password
    </h1>
  </div>
  
  <div class="section-body">
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
          <div class="card-header">
            <a href="{{ redirect()->back()->getTargetUrl() }}"> 
              <button type="button" class="btn btn-outline-danger">
                <i class="fas fa-arrow-circle-left"></i> Kembali
              </button>
          </a>
          </div>
          <div class="card-body">
            <form action="{{ url('/admin-panel/updatePassword') }}" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="form-group">
                <label for="oldPassword">Password Lama <i style="color: red;">*</i></label>
                <div class="input-group" id="show_hide_password">
                  <input name="oldPassword" type="password" class="form-control" id="oldPassword" required="">
                  <a href=""><div class="input-group-addon eye">
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                  </div></a>
                </div>
              </div><hr>

              <div class="form-group">
                <label for="newPassword">Password Baru <i style="color: red;">*</i></label>
                <div class="input-group" id="show_hide_password">
                  <input name="newPassword" type="password" class="form-control" id="newPassword" required="">
                  <a href=""><div class="input-group-addon eye">
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                  </div></a>
                </div>
              </div>

              <div class="form-group">
                <label for="confirmPassword">Konfirmasi Password Baru <i style="color: red;">*</i></label>
                <div class="input-group" id="show_hide_password">
                  <input name="confirmPassword" type="password" class="form-control" id="confirmPassword" required="">
                  <a href=""><div class="input-group-addon eye">
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                  </div></a>
                </div>
              </div>

              <span><i style="color: red;">*</i> : Required</span>
              
              <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
              </div>
              </form>
          </div>
        </div>
      </div>  
  </div>

</section>
@endsection
@push('javascript')
<script src="{{asset('assets/js/bootstrap-show-password.js')}}"></script>
@endpush