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
          <div class="hero text-white hero-bg-image hero-bg-parallax" data-background="{{asset('assets/img/hero-banner.jpg')}}">
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
          <div class="hero text-white hero-bg-image hero-bg-parallax" data-background="{{asset('assets/img/hero-banner2.jpg')}}">
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
