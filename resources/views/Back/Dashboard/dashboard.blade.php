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
