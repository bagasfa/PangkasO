@extends('Back.Template.layouts.app')

@section('title', 'History Aktivitas')

@section('content')
<script type="text/javascript">
  document.getElementById('history').classList.add('active');
</script>
<section class="section">
  
  <div class="section-header">
    <h1>History Aktivitas</h1>
  </div>

  <div class="section-body">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">

          <div class="counter">
            <b>Total History</b> : {{$counter}}
          </div>

          <div class="card-body table-responsive">
              <div id="datatable-history"></div>
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
@push('javascript')
  <script src="{{asset('assets/js/AdminPanel/Dashboard/history.js')}}"></script>
@endpush
