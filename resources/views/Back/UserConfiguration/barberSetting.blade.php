@extends('Back.Template.layouts.app')

@section('title', 'Barbershop Setting')

@section('content')
<section class="section">
  
  <div class="section-header">
    <h1>
      Setting Barbershop
    </h1>
  </div>
  <center>
  <div class="section-body">
    <div class="col-12">
        <div class="card">
          <div class="card-body text-center">
            <div class="form-group">
                Bergabung sejak {{ auth()->user()->created_at->diffForHumans() }}
              </div>
            <form action="{{ url('/owner-panel/update-barbershop') }}" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
              
              <!-- Nama -->
              <div class="form-group profile-input">
                <label for="name">Nama Barbershop</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Nama Barbershop" value="{{$barber->name}}">
              </div>
              <!-- Phone -->
              <div class="form-group profile-input">
                <label for="phone_number">Nomor Telepon</label>
                <input name="phone_number" type="tel" class="form-control" id="phone_number" placeholder="Nomor Telepon" value="{{$barber->phone_number}}">
              </div>
              <!-- Address -->
              <div class="form-group profile-input">
                <label for="address">Alamat</label>
                <textarea name="address" id="address" class="form-control" required="">{{$barber->address}}</textarea>
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
                      <input type="text" name="lat" class="form-control" id="input-lat" placeholder="Latitude" hidden>
                      <input type="text" name="long" class="form-control" id="input-lng" placeholder="Longitude" hidden>   
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
@push('javascript')
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDVdq9z2G2lIc0pn2FK7lHeCIWvNEXQMmQ&sensor=true"></script>
  <script src="{{ asset('assets/js/gmaps.min.js') }}"></script>
  <!-- Draggable Maker -->
  <script type="text/javascript">
    "use strict";

    var input_lat = $("#input-lat"), // latitude input text
      input_lng = $("#input-lng"), // longitude input text
      map = new GMaps({ // init map
        div: '#map',
        lat: {{$barber->latitude}},
        lng: {{$barber->longitude}}
      });

    // add marker
    var marker = map.addMarker({
      lat: {{$barber->latitude}},
      lng: {{$barber->longitude}},
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