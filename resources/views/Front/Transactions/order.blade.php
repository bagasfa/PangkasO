@extends('Front.Template.layout')

@section('title','Orders')

@section('content')
<section class="section mb-4">
	<div class="container">
		<div class="section-body mt-4 mb-4">
			<a href="{{url('/orders/history')}}" class="badge badge-primary nounderline float-right mb-4">Order History</a>
			<h2 class="section-title">Orderan Saya</h2>

			<div class="row">
			  	<div class="col-12">
			    	<div class="activities">
                	@forelse($orders as $order)
        			@if($order->status == 'Pending')
		                <div class="activity">
		                    <div class="activity-icon bg-secondary text-white shadow-secondary">
		                		<i class="fa fa-clock"></i>
		                    </div>
		                    <div class="activity-detail">
		                      <div class="mb-2">
		                        <span class="text-job text-primary">{{$order->created_at->diffForHumans()}}</span>
		                        <span class="bullet"></span>
		                        <span class="text-job">
		                        	@if($order->jenis_layanan == 'COD')
		                        		COD
		                        	@else
		                        		Antrian Online
		                        	@endif
		                        </span>
		                        <div class="float-right dropdown">
		                          <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
		                          <div class="dropdown-menu">
		                            <div class="dropdown-title">Options</div>		                            
		                            <a href="#" class="dropdown-item has-icon"><i class="fas fa-comment-dots"></i> Chat</a>
		                            <div class="dropdown-divider"></div>
		                            <a href="{{ url('/orders/cancel/'.$order->id) }}" class="dropdown-item has-icon text-danger"><i class="fas fa-times"></i> Cancel Order</a>
		                          </div>
		                        </div>
		                      </div>
		                      <span>Status : Pending</span>
		                      <p>Hairstyle : {{$order->hairstyle->name}}</p>
		                      @if($order->pesan)
		                      <p align="justify">Pesan : {{$order->pesan}}</p>
		                      @else
		                      <p>Pesan : Tidak ada pesan.</p>
		                      @endif
		                      @if($order->jam_booking)
		                      <span>Jam COD : {{$order->jam_booking}}</span><br>
		                      @else
		                      @endif
		                      <div class="dropdown-divider"></div>
		                      <div class="form-group row px-2 mt-4">
		                      	<a href="https://www.google.com/maps/?q={{$order->lokasi}}" target="_blank" class="badge badge-success nounderline col-12 col-md-6 col-lg-6 mb-2">Lihat lokasi</a>
		                      	<p class="badge badge-primary col-12 col-md-6 col-lg-6 mb-2">Rp. <span class="uang">{{$order->harga}}</span></p>
		                      </div>
		                    </div>
		                </div>
          			@elseif($order->status == 'Confirmed')
		                <div class="activity">
		                    <div class="activity-icon bg-success text-white shadow-success">
		                		<i class="fa fa-check-circle"></i>
		                    </div>
		                    <div class="activity-detail">
		                      <div class="mb-2">
		                        <span class="text-job text-primary">{{$order->updated_at->diffForHumans()}}</span>
		                        <span class="bullet"></span>
		                        <span class="text-job">
		                        	@if($order->jenis_layanan == 'COD')
		                        		COD
		                        	@else
		                        		Antrian Online
		                        	@endif
		                        </span>
		                        <div class="float-right dropdown">
		                          <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
		                          <div class="dropdown-menu">
		                            <div class="dropdown-title">Options</div>		                            
		                            <a href="#" class="dropdown-item has-icon"><i class="fas fa-comment-dots"></i> Chat</a>
		                            <div class="dropdown-divider"></div>
		                            <a href="{{ url('/orders/cancel/'.$order->id) }}" class="dropdown-item has-icon text-danger"><i class="fas fa-times"></i> Cancel Order</a>
		                          </div>
		                        </div>
		                      </div>
		                      <span class="badge badge-success">{{$order->no_antri}}</span>
		                      <br>
		                      <span>Status : Dalam Antrian</span>
		                      <p>Hairstyle : {{$order->hairstyle->name}}</p>
		                      @if($order->pesan)
		                      <p align="justify">Pesan : {{$order->pesan}}</p>
		                      @else
		                      <p>Pesan : Tidak ada pesan.</p>
		                      @endif
		                      @if($order->jam_booking)
		                      <span>{{$order->jam_booking}}</span>
		                      @else
		                      @endif
		                      <div class="dropdown-divider"></div>
		                      <div class="form-group row px-2 mt-4">
		                      	<a href="https://www.google.com/maps/?q={{$order->lokasi}}" target="_blank" class="badge badge-success nounderline col-12 col-md-6 col-lg-6 mb-2">Lihat lokasi</a>
		                      	<p class="badge badge-primary col-12 col-md-6 col-lg-6 mb-2">Rp. <span class="uang">{{$order->harga}}</span></p>
		                      </div>
		                    </div>
		                </div>
	                @elseif($order->status == 'Requested')
		                <div class="activity">
		                    <div class="activity-icon bg-warning text-white shadow-warning">
		                		<i class="fa fa-undo-alt"></i>
		                    </div>
		                    <div class="activity-detail">
		                      <div class="mb-2">
		                        <span class="text-job text-primary">{{$order->updated_at->diffForHumans()}}</span>
		                        <span class="bullet"></span>
		                        <span class="text-job">
		                        	@if($order->jenis_layanan == 'COD')
		                        		COD
		                        	@else
		                        		Antrian Online
		                        	@endif
		                        </span>
		                        <div class="float-right dropdown">
		                          <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
		                          <div class="dropdown-menu">
		                            <div class="dropdown-title">Options</div>		                            
		                            <a href="#" class="dropdown-item has-icon"><i class="fas fa-comment-dots"></i> Chat</a>
		                            <div class="dropdown-divider"></div>
		                            <a href="{{ url('/orders/abort/'.$order->id) }}" class="dropdown-item has-icon text-danger"><i class="fas fa-times"></i> Cancel</a>
		                          </div>
		                        </div>
		                      </div>
		                      <span class="badge badge-success">{{$order->no_antri}}</span>
		                      <br>
		                      <span>Status : Request Pembatalan</span>
		                      <p>Hairstyle : {{$order->hairstyle->name}}</p>
		                      @if($order->pesan)
		                      <p align="justify">Pesan : {{$order->pesan}}</p>
		                      @else
		                      <p>Pesan : Tidak ada pesan.</p>
		                      @endif
		                      @if($order->jam_booking)
		                      <span>{{$order->jam_booking}}</span>
		                      @else
		                      @endif
		                      <div class="dropdown-divider"></div>
		                      <div class="form-group row px-2 mt-4">
		                      	<a href="https://www.google.com/maps/?q={{$order->lokasi}}" target="_blank" class="badge badge-success nounderline col-12 col-md-6 col-lg-6 mb-2">Lihat lokasi</a>
		                      	<p class="badge badge-primary col-12 col-md-6 col-lg-6 mb-2">Rp. <span class="uang">{{$order->harga}}</span></p>
		                      </div>
		                    </div>
		                </div>
          			@endif
        			@empty
	                  <div class="activity">
	                    <div class="activity-icon bg-danger text-white shadow-danger">
	                		<i class="fas fa-times"></i>
	                    </div>
	                    <div class="activity-detail">
	                      <div class="mb-2">
	                        <span class="text-job text-primary">Today</span>
	                        <span class="bullet"></span>
	                        <span class="text-job">
	                        	🙁
	                        </span>
	                        <div class="float-right dropdown">
	                          <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
	                          <div class="dropdown-menu">
	                            <div class="dropdown-title">So sad..</div>
	                          </div>
	                        </div>
	                      </div>
	                      <span>Kamu belum membuat orderan</span>
	                    </div>
	                  </div>
        			@endforelse
        			</div>
        		</div>
        	</div>
		</div>
	</div>
</section>
@endsection