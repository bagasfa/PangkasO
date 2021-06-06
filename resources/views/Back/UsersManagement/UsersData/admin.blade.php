@extends('Back.Template.layouts.app')

@section('title', '(Admin) Users Data')

@section('content')
<script type="text/javascript">
  document.getElementById('users').classList.add('active');
</script>
<section class="section">
  
  <div class="section-header">
    <h1>User Data - Admin</h1>
  </div>

  <div class="section-body">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <form method="GET" class="form-inline">
              <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Admin" value="{{ request()->get('search') }}">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Cari</button>
              </div>
            </form>
          </div>
          <div class="card-header">
            @if(auth()->user()->id_role == 1)
            <button type="button" data-toggle="modal" data-target="#addData" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Admin</button>
            @endif
          </div>
          <div class="counter">
            <b>Total Admin</b> : {{$counter}}
          </div>

          <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col" width="100px"><center>#</center></th>
                  <th scope="col">Avatar</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Email</th>
                  <th scope="col">Jenis Kelamin</th>
                  <th scope="col">No. Telepon</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Identitas</th>
                  <th scope="col"><center>Bergabung</center></th>
                  <th scope="col"><center>Aksi</center></th>
                </tr>
              </thead>
              <tbody>
                @forelse($admin as $key => $a)
                <tr>
                  <td align="center">{{ $admin->firstItem() + $key }}</td>
                  <td style="padding-top: 10px; padding-bottom: 10px;" align="center">
                    @if($a->avatar == !NULL)
                      <a href="{{url('assets/images/users/avatar/'.$a->avatar)}}" class="zoom">
                        <img src="{{url('assets/images/users/avatar/'.$a->avatar)}}" class="rounded-circle mr-1" width="100px" height="100px">
                      </a>
                    @else
                      <a href="{{ asset('assets/img/dummy/avatar/no-avatar.jpg') }}" class="zoom">
                        <img src="{{ asset('assets/img/dummy/avatar/no-avatar.jpg') }}" class="rounded-circle mr-1" width="100px" height="100px">
                      </a>
                    @endif
                  </td>
                  <td align="center">{{ $a->name }}</td>
                  <td align="center">{{ $a->email }}</td>
                  <td align="center">{{ $a->gender }}</td>
                  <td align="center">{{ $a->phone_number }}</td>
                  <td align="center">{{ $a->address }}</td>
                  <td align="center">{{ $a->identity }}</td>
                  <td align="center">{{ $a->created_at }}</td>
                  <td align="center">
                    <a href="{{url('/admin-panel/admins/'.$a->id. '/edit')}}">
                      <button type="button" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="left" title="Edit">
                        <i class="fas fa-edit"></i>
                      </button>
                    </a>
                    &nbsp;
                    <a href="{{url('/admin-panel/admins/'.$a->id. '/delete')}}">
                      <button type="button" class="btn btn-outline-danger" data-toggle="tooltip" data-placement="right" title="Hapus">
                        <i class="fas fa-trash"></i>
                      </button>
                    </a>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="10"><center>Data kosong</center></td>
                </tr>
                @endforelse
              </tbody>
            </table>
            <div class="pull-right">{{ $admin->links() }}</div>
          </div>
          <div class="card-footer text-right">
            <nav class="d-inline-block">
              
            </nav>
          </div>
        </div>
    </div>  
  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="addData" tabindex="-1" role="dialog" aria-labelledby="addData" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 
      <div class="modal-header">
        <h5 class="modal-title" id="DataLabel">Tambah Data Admin</h5>
      </div>
      <div class="modal-body">
    <form action="{{url('/admin-panel/admins/add')}}" method="POST">
    {{csrf_field()}}
    <!-- Nama -->
      <div class="form-group">
        <label for="inputNama">Nama Lengkap <i style="color: red;">*</i></label>
        <input name="name" type="text" class="form-control" id="inputNama" placeholder="Nama Lengkap" required="">
      </div>
      <!-- Email -->
      <div class="form-group">
        <label for="inputEmail">Email <i style="color: red;">*</i></label>
        <input name="email" type="email" class="form-control" id="inputEmail" placeholder="E-Mail" required="">
      </div>
      <!-- Password -->
      <div class="form-group">
        <label for="inputPassword">Password <i style="color: red;">*</i></label>
        <div class="input-group" id="show_hide_password">
          <input name="password" type="password" minlength="8" class="form-control" id="inputPassword" placeholder="Password" required="">
        <a href=""><div class="input-group-addon eye">
          <i class="fa fa-eye-slash" aria-hidden="true"></i>
        </div></a>
      </div>
      <!-- Gender -->
      <div class="form-group">
        <label for="gender">Jenis Kelamin <i style="color: red;">*</i></label><br>
        <input class="form-check-input" type="radio" name="gender" value="L" id="gender" checked="">Laki - Laki
        <input class="form-check-input" type="radio" name="gender" value="P" id="gender">Perempuan
      </div>
      <!-- Phone -->
      <div class="form-group">
        <label for="phone">Nomor Telepon <i style="color: red;">*</i></label>
        <input name="phone" type="tel" class="form-control" id="phone" placeholder="Nomor Telepon" required="">
      </div>
      <!-- Address -->
      <div class="form-group">
        <label for="address">Alamat <i style="color: red;">*</i></label>
        <textarea name="address" id="address" class="form-control" required=""></textarea>
      </div>

      <!-- Upload image input-->
      <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
        <input id="upload" type="file" name="avatar" onchange="readURL(this);" class="form-control">
        <label id="upload-label" for="upload" class="font-weight-light text-muted">Upload Foto disini ...</label>
        <div class="input-group-append">
          <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2"></i><small style="font-size: 12px;" class="text-bold">Pilih Foto</small></label>
        </div>
      </div>

      <!-- Uploaded image area-->
      <p class="font-italic text-center">Gambar preview akan ditampilkan dibawah</p>
      <div class="image-area mt-4"><img id="imageResult" src="#" alt="" width="300px" height="300px" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
      <!-- Hidden Role -->
      <input type="hidden" name="role" value="2">
      <br>
      <span style="font-size: 12px;"><i style="color: red;"> * </i> : Data harus terisi</span>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
      <button type="submit" class="btn btn-primary">Tambahkan</button>
      </form>
    </div>
  </div>
</div>
<!-- Modal -->
@endsection
