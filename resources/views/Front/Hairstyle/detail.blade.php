@extends('Front.Template.layout')

@section('content')
<script type="text/javascript">
	document.title = '{{$hairstyle->name}} Hairstyle'
</script>
<section class="section-content mt-4 mb-4">
	<div class="container">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-12 col-md-4 col-lg-4 mb-4">
						<img src="{{asset('assets/images/barbershop/hairstyle/'.$hairstyle->images)}}" class="rounded img-fluid">
					</div>
					<div class="col-12 col-md-8 col-lg-8">
						<h3>{{$hairstyle->name}}</h3>
						<span>by. <a class="nounderline" href="{{url('/barbershop/'.$barbershop->url)}}">{{$barbershop->name}} Barbershop</a></span>
            <!-- Rating -->
            <div class="rating-wrap">
              <ul class="rating-stars">
                <li style="width:80%" class="stars-active">
                    <i class="fa fa-star"></i>
                </li>
                <li>
                  <i class="fa fa-star"></i> {{number_format($hairstyle->averageRating,1)}}
                </li>
              </ul>
              <span class="label-rating text-muted">{{\App\Rating::where(['rateable_id' => $hairstyle->id])->count()}} reviews</span>
            </div>
						<h5 class="mt-4">Deskripsi Hairstyle</h5>
            <span class="deskripsi">Hairstyle untuk 
              @if($hairstyle->gender == 'male')
                Pria
              @else
                Wanita
              @endif
            </span>
						<p class="deskripsi" align="justify">
              @if($hairstyle->deskripsi != NULL)
                {{$hairstyle->deskripsi}}
              @else
                Tidak Ada Deskripsi
              @endif
            </p>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
        @if(auth()->check())
  				@if(auth()->user()->verify_status != 'Approved')
  					@if($barbershop->service_preferences == 'COD')
  						<button class="btn btn-primary col-12" data-toggle="modal" data-target="#verify">COD</button>
  					@elseif($barbershop->service_preferences == 'AO')
  						<button class="btn btn-info col-12" data-toggle="modal" data-target="#verify">Antri Online</button>
  					@elseif($barbershop->service_preferences == 'COA')
  						<button class="btn btn-primary col-6 col-md-6 col-lg-6" data-toggle="modal" data-target="#verify">COD</button>
  						<button class="btn btn-info col-6 col-md-6 col-lg-6" data-toggle="modal" data-target="#verify">Antri Online</button>
  					@endif
  				@else
  					@if($barbershop->service_preferences == 'COD')
  						<button class="btn btn-primary col-12" data-toggle="modal" data-target="#cod">COD</button>
  					@elseif($barbershop->service_preferences == 'AO')
  						<button class="btn btn-info col-12" data-toggle="modal" data-target="#antri">Antri Online</button>
  					@elseif($barbershop->service_preferences == 'COA')
  						<button class="btn btn-primary col-6 col-md-6 col-lg-6" data-toggle="modal" data-target="#cod">COD</button>
  						<button class="btn btn-info col-6 col-md-6 col-lg-6" data-toggle="modal" data-target="#antri">Antri Online</button>
  					@endif
  				@endif
				@else
          @if($barbershop->service_preferences == 'COD')
              <button class="btn btn-primary col-12" data-toggle="modal" data-target="#loginForm">COD</button>
            @elseif($barbershop->service_preferences == 'AO')
              <button class="btn btn-info col-12" data-toggle="modal" data-target="#loginForm">Antri Online</button>
            @elseif($barbershop->service_preferences == 'COA')
              <button class="btn btn-primary col-6 col-md-6 col-lg-6" data-toggle="modal" data-target="#loginForm">COD</button>
              <button class="btn btn-info col-6 col-md-6 col-lg-6" data-toggle="modal" data-target="#loginForm">Antri Online</button>
            @endif
        @endif
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@push('modal')
<!-- ========================= VERIFY MODAL ========================= -->
<div class="modal fade" id="verify" tabindex="-1" role="dialog" aria-labelledby="verify" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content"> 
      <div class="modal-header">
        <h5 class="modal-title" id="verifyForm">Verifikasi Akun Terlebih dahulu</h5>
        <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p align="justify">Verifikasi identitas anda terlebih dahulu sebelum melakukan order untuk kenyamanan bersama.</p>
      </div>
      <div class="modal-footer">
        <!-- Button -->
        <a href="{{ url('/verify') }}" class="btn btn-primary">Verifikasi</a>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ========================= VERIFY MODAL END // ========================= -->

<!-- ========================= COD MODAL ========================= -->
<div class="modal fade" id="cod" tabindex="-1" role="dialog" aria-labelledby="cod" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 
      <div class="modal-header">
        <h5 class="modal-title" id="codForm">Konfirmasi Order (COD)</h5>
        <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{url('/order')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="hairstyle_id" value="{{$hairstyle->id}}">
        <input type="hidden" name="barbershop_id" value="{{$barbershop->id}}">
        <input type="hidden" name="jenis_layanan" value="COD">
        <div class="form-group">
          <label for="time">Jam COD</label>
          <input type="time" class="form-control" id="time" name="time" required>
          @if(auth()->check())
          <input type="hidden" name="lokasi" value="{{auth()->user()->latitude}},{{auth()->user()->longitude}}">
          @endif
        </div>
        <div class="form-group">
          <textarea name="pesan" class="form-control" placeholder="Pesan untuk Barbershop (opsional)"></textarea>
        </div>
        <!-- Dissmissable Alert -->
        <div class="alert alert-info alert-dismissible show fade">
          <button class="close btn-close" data-dismiss="alert">
          </button>
          <div class="alert-body"> 
            Lokasi COD menggunakan lokasi marker map yang telah anda tentukan di profil anda, jika anda ingin memilih lokasi lain anda bisa Ubah lokasi sekarang juga.
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <!-- Button -->
        <a href="{{url('/profile')}}" class="btn btn-warning">Ubah Lokasi</a>
        <button type="submit" class="btn btn-primary">Order</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ========================= COD MODAL END // ========================= -->

<!-- ========================= ANTRIAN ONLINE MODAL ========================= -->
<div class="modal fade" id="antri" tabindex="-1" role="dialog" aria-labelledby="antri" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 
      <div class="modal-header">
        <h5 class="modal-title" id="antriForm">Konfirmasi Order (Antrian Online)</h5>
        <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{url('/order')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="hairstyle_id" value="{{$hairstyle->id}}">
        <input type="hidden" name="barbershop_id" value="{{$barbershop->id}}">
        <input type="hidden" name="jenis_layanan" value="AO">
        <div class="form-group">
        	<textarea name="pesan" class="form-control" placeholder="Pesan untuk Barbershop (opsional)"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <!-- Button -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Order</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ========================= ANTRIAN ONLINE MODAL END // ========================= -->
@endpush