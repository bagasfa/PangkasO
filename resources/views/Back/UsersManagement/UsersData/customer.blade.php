@extends('Back.Template.layouts.app')

@section('title', '(Customer) Users Data')

@section('content')
<script type="text/javascript">
  document.getElementById('users').classList.add('active');
</script>
<section class="section">
  
  <div class="section-header">
    <h1>User Data - Customer</h1>
  </div>

  <div class="section-body">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <form method="GET" class="form-inline">
              <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Customer" value="{{ request()->get('search') }}">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Cari</button>
              </div>
            </form>
          </div>
          <div class="counter">
            <b>Total Customer</b> : {{$counter}}
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
                @forelse($customer as $key => $c)
                <tr>
                  <td align="center">{{ $customer->firstItem() + $key }}</td>
                  <td style="padding-top: 10px; padding-bottom: 10px;" align="center">
                    @if($c->avatar == !NULL)
                      <a href="{{url('assets/images/users/avatar/'.$c->avatar)}}" class="zoom">
                        <img src="{{url('assets/images/users/avatar/'.$c->avatar)}}" class="rounded-circle mr-1" width="100px" height="100px">
                      </a>
                    @else
                      <a href="{{ asset('assets/img/dummy/avatar/no-avatar.jpg') }}" class="zoom">
                        <img src="{{ asset('assets/img/dummy/avatar/no-avatar.jpg') }}" class="rounded-circle mr-1" width="100px" height="100px">
                      </a>
                    @endif
                  </td>
                  <td align="center">{{ $c->name }}</td>
                  <td align="center">{{ $c->email }}</td>
                  <td align="center">{{ $c->gender }}</td>
                  <td align="center">{{ $c->phone_number }}</td>
                  <td align="center">{{ $c->address }}</td>
                  <td align="center">{{ $c->identity }}</td>
                  <td align="center">{{ $c->created_at }}</td>
                  <td align="center">
                    <a href="{{url('/admin-panel/customers/'.$c->id. '/edit')}}">
                      <button type="button" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="left" title="Edit">
                        <i class="fas fa-edit"></i>
                      </button>
                    </a>
                    &nbsp;
                    <a href="{{url('/admin-panel/customers/'.$c->id. '/delete')}}">
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
            <div class="pull-right">{{ $customer->links() }}</div>
          </div>
          <div class="card-footer text-right">
            <nav class="d-inline-block">
              
            </nav>
          </div>
        </div>
    </div>  
  </div>
</section>
@endsection
