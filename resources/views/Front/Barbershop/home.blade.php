@extends('Front.Template.layout')

@section('content')
<script type="text/javascript">
	document.title = '{{$barbershop->name}}'
  	document.getElementById('barbershop').classList.add('active');
</script>
<section class="section-content mt-4 mb-4">
	<div class="container">
		<div class="parallax-window" style="background-image: url('{{asset('assets/images/barbershop/banner/'.$barbershop->banner)}}');">
			<div class="tm-header">
				<div class="row tm-header-inner">
					<div class="col-md-6 col-12">
						<div class="tm-site-text-box">
							<h1 class="tm-site-title">{{$barbershop->name}}</h1>
							<h6 class="tm-site-description">by. {{$user->name}}</h6>	
							<!-- Rating -->
			                <div class="rating-wrap">
			                    <ul class="rating-stars">
			                      <li style="width:80%" class="stars-active">
			                          <i class="fa fa-star"></i>
			                      </li>
			                      <li>
			                        <i class="fa fa-star"></i> {{number_format($barbershop->averageRating,1)}}
			                      </li>
			                    </ul>
			                    <span class="label-rating text-muted">{{\App\Rating::where(['rateable_type' => 'App\Barbershop'])->where(['rateable_id' => $barbershop->id])->count()}} reviews</span>
			                </div>
						</div>
					</div>
					<nav class="col-md-6 col-12 tm-nav">
						<ul class="tm-nav-ul">
							<li class="tm-nav-li">
								<a href="https://www.google.com/maps/?q={{$barbershop->latitude}},{{$barbershop->longitude}}" target="_blank" class="tm-nav-link active nounderline">
									<i class="fas fa-map-marker-alt"></i> Lokasi Kami
								</a>
							</li>
							<li class="tm-nav-li">
								<a href="{{url('orders/'.$barbershop->url)}}" target="_blank" class="tm-nav-link active nounderline">
									<i class="fas fa-sort-numeric-down"></i> Antrian Terkini
								</a>
							</li>
						</ul>
					</nav>	
				</div>
			</div>
		</div>

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
	            <p>Whoops.. No Hairstyle Available</p>
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
@endsection