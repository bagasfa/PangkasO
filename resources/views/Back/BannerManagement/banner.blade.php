@extends('Back.Template.layouts.app')

@section('title', 'Profile')

@section('content')
<section class="section">
  
  <div class="section-header">
    <h1>
      Banner Barbershop Management
    </h1>
  </div>
  <center>
  <div class="section-body">
    <div class="col-12">
        <div class="card">
          <div class="card-body text-center">
            <form action="{{ url('/owner-panel/banner/update') }}" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
              <!-- Banner -->
              <div class="banner-upload">
                <label class="label-custom">Barbershop Banner</label>
                <div class="banner-edit">
                  <input type='file' id="imageUpload" name="banner" accept=".png, .jpg, .jpeg" />
                  <label for="imageUpload"></label>
                </div>
                @if($banner->picture != NULL)
                  <a href="{{ asset('assets/images/barbershop/banner/'.$banner->picture) }}" data-fancybox>
                @else
                  <a href="{{ asset('assets/img/dummy/avatar/no-avatar.jpg') }}" data-fancybox>
                @endif
                  <div class="banner-preview">
                    @if($banner->picture != NULL)
                      <div id="imagePreview" style="background-image: url('{{url('assets/images/barbershop/banner/'.$banner->picture)}}');"></div>
                    @else
                      <div id="imagePreview" style="background-image: url('{{url('assets/img/dummy/avatar/no-avatar.jpg')}}');"></div>
                    @endif
                  </div>
                </a>
              </div>
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
