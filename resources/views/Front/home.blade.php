@extends('Front.Template.layout')

@section('title','PangkasO')

@section('content')
<!-- ========================= SECTION INTRO ========================= -->
<script type="text/javascript">
  document.getElementById('home').classList.add('active');
</script>
  <section class="section-intro padding-y-sm">
    <div class="container">

      <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="{{asset('assets/images/1.jpg')}}" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{asset('assets/images/2.jpg')}}" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{asset('assets/images/1.jpg')}}" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

    </div> <!-- container //  -->
  </section>
  <!-- ========================= SECTION INTRO END// ========================= -->

  <!-- ========================= SECTION BARBERSHOP ========================= -->
  <section class="section-content mb-4">
    <div class="container">

      <header class="section-heading">
        <h3 class="section-title">Barbershop Terpopuler</h3>
      </header><!-- sect-heading -->

      <div class="row">
        @forelse($barbershop as $barber)
          <div class="col-md-3">
            <div class="card card-product-grid">
              <a href="{{asset('assets/images/barbershop/banner/'.$barber->banner)}}"  class="img-wrap" data-fancybox>
                <img src="{{asset('assets/images/barbershop/banner/'.$barber->banner)}}">
              </a>
              <a href="{{url('/barbershop/'.$barber->url)}}" class="nounderline" style="color:black;">
                <figcaption class="info-wrap">
                  <p class="title">{{$barber->name}}</p>
                  <!-- Rating -->
                  <div class="rating-wrap">
                    <ul class="rating-stars">
                      <li style="width:80%" class="stars-active">
                          <i class="fa fa-star"></i>
                      </li>
                      <li>
                        <i class="fa fa-star"></i> {{number_format($barber->averageRating,1)}}
                      </li>
                    </ul>
                    <span class="label-rating text-muted">{{\App\Rating::where(['rateable_type' => 'App\Barbershop'])->where(['rateable_id' => $barber->id])->count()}} reviews</span>
                  </div>
                  <div class="mt-1">
                    @if($barber->service_preferences == 'COD')
                      Cash On Delivery
                    @elseif($barber->service_preferences == 'AO')
                      Antrian Online
                    @elseif($barber->service_preferences == 'COA')
                      COD & Antrian Online
                    @endif
                      <i class="fas fa-check-circle" style="color:green;"></i>
                  </div>
                </figcaption>
              </a>
            </div>
          </div> <!-- col.// -->
        @empty
          <div class="col-md-3">
            <div class="card card-product-grid">
              <a href="{{asset('assets/img/vector/times.png')}}" class="img-wrap" data-facybox data-caption="We're so sorry :(">
                <img src="{{asset('assets/img/vector/times.png')}}">
              </a>
              <a href="#" class="nounderline" style="color:black;">
                <figcaption class="info-wrap">
                <p class="title">Whoops.. No Barbershop Available</p>
                <!-- Rating -->
                <div class="rating-wrap">
                  <ul class="rating-stars">
                    <li style="width:80%" class="stars-active"> 
                      <i class="fa fa-star"></i>
                    </li>
                    <li>
                      <i class="fa fa-star"></i> 0.0 
                    </li>
                  </ul>
                  <span class="label-rating text-muted"> 0 reviews</span>
                </div>
                <div class="mt-1">No Service Available <i class="fas fa-times-circle" style="color:red;"></i></div>
                </figcaption>
              </a>
            </div>
          </div> <!-- col.// -->
        @endforelse
      </div> <!-- row.// -->
      <footer class="section-footer">
        <a href="{{url('/barbershop')}}" class="btn btn-outline-primary">Lihat semua</a>
      </footer>
    </div> <!-- container .//  -->
  </section>
  <!-- ========================= SECTION BARBERSHOP END// ========================= -->

  <!-- ========================= SECTION MALE HAIRSTYLE ========================= -->
  <section class="section-content mb-4">
    <div class="container">

      <header class="section-heading">
        <h3 class="section-title">Hairstyle Pria Terbaru</h3>
      </header><!-- sect-heading -->

      <div class="row">
        @forelse($hairstyle as $hair)
        @if($hair->gender == 'male')
          <div class="col-md-3">
            <div class="card card-product-grid">
              <a href="{{asset('assets/images/barbershop/hairstyle/'.$hair->images)}}"  class="img-wrap" data-fancybox>
                <img src="{{asset('assets/images/barbershop/hairstyle/'.$hair->images)}}">
              </a>
              <a href="{{url('/barbershop/'.$hair->barbershop->url.'/'.$hair->id)}}" class="nounderline" style="color:black;">
                <figcaption class="info-wrap">
                  <p class="title">{{$hair->name}}</p>
                  <!-- Rating -->
                  <div class="rating-wrap">
                    <ul class="rating-stars">
                      <li style="width:80%" class="stars-active">
                          <i class="fa fa-star"></i>
                      </li>
                      <li>
                        <i class="fa fa-star"></i> {{number_format($hair->averageRating,1)}}
                      </li>
                    </ul>
                    <span class="label-rating text-muted">{{\App\Rating::where(['rateable_id' => $hair->id])->count()}} reviews</span>
                  </div>
                  <div class="price mt-1">Rp. <span class="uang">{{$hair->price}}</span>,-</div> <!-- price-wrap.// -->
                </figcaption>
              </a>
            </div>
          </div> <!-- col.// -->
        @endif
        @empty
          <div class="col-md-3">
            <div class="card card-product-grid">
              <a href="{{asset('assets/img/vector/times.png')}}" class="img-wrap" data-facybox data-caption="We're so sorry :(">
                <img src="{{asset('assets/img/vector/times.png')}}">
              </a>
              <a href="#" class="nounderline" style="color:black;">
                <figcaption class="info-wrap">
                <p>Whoops.. No Male Hairstyle Available</p>
                <!-- Rating -->
                <div class="rating-wrap">
                  <ul class="rating-stars">
                    <li style="width:80%" class="stars-active"> 
                      <i class="fa fa-star"></i>
                    </li>
                    <li>
                      <i class="fa fa-star"></i> 0.0 
                    </li>
                  </ul>
                  <span class="label-rating text-muted"> 0 reviews</span>
                </div>
                <div class="price mt-1">Free <i class="fas fa-check-circle" style="color:green;"></i></div> <!-- price-wrap.// -->
                </figcaption>
              </a>
            </div>
          </div> <!-- col.// -->
        @endforelse
      </div> <!-- row.// -->
      <footer class="section-footer">
        <a href="{{url('hairstyle/male')}}" class="btn btn-outline-primary">Lihat semua</a>
      </footer>
    </div> <!-- container .//  -->
  </section>
  <!-- ========================= SECTION MALE HAIRSTYLE END// ========================= -->

  <!-- ========================= SECTION FEMALE HAIRSTYLE ========================= -->
  <section class="section-content mb-4">
    <div class="container">

      <header class="section-heading">
        <h3 class="section-title">Hairstyle Wanita Terbaru</h3>
      </header><!-- sect-heading -->

      <div class="row">
        @forelse($hairstyle as $hair)
        @if($hair->gender == 'female')
          <div class="col-md-3">
            <div class="card card-product-grid">
              <a href="{{asset('assets/images/barbershop/hairstyle/'.$hair->images)}}"  class="img-wrap" data-fancybox>
                <img src="{{asset('assets/images/barbershop/hairstyle/'.$hair->images)}}">
              </a>
              <a href="{{url('/barbershop/'.$hair->barbershop->url.'/'.$hair->id)}}" class="nounderline" style="color:black;">
                <figcaption class="info-wrap">
                  <p class="title">{{$hair->name}}</p>
                  <!-- Rating -->
                  <div class="rating-wrap">
                    <ul class="rating-stars">
                      <li style="width:80%" class="stars-active">
                          <i class="fa fa-star"></i>
                      </li>
                      <li>
                        <i class="fa fa-star"></i> {{number_format($hair->averageRating,1)}}
                      </li>
                    </ul>
                    <span class="label-rating text-muted">{{\App\Rating::where(['rateable_id' => $hair->id])->count()}} reviews</span>
                  </div>
                  <div class="price mt-1">Rp. <span class="uang">{{$hair->price}}</span>,-</div> <!-- price-wrap.// -->
                </figcaption>
              </a>
            </div>
          </div> <!-- col.// -->
        @endif
        @empty
          <div class="col-md-3">
            <div class="card card-product-grid">
              <a href="{{asset('assets/img/vector/times.png')}}" class="img-wrap" data-facybox data-caption="We're so sorry :(">
                <img src="{{asset('assets/img/vector/times.png')}}">
              </a>
              <a href="#" class="nounderline" style="color:black;">
                <figcaption class="info-wrap">
                <p>Whoops.. No Female Hairstyle Available</p>
                <!-- Rating -->
                <div class="rating-wrap">
                  <ul class="rating-stars">
                    <li style="width:80%" class="stars-active"> 
                      <i class="fa fa-star"></i>
                    </li>
                    <li>
                      <i class="fa fa-star"></i> 0.0 
                    </li>
                  </ul>
                  <span class="label-rating text-muted"> 0 reviews</span>
                </div>
                <div class="price mt-1">Free <i class="fas fa-check-circle" style="color:green;"></i></div> <!-- price-wrap.// -->
                </figcaption>
              </a>
            </div>
          </div> <!-- col.// -->
        @endforelse
      </div> <!-- row.// -->
      <footer class="section-footer">
        <a href="{{url('hairstyle/female')}}" class="btn btn-outline-primary">Lihat semua</a>
      </footer>
    </div> <!-- container .//  -->
  </section>
  <!-- ========================= SECTION FEMALE HAIRSTYLE END// ========================= -->
@endsection