@extends('Front.Template.layout')

@section('title','Orders History')

@section('content')
<section class="section mb-4">
	<div class="container">
		<div class="section-body mt-4 mb-4">
			<h2 class="section-title"><i class="fa fa-history"></i> Order History</h2>

			<div class="row">
			  	<div class="col-12">
			    	<div class="activities">
                	@forelse($orders as $order)
	                @if($order->status == 'Completed')
		                <div class="activity">
		                    <div class="activity-icon bg-primary text-white shadow-primary">
		                		<i class="fa fa-check"></i>
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
		                      <span>Status : Selesai</span>
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
		                      @if($order->hairstyle_rating == NULL)
		                      <!-- Hairstyle Rating -->
		                      <form class="form-horizontal" action="{{url('/rating/hairstyle/'.$order->hairstyle_id)}}" id="hairstyleStar" method="POST">
								{{ csrf_field() }}
							        <div class="form-group required">
							        	<input type="hidden" name="order_id" value="{{$order->id}}">
							        	<h6>Hairstyle Rating</h6>
							          <div class="col-sm-12 rating">
							            <label>
										    <input type="radio" class="star" name="hairstyle" value="1" />
										    <span class="icon">★</span>
										  </label>
										  <label>
										    <input type="radio" class="star" name="hairstyle" value="2" />
										    <span class="icon">★</span>
										    <span class="icon">★</span>
										  </label>
										  <label>
										    <input type="radio" class="star" name="hairstyle" value="3" />
										    <span class="icon">★</span>
										    <span class="icon">★</span>
										    <span class="icon">★</span>   
										  </label>
										  <label>
										    <input type="radio" class="star" name="hairstyle" value="4" />
										    <span class="icon">★</span>
										    <span class="icon">★</span>
										    <span class="icon">★</span>
										    <span class="icon">★</span>
										  </label>
										  <label>
										    <input type="radio" class="star" name="hairstyle" value="5" />
										    <span class="icon">★</span>
										    <span class="icon">★</span>
										    <span class="icon">★</span>
										    <span class="icon">★</span>
										    <span class="icon">★</span>
										  </label>
							          </div>
							        </div>
							  </form>
							  <!-- Hairstyle Rating -->
							  @else
							  @endif
							  @if($order->barbershop_rating == NULL)
							  <!-- Barbershop Rating -->
		                      <form class="form-horizontal" action="{{url('/rating/barbershop/'.$order->barbershop_id)}}" id="barbershopStar" method="POST">
								{{ csrf_field() }}
						        <div class="form-group required">
						        	<input type="hidden" name="order_id" value="{{$order->id}}">
						        	<h6>Rating Pelayanan</h6>
						          <div class="col-sm-12 rating">
					              	<label>
								    	<input type="radio" class="star" name="barbershop" value="1" />
								    	<span class="icon">★</span>
								  	</label>
								  	<label>
								    	<input type="radio" class="star" name="barbershop" value="2" />
								    	<span class="icon">★</span>
								    	<span class="icon">★</span>
								  	</label>
								  	<label>
								    	<input type="radio" class="star" name="barbershop" value="3" />
								    	<span class="icon">★</span>
								    	<span class="icon">★</span>
								    	<span class="icon">★</span>   
								  	</label>
								  	<label>
								    	<input type="radio" class="star" name="barbershop" value="4" />
								    	<span class="icon">★</span>
								    	<span class="icon">★</span>
								    	<span class="icon">★</span>
								    	<span class="icon">★</span>
								  	</label>
								  	<label>
								    	<input type="radio" class="star" name="barbershop" value="5" />
								    	<span class="icon">★</span>
								    	<span class="icon">★</span>
								    	<span class="icon">★</span>
								    	<span class="icon">★</span>
								    	<span class="icon">★</span>
								  	</label>
						          </div>
						        </div>
							  </form>
							<!-- Barbershop Rating -->
							@else
							@endif
		                    </div>
		                </div>
	                @elseif($order->status == 'Canceled')
	                	<div class="activity">
		                    <div class="activity-icon bg-danger text-white shadow-danger">
		                		<i class="fa fa-times"></i>
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
		                      <span class="badge badge-danger">{{$order->no_antri}}</span>
		                      <br>
		                      <span>Status : Dibatalkan</span>
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
		            @elseif($order->status == 'Rejected')
	                	<div class="activity">
		                    <div class="activity-icon bg-danger text-white shadow-danger">
		                		<i class="fa fa-ban"></i>
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
		                      <span class="badge badge-danger">{{$order->no_antri}}</span>
		                      <br>
		                      <span>Status : Ditolak</span>
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