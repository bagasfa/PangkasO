@extends('Front.Template.layout')

@section('title','Hairstyle')

@section('content')
<!-- ========================= SECTION HAIRSTYLE ========================= -->
<script type="text/javascript">
  document.getElementById('hairstyle').classList.add('active');
</script>
  <section class="section-content mb-4">
    <div class="container">

      <header class="section-heading">
        <h3 class="section-title">Hairstyle Terbaru</h3>
      </header><!-- sect-heading -->

      <div class="row">
        @forelse($hairstyle as $hair)
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
        @empty
          <div class="col-md-3">
            <div href="#" class="card card-product-grid">
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
                    <span class="label-rating text-muted">0 reviews</span>
                  </div>
                <div class="price mt-1">Free <i class="fas fa-check-circle" style="color:green;"></i></div> <!-- price-wrap.// -->
                </figcaption>
              </a>
            </div>
          </div> <!-- col.// -->
        @endforelse
      </div> <!-- row.// -->
    </div> <!-- container .//  -->
  </section>
 <!-- ========================= SECTION HAIRSTYLE END// ========================= -->
@endsection