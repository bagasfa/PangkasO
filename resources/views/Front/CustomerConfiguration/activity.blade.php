@extends('Front.Template.layout')

@section('title','Activity')

@section('content')
<section class="section mb-4">
	<div class="container">
		<div class="section-body mt-4 mb-4">
			<h2 class="section-title">Activity History</h2>
			<div class="row">
			  <div class="col-12">
			    <div class="activities">
			    	<!-- Activity -->
			    @forelse($activity as $history)
			      <div class="activity">
			        <div class="activity-icon bg-primary text-white shadow-primary">
			        @switch($history->aksi)
			        	@case('Login')
			        	<i class="fas fa-sign-in-alt"></i>
			        		@break
			        	@case('Register')
			        	<i class="fas fa-signature"></i>
			        		@break
			        	@case('Order')
			        	<i class="fas fa-shopping-cart"></i>
			        		@break
			        	@case('Confirm')
			        	<i class="fa fa-check-circle"></i>
			        		@break
			        	@case('Reject')
			        	<i class="fas fa-ban"></i>
			        		@break
			        	@case('Request')
			        	<i class="fas fa-undo"></i>
			        		@break
			        	@case('Complete')
			        	<i class="fas fa-check"></i>
			        		@break
			        	@case('Cancel')
			        	<i class="fas fa-times"></i>
			        		@break
			        	@case('Tambah')
			        	<i class="fas fa-plus"></i>
			        		@break
			        	@case('Edit')
			        	<i class="fas fa-pencil-alt"></i>
			        		@break
			        	@case('Hapus')
			        	<i class="fas fa-trash-alt"></i>
			        		@break
			        	@case('Rate')
			        	<i class="fas fa-star text-warning"></i>
			        		@break
			        @endswitch
			        </div>
			        <div class="activity-detail">
			          <div class="mb-2">
			            <span class="text-job text-primary">{{$history->created_at->diffForHumans()}}</span>
			            <span class="bullet"></span>
			            <span class="text-job">{{$history->aksi}}</span>
			            <div class="float-right dropdown">
			              <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
			              <div class="dropdown-menu">
			                <div class="dropdown-title">Detail</div>
			                <div class="dropdown-title">Aksi : {{$history->aksi}}</div>
			                <div class="dropdown-title">{{$history->created_at}}</div>
			              </div>
			            </div>
			          </div>
			          <p>{{$history->keterangan}}</p>
			        </div>
			      </div>
			    @empty
			    @endforelse
			   		<!-- End of Activity -->
			    </div>
			  </div>
			</div>
		</div>
	</div>
</section>
@endsection
@push('stylesheet')
	<style type="text/css">
		.float-right{
			float: right;
		}
	</style>
@endpush