@extends('Front.Template.layout')

@section('title','Antrian Saat ini')

@section('content')
<section class="section mb-4">
	<div class="container">
		<div class="section-body mt-4 mb-4">
			<h2 class="section-title">Antrian saat ini pada {{$barber->name}}</h2>

			<div class="row">
			  	<div class="col-12">
			    	<div class="activities">
                	@forelse($orderList as $order)
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
		                      </div>
		                      <span class="badge badge-success">{{$order->no_antri}}</span>
		                      <br>
		                      <br>
		                      <p class="badge badge-success">Pemesan : {{$order->user->name}}</p>
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
        			@empty
        			<div class="col-12">
			            <div class="card">
			              <div class="card-body">
			                <div class="empty-state" data-height="400">
			                  <div class="empty-state-icon">
			                    <i class="fas fa-times"></i>
			                  </div>
			                  <h2>Tidak ada antrian saat ini</h2>
			                  <p class="lead">
			                    Asik nih antrian lagi kosong, kamu bisa menjadi yang pertama dalam antrian.
			                  </p>
			                  <a href="{{ url('/hairstyle') }}" class="btn btn-primary mt-4">Order Sekarang</a>
			                </div>
			              </div>
			            </div>
			        </div> <!-- col.// -->
        			@endforelse
        			</div>
        		</div>
        	</div>
		</div>
	</div>
</section>
@endsection