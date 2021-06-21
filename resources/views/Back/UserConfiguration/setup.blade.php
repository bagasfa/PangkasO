@extends('Back.Template.layouts.app')

@section('title', 'Profile')

@section('content')
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
            <form action="{{ url('/owner-panel/update-barbershop') }}" method="POST" enctype="multipart/form-data">
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
                <label for="inputNama">Nama Barbershop</label>
                <input name="name" type="text" class="form-control" id="inputNama" placeholder="Nama Barbershop">
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
                      <input class="radio-input" type="radio" name="service_preferences" value="CODA">
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
@endpush
