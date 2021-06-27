@extends('Back.Template.layouts.app')

@section('title', 'Barbershop Data')

@section('content')
<script type="text/javascript">
  document.getElementById('barbershop').classList.add('active');
</script>
<section class="section">
  
  <div class="section-header">
    <h1>Barbershop Data</h1>
  </div>

  <div class="section-body">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">

          <div class="counter">
            <b>Total Barbershop</b> : {{$counter}}
          </div>

          <div class="card-body table-responsive">
              <div id="datatable-barbershop"></div>
          </div>

        </div>
    </div>  
  </div>
</section>
@endsection
@push('javascript')
  <script src="{{asset('assets/js/AdminPanel/Barbershop/barbershop.js')}}"></script>
@endpush
