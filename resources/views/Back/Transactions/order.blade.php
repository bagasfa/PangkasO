@extends('Back.Template.layouts.app')

@section('title','Order List')

@section('content')
<script type="text/javascript">
  document.getElementById('orders').classList.add('active');
</script>
<section class="section">
  
  <div class="section-header">
    <h1>
    	Order List
    </h1>
  </div>
  <div class="section-body">
  	<div class="row">
  		<!-- Pending -->
  		<div class="col-12 col-md-4 col-lg-4">
          	<h2 class="section-title">Order Pending</h2>
            <div class="row">
              <div class="col-12">
                <div class="activities">
                @forelse($pending as $p)
                  	<div class="activity">
	                    <div class="activity-icon bg-secondary text-white shadow-secondary">
	                		<i class="fa fa-clock"></i>
	                    </div>
	                    <div class="activity-detail">
	                      <div class="mb-2">
	                        <span class="text-job text-primary">{{$p->created_at->diffForHumans()}}</span>
	                        <span class="bullet"></span>
	                        <span class="text-job">
	                        	@if($p->jenis_layanan == 'COD')
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
	                            <a href="{{ url('/owner-panel/orders/confirm/'.$p->id) }}" class="dropdown-item has-icon text-success"><i class="fas fa-check"></i> Terima</a>
                            	<a href="{{ url('/owner-panel/orders/reject/'.$p->id) }}" class="dropdown-item has-icon text-danger"><i class="fas fa-times"></i> Tolak</a>
	                          </div>
	                        </div>
	                      </div>
	                      <span>Status : Pending</span>
	                      <p>Hairstyle : {{$p->hairstyle->name}}</p>
	                      @if($p->pesan)
	                      <p align="justify">Pesan : {{$p->pesan}}</p>
	                      @else
	                      <p>Pesan : Tidak ada pesan.</p>
	                      @endif
	                      @if($p->jam_booking)
	                      <span>{{$p->jam_booking}}</span>
	                      @else
	                      @endif
	                      <div class="dropdown-divider"></div>
		                    <div class="form-group row px-2 mt-4">
	                      @if($p->jenis_layanan == 'COD')
	                      	<a href="https://www.google.com/maps/?q={{$p->lokasi}}" target="_blank" class="badge badge-success nounderline col-12 col-md-6 col-lg-6 mb-2">Lihat lokasi</a>
	                      @endif
	                      	<p class="badge badge-primary col-12 col-md-6 col-lg-6 mb-2">Rp. <span class="uang">{{$p->harga}}</span></p>
		                    </div>
	                    </div>
	                </div>
            	@empty
	                <div class="activity">
	                    <div class="activity-icon bg-danger text-white shadow-danger">
	                		<i class="fa fa-times"></i>
	                    </div>
	                    <div class="activity-detail">
	                      <div class="mb-2">
	                        <span class="text-job text-primary">Today</span><span>🙁</span>
	                        <div class="float-right dropdown">
	                          <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
	                          <div class="dropdown-menu">
	                            <div class="dropdown-title">So sad..</div>
	                          </div>
	                        </div>
	                      </div>
	                      <span>Tidak ada orderan yang di terima</span>
	                    </div>
                  	</div>
            	@endforelse
            	</div>
              </div>
            </div>
  		</div>
  		<!-- Request Pembatalan -->
  		<div class="col-12 col-md-4 col-lg-4">
          	<h2 class="section-title">Request Pembatalan Order</h2>
            <div class="row">
              <div class="col-12">
                <div class="activities">
                @forelse($request as $r)
                  	<div class="activity">
	                    <div class="activity-icon bg-warning text-white shadow-warning">
	                		<i class="fa fa-undo-alt"></i>
	                    </div>
	                    <div class="activity-detail">
	                      <div class="mb-2">
	                        <span class="text-job text-primary">{{$r->updated_at->diffForHumans()}}</span>
	                        <span class="bullet"></span>
	                        <span class="text-job">
	                        	@if($r->jenis_layanan == 'COD')
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
	                            <a href="{{ url('/owner-panel/orders/cancel/'.$r->id) }}" class="dropdown-item has-icon text-success"><i class="fas fa-check"></i> Konfirmasi</a>
                            	<a href="{{ url('/owner-panel/orders/confirm/'.$r->id) }}" class="dropdown-item has-icon text-danger"><i class="fas fa-times"></i> Tolak</a>
	                          </div>
	                        </div>
	                      </div>
	                      <span class="badge badge-success">{{$r->no_antri}}</span>
	                      <br><br>
	                      <span>Pemesan : {{$r->user->name}}</span>
	                      <br>
	                      <span>Status : Request Pembatalan</span>
	                      <p>Hairstyle : {{$r->hairstyle->name}}</p>
	                      @if($r->pesan)
	                      <p align="justify">Pesan : {{$r->pesan}}</p>
	                      @else
	                      <p>Pesan : Tidak ada pesan.</p>
	                      @endif
	                      @if($r->jam_booking)
	                      <span>{{$r->jam_booking}}</span>
	                      @else
	                      @endif
	                      <div class="dropdown-divider"></div>
	                      <div class="form-group row px-2 mt-4">
	                      @if($r->jenis_layanan == 'COD')
	                      	<a href="https://www.google.com/maps/?q={{$r->lokasi}}" target="_blank" class="badge badge-success nounderline col-12 col-md-6 col-lg-6 mb-2">Lihat lokasi</a>
	                      @endif
	                      	<p class="badge badge-primary col-12 col-md-6 col-lg-6 mb-2">Rp. <span class="uang">{{$r->harga}}</span></p>
	                      </div>
	                    </div>
	                </div>
            	@empty
                  	<div class="activity">
	                    <div class="activity-icon bg-danger text-white shadow-danger">
	                		<i class="fa fa-times"></i>
	                    </div>
	                    <div class="activity-detail">
	                      <div class="mb-2">
	                        <span class="text-job text-primary">Today</span><span>🙂</span>
	                        <div class="float-right dropdown">
	                          <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
	                          <div class="dropdown-menu">
	                            <div class="dropdown-title">So Happy..</div>
	                          </div>
	                        </div>
	                      </div>
	                      <span>Tidak ada permintaan pembatalan order</span>
	                    </div>
                  	</div>
            	@endforelse
            	</div>
              </div>
            </div>
  		</div>
  		<!-- Accepted -->
  		<div class="col-12 col-md-4 col-lg-4">
          	<h2 class="section-title">Order Dikonfirmasi</h2>
            <div class="row">
              <div class="col-12">
                <div class="activities">
                @forelse($confirmed as $c)
                  	<div class="activity">
	                    <div class="activity-icon bg-success text-white shadow-success">
	                		<i class="fa fa-check"></i>
	                    </div>
	                    <div class="activity-detail">
	                      <div class="mb-2">
	                        <span class="text-job text-primary">{{$c->updated_at->diffForHumans()}}</span>
	                        <span class="bullet"></span>
	                        <span class="text-job">
	                        	@if($c->jenis_layanan == 'COD')
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
	                            <a href="{{ url('/owner-panel/orders/complete/'.$c->id) }}" class="dropdown-item has-icon text-success"><i class="fas fa-check"></i> Selesai</a>
	                            <a href="" data-id="{{$c->id}}" class="dropdown-item has-icon text-danger btn-cancel-order"><i class="fas fa-times"></i> Batalkan Order</a>
	                          </div>
	                        </div>
	                      </div>
	                      <span class="badge badge-success">{{$c->no_antri}}</span>
	                      <br><br>
	                      <span>Pemesan : {{$c->user->name}}</span>
	                      <br>
	                      <span>Status : Dalam Antrian</span>
	                      <p>Hairstyle : {{$c->hairstyle->name}}</p>
	                      @if($c->pesan)
	                      <p align="justify">Pesan : {{$c->pesan}}</p>
	                      @else
	                      <p>Pesan : Tidak ada pesan.</p>
	                      @endif
	                      @if($c->jam_booking)
	                      <span>{{$c->jam_booking}}</span>
	                      @else
	                      @endif
	                      <div class="dropdown-divider"></div>
	                      <div class="form-group row px-2 mt-4">
	                      @if($c->jenis_layanan == 'COD')
	                      	<a href="https://www.google.com/maps/?q={{$c->lokasi}}" target="_blank" class="badge badge-success nounderline col-12 col-md-6 col-lg-6 mb-2">Lihat lokasi</a>
	                      @endif
	                      	<p class="badge badge-primary col-12 col-md-6 col-lg-6 mb-2">Rp. <span class="uang">{{$c->harga}}</span></p>
	                      </div>
	                    </div>
                  	</div>
            	@empty
                  	<div class="activity">
	                    <div class="activity-icon bg-danger text-white shadow-danger">
	                		<i class="fa fa-times"></i>
	                    </div>
	                    <div class="activity-detail">
	                      <div class="mb-2">
	                        <span class="text-job text-primary">Today</span><span>🙁</span>
	                        <div class="float-right dropdown">
	                          <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
	                          <div class="dropdown-menu">
	                            <div class="dropdown-title">So sad..</div>
	                          </div>
	                        </div>
	                      </div>
	                      <span>Belum ada orderan yang di terima</span>
	                    </div>
                  	</div>
            	@endforelse
            	</div>
              </div>
          	</div>
  		</div>
  	</div>
    
  </div>
</section>
@endsection
@push('modal')
<!-- Cancel Modal-->
<div class="modal fade" id="cancelOrder" tabindex="-1" role="dialog" aria-labelledby="cancelOrder" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Cancel Order</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="{{url('/owner-panel/orders/cancel')}}" method="post">
      <div class="modal-body">
        <input type="hidden" name="id">
        <textarea name="pesan" id="pesan" class="form-control" placeholder="Alasan Pembatalan Order" required></textarea>
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-primary">Konfirmasi</button>
      </div>
    </div>
  </div>
</div>
@endpush
@push('javascript')
	<script src="{{asset('assets/js/AdminPanel/Transaksi/transaksi.js')}}"></script>
@endpush