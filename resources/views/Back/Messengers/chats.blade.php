@extends('Back.Template.layouts.app')

@section('title', 'Chats')

@section('content')
<section class="section">
	<div class="section-header">
    	<h1>Inbox</h1>
  	</div>
	<div class="row align-items-center justify-content-center">
	  <div class="col-12 col-sm-12 col-lg-12">
	    <div class="card">
	      <div class="card-header">
	        <h4>Who's Online?</h4>
	      </div>
	      <div class="card-body">
	        <ul class="list-unstyled list-unstyled-border">
	          <li class="media">
	            <img alt="image" class="mr-3 rounded-circle" width="50" src="{{ asset('assets/img/dummy/avatar/avatar-1.png') }}">
	            <div class="media-body">
	              <div class="mt-0 mb-1 font-weight-bold">Hasan Basri</div>
	              <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Online</div>
	            </div>
	          </li>
	          <li class="media">
	            <img alt="image" class="mr-3 rounded-circle" width="50" src="{{ asset('assets/img/dummy/avatar/avatar-1.png') }}">
	            <div class="media-body">
	              <div class="mt-0 mb-1 font-weight-bold">Bagus Dwi Cahya</div>
	              <div class="text-small font-weight-600 text-muted"><i class="fas fa-circle"></i> Offline</div>
	            </div>
	          </li>
	          <li class="media">
	            <img alt="image" class="mr-3 rounded-circle" width="50" src="{{ asset('assets/img/dummy/avatar/avatar-1.png') }}">
	            <div class="media-body">
	              <div class="mt-0 mb-1 font-weight-bold">Wildan Ahdian</div>
	              <div class="text-small font-weight-600 text-success"><i class="fas fa-circle"></i> Online</div>
	            </div>
	          </li>
	          <li class="media">
	            <img alt="image" class="mr-3 rounded-circle" width="50" src="{{ asset('assets/img/dummy/avatar/avatar-1.png') }}">
	            <div class="media-body">
	              <div class="mt-0 mb-1 font-weight-bold">Rizal Fakhri</div>
	              <div class="text-small font-weight-600 text-success"><i class="fas fa-circle"></i> Online</div>
	            </div>
	          </li>
	        </ul>
	      </div>
	    </div>
	  </div>
 	</div>
</section>
@endsection