@extends('Back.Template.layouts.app')

@section('title', '(Owner) Users Data')

@section('content')
<script type="text/javascript">
  document.getElementById('users').classList.add('active');
</script>
<section class="section">
  
  <div class="section-header">
    <h1>User Data - Owner</h1>
  </div>

  <div class="section-body">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <button type="button" class="btn btn-primary" id="btn-modal-owner"><i class="fa fa-plus"></i> Tambah Owner</button>
          </div>

          <div class="counter">
            <b>Total Owner</b> : {{$counter}}
          </div>

          <div class="card-body table-responsive">
              <div id="datatable-owner"></div>
          </div>
          
        </div>
    </div>  
  </div>
</section>

<!-- Add Owner Modal-->
<div class="modal fade" id="OwnerModal" tabindex="-1" role="dialog" aria-labelledby="AddOwnerModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="AddOwnerModal">Tambah Owner</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
          <form accept-charset="utf-8" id="FormOwner" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group">
              <label for="name">Nama Lengkap <i style="color: red;">*</i></label>
              <input name="name" type="text" class="form-control" id="name" placeholder="Nama Lengkap" required="">
            </div>
            <!-- Email -->
            <div class="form-group">
              <label for="email">Email <i style="color: red;">*</i></label>
              <input name="email" type="email" class="form-control" id="email" placeholder="E-Mail" required="">
            </div>
            <!-- Password -->
            <div class="form-group">
              <label for="password">Default Password <i style="color: red;">*</i></label>
              <div class="input-group" id="show_hide_password">
                <input name="password" type="password" minlength="8" class="form-control" id="password" placeholder="Password" required="">
              <a href=""><div class="input-group-addon eye">
                <i class="fa fa-eye-slash" aria-hidden="true"></i>
              </div></a>
            </div>
            <!-- Phone -->
            <div class="form-group">
              <label for="phone_number">Nomor Telepon <i style="color: red;">*</i></label>
              <input name="phone_number" type="tel" class="form-control" id="phone_number" placeholder="Nomor Telepon" required="">
            </div>
            <br>
            <span style="font-size: 12px;"><i style="color: red;"> * </i> : Data harus terisi</span>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary btn-submit-owner">Submit</button>
            <button class="btn btn-primary btn-loading" type="button" style="display: none;" disabled>
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Memproses...
            </button>
          </form>
        </div>
    </div>
  </div>
</div>

@endsection
@push('javascript')
<script src="{{asset('assets/js/bootstrap-show-password.js')}}"></script>
<script src="{{asset('assets/js/AdminPanel/UsersManagement/usersData.js')}}"></script>
@endpush
