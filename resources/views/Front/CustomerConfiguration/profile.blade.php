@extends('Front.Template.layout')

@section('title','Profile')

@section('content')
<section class="section-content mt-4 mb-4">
	<div class="container">
		<div class="card">
			<div class="card-header">
				<h2>{{auth()->user()->name}} Profile</h2>
			</div>
			<form action="{{ url('/profile/update') }}" method="POST" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="card-body">
				<div class="row">
					<div class="col-12 col-md-4 col-lg-4">
						<!-- Foto -->
            <div class="avatar-upload">
              <div class="avatar-edit">
                  <input type="file" id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg" />
                  <label for="imageUpload"></label>
              </div>
              @if(auth()->user()->avatar != NULL)
                <a href="{{ asset('assets/images/users/avatar/'.auth()->user()->avatar) }}" data-fancybox data-caption="Foto profil {{auth()->user()->name}}">
              @else
                <a href="{{ asset('assets/img/dummy/avatar/no-avatar.jpg') }}" data-fancybox data-caption="Foto Profil dummy, kamu belum mengunggah foto profil">
              @endif
                <div class="avatar-preview">
                  @if(auth()->user()->avatar != NULL)
                    <div id="imagePreview" style="background-image: url('{{url('assets/images/users/avatar/'.auth()->user()->avatar)}}');"></div>
                  @else
                    <div id="imagePreview" style="background-image: url('{{url('assets/img/dummy/avatar/no-avatar.jpg')}}');"></div>
                  @endif
                </div>
              </a>
            </div>
					</div>
					<div class="col-12 col-md-8 col-lg-8">
						<!-- Nama -->
            <div class="form-group">
              <label for="inputNama">Nama</label>
              <input name="name" type="text" class="form-control" id="inputNama" placeholder="Nama" value="{{auth()->user()->name}}" required="">
            </div>
            <!-- Email -->
            <div class="form-group">
                <label for="inputEmail">E-mail</label>
                <input name="email" type="email" class="form-control" id="inputEmail" placeholder="E-Mail" value="{{auth()->user()->email}}" required="">
            </div>
            <!-- Gender -->
            <div class="form-check ">
              <label for="gender">Jenis Kelamin</label><br>
              @if(auth()->user()->gender == 'male')
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="male" checked="">
                <label class="form-check-label" for="male">Laki - Laki</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="female">
                <label class="form-check-label" for="female">Perempuan</label>
              </div>
              @elseif(auth()->user()->gender == 'female')
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="male">
                <label class="form-check-label" for="male">Laki - Laki</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="female" checked="">
                <label class="form-check-label" for="female">Perempuan</label>
              </div>
              @else
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="male" checked="">
                <label class="form-check-label" for="male">Laki - Laki</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="female">
                <label class="form-check-label" for="female">Perempuan</label>
              </div>
              @endif
            </div>
            <!-- Phone -->
            <div class="form-group">
              <label for="phone_number">Nomor Telepon</label>
              <input name="phone_number" type="tel" class="form-control" id="phone_number" placeholder="Nomor Telepon" value="{{auth()->user()->phone_number}}" required="">
            </div>
            <!-- Address -->
            <div class="form-group">
              <label for="inputAddress">Alamat</label>
              <textarea name="address" id="inputAddress" class="form-control">{{auth()->user()->address}}</textarea>
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
                    <button class="close btn-close" data-dismiss="alert">
                    </button>
                    <div class="alert-body"> 
                      Anda bisa menggeser tanda lokasi ke lokasi anda, untuk membantu Barbershop menemukan lokasi anda.
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
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary col-12">SIMPAN</button>
			</div>
			</form>
		</div>
	</div>
</section>
@endsection
@push('stylesheet')
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <style type="text/css">
  	#map {
    	height: 400px !important;
 		}
 		html, body {
    height: 100%;
    margin: 0;
    padding: 0;
 }
  </style>
@endpush
@push('javacsript')
	
  <!-- Draggable Maker -->
  <script type="text/javascript">
    "use strict";

    var input_lat = $("#input-lat"), // latitude input text
      input_lng = $("#input-lng"), // longitude input text
      map = new GMaps({ // init map
        div: '#map',
        lat: {{auth()->user()->latitude}},
        lng: {{auth()->user()->longitude}}
      });

    // add marker
    var marker = map.addMarker({
      lat: {{auth()->user()->latitude}},
      lng: {{auth()->user()->longitude}},
      draggable: true,
    });

    // when the map is clicked
    map.addListener("click", function(e) {
      var lat = e.latLng.lat(), 
        lng = e.latLng.lng();

      // move the marker position
      marker.setPosition({
        lat: lat,
        lng: lng
      });
      update_position();       
    });

    // when the marker is dragged
    marker.addListener('drag', function(e) {
      update_position();
    });

    // set the value to latitude and longitude input
    update_position();
    function update_position() {
      var lat = marker.getPosition().lat(), lng = marker.getPosition().lng();
      input_lat.val(lat);
      input_lng.val(lng);
    }

    // move the marker when the latitude and longitude inputs change in value
    $("#input-lat,#input-lng").blur(function() {
      var lat = parseInt(input_lat.val()), 
        lng = parseInt(input_lng.val());

      marker.setPosition({
        lat: lat,
        lng: lng
      });
      map.setCenter({
        lat: lat,
        lng: lng
      });
    });
  </script>
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