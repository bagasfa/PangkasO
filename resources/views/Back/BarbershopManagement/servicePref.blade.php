@extends('Back.Template.layouts.app')

@section('title', 'Service Preferences')

@section('content')
<script type="text/javascript">
  document.getElementById('services').classList.add('active');
</script>
<section class="section">
  
  <div class="section-header">
    <h1>
      Jenis Pelayanan
    </h1>
  </div>
  <center>
  <div class="section-body">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <form action="{{ url('/owner-panel/service-pref/update') }}" method="POST" enctype="multipart/form-data">
          @csrf()  
            <div class="frame">
              <div>
                @if($barber->service_preferences == 'COD')
                <input type="radio" id="COD" name="service_preferences" value="COD" checked>
                @else
                <input type="radio" id="COD" name="service_preferences" value="COD">
                @endif
                <label for="COD">
                  <h2>Cash On Delivery</h2>
                  <p align="justify" class="p-1">Sistem <b>COD</b> (<b>Cash On Delivery</b>), pada sistem ini nantinya pihak barbershop akan datang ke pelanggan untuk memangkas rambut di rumah pelanggan / sesuai lokasi yang telah ditentukan pelanggan.</p>
                </label>
              </div>
              <div>
                @if($barber->service_preferences == 'AO')
                <input type="radio" id="AO" name="service_preferences" value="AO" checked>
                @else
                <input type="radio" id="AO" name="service_preferences" value="AO">
                @endif
                <label for="AO">
                  <h2>Antrian Online</h2>
                  <p align="justify" class="p-1">Sistem <b>Antrian Online</b>, pada sistem antrian online pelanggan yang melakukan pemesanan jasa lewat website ini akan mendapatkan tiket antrian yang nantinya digunakan untuk mengantri dari rumah, dan datang ke Barbershop pada saat gilirannya.</p>
                </label>
              </div>
              <div>
                @if($barber->service_preferences == 'COA')
                <input type="radio" id="COA" name="service_preferences" value="COA" checked>
                @else
                <input type="radio" id="COA" name="service_preferences" value="COA">
                @endif
                <label for="COA">
                  <h2>COD & Antrian Online</h2>
                  <p align="justify" class="p-1"><b>Cash On Delivery</b> (<b>COD</b>) dan <b>Antrian Online</b>, pada sistem gabungan ini pemilik barbershop bisa menggunakan fitur dari kedua sistem ini, sehingga mendapatkan keuntungan yang maksimal.</p>
                </label>
              </div>
            </div>
            <button class="btn btn-primary col mt-4">SIMPAN</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</center>
</section>
@endsection
@push('stylesheet')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{asset('assets/css/radio.custom.css')}}">
@endpush