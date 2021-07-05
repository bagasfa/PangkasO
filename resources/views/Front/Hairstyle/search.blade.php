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
        <h3 class="section-title">Hasil Hairstyle</h3>
      </header><!-- sect-heading -->

      <div class="row">
        @forelse($data as $hair)
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
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="empty-state" data-height="400">
                  <div class="empty-state-icon">
                    <i class="fas fa-question"></i>
                  </div>
                  <h2>Hairstyle tidak ditemukan</h2>
                  <p class="lead">
                    Mohon maaf kami tidak dapat menemukan data hasil pencarian hairstyle anda.
                  </p>
                  <a href="{{ url('/hairstyle') }}" class="btn btn-primary mt-4">Tampilkan Semua Hairstyle</a>
                </div>
              </div>
            </div>
          </div> <!-- col.// -->
        @endforelse
      </div> <!-- row.// -->
    </div> <!-- container .//  -->
  </section>
 <!-- ========================= SECTION HAIRSTYLE END// ========================= -->
@endsection