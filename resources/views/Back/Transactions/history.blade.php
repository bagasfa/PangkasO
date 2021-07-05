@extends('Back.Template.layouts.app')

@section('title','Order History')

@section('content')
<script type="text/javascript">
  document.getElementById('order-history').classList.add('active');
</script>
<section class="section">
  
  <div class="section-header">
    <h1>
    	Transactions History
    </h1>
  </div>
  <div class="section-body">
  	<div class="row">
  		<!-- Tabel History Transaksi -->
      <div class="col-12 col-md-8 col-lg-8">
        <div class="card">
          <div class="counter">
            <b>Total Transaksi</b> : {{$counter}}
          </div>
          <div class="card-header"> 
            <a href="{{url('/transactions/export/excel')}}" class="badge badge-success nounderline mr-2" title="Export Excel"><i class="fa fa-file-excel fa-lg"></i> Export</a>
          </div>
          <div class="card-body table-responsive">
              <div id="datatable-transaksi"></div>
          </div>
        </div>
      </div>
      <!-- Card History -->
      <div class="col-12 col-md-4 col-lg-4">
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
                        @if(auth()->user()->id_role == 3)
                        <div class="float-right dropdown">
                          <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                          <div class="dropdown-menu">
                            <div class="dropdown-title">Options</div>                               
                            <a href="#" class="dropdown-item has-icon"><i class="fas fa-comment-dots"></i> Chat</a>
                          </div>
                        </div>
                        @endif
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
                      @if($order->jenis_layanan == 'COD')
                        <a href="https://www.google.com/maps/?q={{$order->lokasi}}" target="_blank" class="badge badge-success nounderline col-12 col-md-6 col-lg-6 mb-2">Lihat lokasi</a>
                      @endif
                        <p class="badge badge-primary col-12 col-md-6 col-lg-6 mb-2">Rp. <span class="uang">{{$order->harga}}</span></p>
                      </div>
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
                          @if(auth()->user()->id_role == 3)
                          <div class="float-right dropdown">
                            <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                            <div class="dropdown-menu">
                              <div class="dropdown-title">Options</div>                               
                              <a href="#" class="dropdown-item has-icon"><i class="fas fa-comment-dots"></i> Chat</a>
                            </div>
                          </div>
                          @endif
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
                        @if($order->jenis_layanan == 'COD')
                          <a href="https://www.google.com/maps/?q={{$order->lokasi}}" target="_blank" class="badge badge-success nounderline col-12 col-md-6 col-lg-6 mb-2">Lihat lokasi</a>
                        @endif
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
                          @if(auth()->user()->id_role == 3)
                          <div class="float-right dropdown">
                            <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                            <div class="dropdown-menu">
                              <div class="dropdown-title">Options</div>                               
                              <a href="#" class="dropdown-item has-icon"><i class="fas fa-comment-dots"></i> Chat</a>
                            </div>
                          </div>
                          @endif
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
                        @if($order->jenis_layanan == 'COD')
                          <a href="https://www.google.com/maps/?q={{$order->lokasi}}" target="_blank" class="badge badge-success nounderline col-12 col-md-6 col-lg-6 mb-2">Lihat lokasi</a>
                        @endif
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
                      <span>Belum ada transaksi</span>
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
@push('javascript')
  @if(auth()->user()->id_role != 3)
    <script src="{{asset('assets/js/AdminPanel/Transaksi/transaksi-admin.js')}}"></script>
  @else
    <script src="{{asset('assets/js/AdminPanel/Transaksi/transaksi.js')}}"></script>
  @endif
@endpush