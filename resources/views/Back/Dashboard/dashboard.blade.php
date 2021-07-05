@extends('Back.Template.layouts.app')

@if(auth()->user()->id_role == 1)
  @section('title', 'Super Admin Dashboard')
@elseif(auth()->user()->id_role == 2)
  @section('title', 'Admin Dashboard')
@endif

@section('content')
<script type="text/javascript">
  document.getElementById('dashboard').classList.add('active');
</script>
  <section class="section">
    <div class="section-header">
      @if(auth()->user()->id_role == 1)
      <h1>Dashboard Super Admin</h1>
      @elseif(auth()->user()->id_role == 2)
      <h1>Dashboard Admin</h1>
      @elseif(auth()->user()->id_role == 3)
      <h1>Dashboard Owner</h1>
      @endif
    </div>

    <div class="section-body">
      <div class="row">
        @if(auth()->user()->id_role == 3 && auth()->user()->verify_status != 'Approved')
        <!-- Hero Verifikasi -->
        <div class="col-12 mb-4">
          <div class="hero text-white hero-bg-image hero-bg-parallax" data-background="{{asset('assets/img/banner/hero-banner.jpg')}}">
            <div class="hero-inner">
              <h2>Welcome, {{auth()->user()->name}}!</h2>
              <p class="lead">Kamu telah berhasil menyelesaikan pendaftaranmu, ayo verifikasi data diri kamu agar bisa menggunakan semua fitur yang telah disediakan.</p>
              <div class="mt-4">
                <a href="{{url('owner-panel/get-verify')}}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i> Verify Account</a>
              </div>
            </div>
          </div>
        </div>
        <!-- End of Hero Verifikasi -->
        @elseif(auth()->user()->id_role == 3 && auth()->user()->verify_status == 'Approved' && $barber->name == NULL)
        <!-- Hero Setup Barbershop Account -->
        <div class="col-12 mb-4">
          <div class="hero text-white hero-bg-image hero-bg-parallax" data-background="{{asset('assets/img/banner/hero-banner2.jpg')}}">
            <div class="hero-inner">
              <h2>Selamat, {{auth()->user()->name}}!</h2>
              <p class="lead">Kamu telah berhasil mem-verifikasi identitasmu, satu langkah lagi kamu bisa menikmati semua fitur yang ada.</p>
              <div class="mt-4">
                <a href="{{url('owner-panel/setup-barbershop')}}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i> Setup Barbershop Data</a>
              </div>
            </div>
          </div>
        </div>
        <!-- End of Hero Setup Barbershop Account -->
        @endif
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Transaksi Terbaru</h4>
              <div class="card-header-action">
              @if(auth()->user()->id_role != 3)
              @else
                <a href="{{'/owner-panel/orders'}}" class="btn btn-primary">Lihat Semua <i class="fas fa-chevron-right"></i></a>
              @endif
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive table-invoice">
                <table class="table table-striped">
                  <tr>
                    <th>ID Transaksi</th>
                    <th>Customer</th>
                    @if(auth()->user()->id_role != 3)
                    <th>Barbershop</th>
                    @endif
                    <th>Jenis</th>
                    <th>Status</th>
                    <th>Transaksi</th>
                  </tr>
                  @forelse($transaksi as $trans)
                  <tr>
                    <td>{{$trans->no_antri}}</td>
                    <td class="font-weight-600">{{$trans->user->name}}</td>
                    @if(auth()->user()->id_role != 3)
                    <td class="font-weight-600">{{$trans->barbershop->name}}</td>
                    @endif
                    <td class="font-weight-600">
                    @switch($trans->jenis_layanan)
                      @case('COD')
                        Cash On Delivery
                        @break
                      @case('AO')
                        Antrian Online
                        @break
                    @endswitch
                    </td>
                    <td>
                    @switch($trans->status)
                      @case('Pending')
                      <div class="badge badge-secondary">{{$trans->status}}</div>
                        @break
                      @case('Confirmed')
                      <div class="badge badge-success">{{$trans->status}}</div>
                        @break
                      @case('Requested')
                      <div class="badge badge-warning">{{$trans->status}}</div>
                        @break
                      @case('Canceled')
                      <div class="badge badge-danger">{{$trans->status}}</div>
                        @break
                      @case('Completed')
                      <div class="badge badge-primary">{{$trans->status}}</div>
                        @break
                      @case('Rejected')
                      <div class="badge badge-danger">{{$trans->status}}</div>
                        @break
                    @endswitch
                    </td>
                    <td>{{$trans->updated_at->diffForHumans()}}</td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="5" align="center">Tidak ada Transaksi</td>
                  </tr>
                  @endforelse
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>
@endsection
@push('javascript')
  <script src="{{asset('assets/js/toastr.min.js')}}"></script>
  <!-- Toaster -->
  <script>
    @if(Session::has('message'))
      toastr.success("{{ Session::get('message') }}");
    @elseif(Session::has('bye'))
      toastr.error("{{ Session::get('bye') }}");
    @endif
  </script>

  <!-- Toastr Validation -->
  <script>
    @if($errors->any())
      @foreach($errors->all() as $error)
        toastr.error("{{ $error }}");
      @endforeach
    @endif
  </script>
@endpush
