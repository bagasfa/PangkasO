<form class="form-inline mr-auto">
  <ul class="navbar-nav mr-3">
    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
  </ul>
</form>
<ul class="navbar-nav navbar-right">
  <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
    @if(auth()->user()->avatar == !NULL)
      <img alt="image" src="{{url('assets/images/users/avatar/'.auth()->user()->avatar)}}" class="rounded-circle mr-1">
    @else
      <img alt="image" src="{{ asset('assets/img/dummy/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
    @endif
    <div class="d-sm-none d-lg-inline-block">Hi, {{auth()->user()->name}}</div></a>
    <div class="dropdown-menu dropdown-menu-right">
      <div class="dropdown-title">Welcome, {{auth()->user()->name}}</div>
      <a href="{{url('/admin-panel/profile')}}" class="dropdown-item has-icon">
        <i class="fas fa-user"></i> Profile
      </a>
      <a href="{{url('/admin-panel/password')}}" class="dropdown-item has-icon">
        <i class="fas fa-key"></i> Password
      </a>
      @if(auth()->user()->id_role == 3 && auth()->user()->verify_status == 'Approved')
        @if($barber->name == !NULL)
        <a href="{{url('/owner-panel/setting-barbershop')}}" class="dropdown-item has-icon">
          <i class="fas fa-cogs"></i> Barbershop Setting
        </a>
        @endif
      @endif
      @if(auth()->user()->id_role != 1 && auth()->user()->verify_status == 'Approved')
      <div class="dropdown-divider"></div>
      <a href="" data-toggle="modal" data-target="#deleteAccount" class="dropdown-item has-icon text-danger">
        <i class="fas fa-times"></i> Delete Account
      </a>
      @endif
      <div class="dropdown-divider"></div>
      <a href="{{url('/logout')}}" class="dropdown-item has-icon text-danger">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
    </div>
  </li>
</ul>
@push('modal')
<!-- Delete Account Modal-->
<div class="modal fade" id="deleteAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="{{url('/delete-account')}}" method="POST">
      <div class="modal-body">
        {{csrf_field()}}
        <p>Konfirmasi password jika anda ingin menghapus akun ini.</p>
        <div class="input-group" id="show_hide_password">
          <input name="password" type="password" class="form-control" placeholder="Password">
          <!-- Show Hide Password Component -->
          <a href=""><div class="input-group-addon eye">
            <i class="fa fa-eye-slash" aria-hidden="true"></i>
          </div></a>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Konfirmasi</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endpush