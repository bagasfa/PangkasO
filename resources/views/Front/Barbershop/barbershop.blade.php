@extends('Front.Template.layout')

@section('title','Barbershop')

@section('content')
<!-- ========================= SECTION BARBERSHOP ========================= -->
<script type="text/javascript">
  document.getElementById('barbershop').classList.add('active');
</script>
  <section class="section-content mb-4">
    <div class="container">

      <header class="section-heading">
        <h3 class="section-title">Barbershop Terbaru</h3>
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
            <div href="#" class="card card-product-grid">
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
                  <span class="label-rating text-muted">0 reviews</span>
                </div>
                <div class="mt-1">No Service Available <i class="fas fa-times-circle" style="color:red;"></i></div>
                </figcaption>
              </a>
            </div>
          </div> <!-- col.// -->
        @endforelse
      </div> <!-- row.// -->
    </div> <!-- container .//  -->
  </section>
  <!-- ========================= SECTION BARBERSHOP END// ========================= -->
@endsection