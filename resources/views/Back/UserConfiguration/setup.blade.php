@extends('Back.Template.layouts.app')

@section('title', 'Setup Barbershop')

@section('content')
<script type="text/javascript">
  document.getElementById('setup').classList.add('active');
</script>
<section class="section">
  
  <div class="section-header">
    <h1>
      Setup new Barbershop
    </h1>
  </div>
  <center>
  <div class="section-body">
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
          <div class="card-body text-center">
            <div class="form-group">
                Bergabung sejak {{ auth()->user()->created_at->diffForHumans() }}
              </div>
            <form action="{{ url('/owner-panel/update-barbershop') }}" autocomplete="off" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}

              <!-- Banner -->
              <div class="banner-upload">
                <label class="label-custom">Barbershop Banner</label>
                <div class="banner-edit">
                  <input type='file' id="imageUpload" name="banner" accept=".png, .jpg, .jpeg" />
                  <label for="imageUpload"></label>
                </div>
                <a href="{{ asset('assets/img/dummy/avatar/no-avatar.jpg') }}" data-fancybox>
                  <div class="banner-preview">
                    <div id="imagePreview" style="background-image: url('{{url('assets/img/dummy/avatar/no-avatar.jpg')}}');"></div>
                  </div>
                </a>
              </div>
              
              <!-- Nama -->
              <div class="form-group profile-input">
                <label for="name">Nama Barbershop</label>
                <input name="name" type="text" class="form-control" autocomplete="new-password" id="name" placeholder="Nama Barbershop">
              </div>
              <!-- Jenis Pelayanan -->
              <div class="form-group">
                <label class="form-label label-custom">Jenis Pelayanan</label>
                <div class="form-check">
                  <div class="form-check form-check-inline">
                    <label class="radio-label">
                      <input class="radio-input" type="radio" name="service_preferences" value="COD">
                      <span>COD</span>
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <label class="radio-label">
                      <input class="radio-input" type="radio" name="service_preferences" value="AO" checked>
                      <span>Antrian Online</span>
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <label class="radio-label">
                      <input class="radio-input" type="radio" name="service_preferences" value="COA">
                      <span>COD & Antrian Online</span>
                    </label>
                  </div>
                </div>
              </div>
              <!-- Phone -->
              <div class="form-group profile-input">
                <label for="phone_number">Nomor Telepon</label>
                <input name="phone_number" type="tel" class="form-control" id="phone_number" placeholder="Nomor Telepon">
              </div>
              <!-- Address -->
              <div class="form-group profile-input">
                <label for="address">Alamat</label>
                <textarea name="address" id="address" class="form-control"></textarea>
              </div>
              <!-- Maps -->
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h4>Pilih Lokasi pada Peta</h4>
                    </div>
                    <!-- Dissmissable Alert -->
                    <div class="alert alert-info alert-dismissible show fade">
                      <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                      </button>
                      <div class="alert-body"> 
                        Anda bisa menggeser tanda lokasi ke lokasi Barbershop anda, untuk membantu pelanggan menemukan lokasi anda.
                      </div>
                    </div>
                    <!-- Latitude Longitude -->
                    <div class="input-group" id="input-group">
                      <input type="text" name="lat" class="form-control text-center" id="input-lat" placeholder="Latitude" readonly="true">
                      <input type="text" name="long" class="form-control text-center" id="input-lng" placeholder="Longitude" readonly="true">   
                    </div>
                    <div id="map" data-height="400"></div>
                  </div>
                </div>
              </div>
              
              <br>
              <div class="form-group text-center">
                <button type="submit" class="btn btn-primary col">SIMPAN</button>
              </div>
              </form>
          </div>
        </div>
      </div>  
  </div>
</center>
</section>
@endsection
@push('stylesheet')
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endpush
@push('javascript')
  <!-- Gmaps Things -->
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAO6ndHIJPAnQbMMh8k0jq86Mq6gmX_61o&sensor=true"></script>
  <script src="{{ asset('assets/js/gmaps.min.js') }}"></script>
  <script src="{{ asset('assets/js/gmaps-draggable-marker.js') }}"></script>
  <!-- Input Image -->
  <script type="text/javascript">
    function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
              $('#imagePreview').css('background-image', 'url('+e.target.result +')');
              $('#imagePreview').hide();
              $('#imagePreview').fadeIn(650);
          }
          reader.readAsDataURL(input.files[0]);
      }
  }
  $("#imageUpload").change(function() {
      readURL(this);
  });
  </script>
  <!-- Disable Special Character -->
  <script type="text/javascript">
    $('#name').on('keypress', function (event) {
      var regex = new RegExp("^[a-zA-Z0-9]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
      if (!regex.test(key)) {
         event.preventDefault();
         return false;
      }
    });
  </script>
  <!-- Disable Paste -->
  <script type="text/javascript">
    window.onload = () => {
     const name = document.getElementById('name');
     name.onpaste = e => e.preventDefault();
    }
  </script>
@endpush
