<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pangkaso</title>
    <link rel="icon" href="assets/images/items/1.jpg" type="image/x-icon"/>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

   <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="assets/css/ui.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/stisla.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.css') }}">
                
    </head>
    <body>
       
<header class="section-header">

<nav class="navbar navbar-dark navbar-expand p-0 bg-primary">
<div class="container">
    <ul class="navbar-nav d-none d-md-flex mr-auto">
    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Delivery</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Payment</a></li>
    </ul>
    <ul class="navbar-nav">
    <li  class="nav-item"><a href="#" class="nav-link"> Call: +0000000000 </a></li>
    <li class="nav-item dropdown">
       <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> English </a>
        <ul class="dropdown-menu dropdown-menu-right" style="max-width: 100px;">
        <li><a class="dropdown-item" href="#">Bahasa</a></li>
        </ul>
    </li>
  </ul> <!-- list-inline //  -->
  
</div> <!-- container //  -->
</nav> <!-- header-top-light.// -->

<section class="header-main border-bottom">
  <div class="container">
<div class="row align-items-center">
  <div class="col-lg-2 col-6">
    <a href="#" class="brand-wrap">
      <img src="assets/img/logo.jpg">
    </a> <!-- brand-wrap.// -->
  </div>
  <div class="col-lg-6 col-12 col-sm-12">
    <form action="#" class="search">
      <div class="input-group w-100">
          <input type="text" class="form-control" placeholder="Search">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
    </form> <!-- search-wrap .end// -->
  </div> <!-- col.// -->
  <div class="col-lg-4 col-sm-6 col-12">
    <div class="widgets-wrap float-md-right">
      <div class="widget-header  mr-3">
        <a href="#" class="icon icon-sm rounded-circle border"><i class="fa fa-shopping-cart"></i></a>
        <span class="badge badge-pill badge-danger notify">0</span>
      </div>
      <div class="widget-header icontext">
        <a href="#" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>
        @if(auth()->check())
        <div class="text">
          <span class="text-muted">Hello, {{auth()->user()->name}}!</span>
          <div>
            <a href="{{url('/logout')}}">Logout</a>
          </div>
        </div>
        @else
        <div class="text">
          <span class="text-muted">Good Morning!</span>
          <div>
            <a href="{{url('/login')}}">Masuk</a> | 
            <a href="" data-toggle="modal" data-target="#formCustomer">Daftar</a>
          </div>
        </div>
        @endif
      </div>
    </div> <!-- widgets-wrap.// -->
  </div> <!-- col.// -->
</div> <!-- row.// -->
  </div> <!-- container.// -->
</section> <!-- header-main .// -->



<nav class="navbar navbar-main navbar-expand-lg navbar-light border-bottom">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="main_nav">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link pl-0" data-toggle="dropdown" href="#"><strong> <i class="fa fa-bars"></i>    All category</strong></a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Foods and Drink</a>
            <a class="dropdown-item" href="#">Home interior</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Category 1</a>
            <a class="dropdown-item" href="#">Category 2</a>
            <a class="dropdown-item" href="#">Category 3</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Fashion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Supermarket</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Electronics</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Baby &amp Toys</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Fitness sport</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Clothing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Furnitures</a>
        </li>
      </ul>
    </div> <!-- collapse .// -->
  </div> <!-- container .// -->
</nav>

</header> <!-- section-header.// -->



<!-- ========================= SECTION INTRO ========================= -->
<section class="section-intro padding-y-sm">
<div class="container">

<div class="intro-banner-wrap">
  <img src="assets/images/1.jpg" class="img-fluid rounded">
</div>

</div> <!-- container //  -->
</section>
<!-- ========================= SECTION INTRO END// ========================= -->


<!-- ========================= SECTION FEATURE ========================= -->
<section class="section-content padding-y-sm">
<div class="container">
<article class="card card-body">


<div class="row">
  <div class="col-md-4">    
    <figure class="item-feature">
      <span class="text-primary"><i class="fa fa-2x fa-truck"></i></span>
      <figcaption class="pt-3">
        <h5 class="title">Fast delivery</h5>
        <p>Dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore </p>
      </figcaption>
    </figure> <!-- iconbox // -->
  </div><!-- col // -->
  <div class="col-md-4">
    <figure  class="item-feature">
      <span class="text-primary"><i class="fa fa-2x fa-landmark"></i></span>    
      <figcaption class="pt-3">
        <h5 class="title">Creative Strategy</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
         </p>
      </figcaption>
    </figure> <!-- iconbox // -->
  </div><!-- col // -->
    <div class="col-md-4">
    <figure  class="item-feature">
      <span class="text-primary"><i class="fa fa-2x fa-lock"></i></span>
      <figcaption class="pt-3">
        <h5 class="title">High secured </h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
         </p>
      </figcaption>
    </figure> <!-- iconbox // -->
  </div> <!-- col // -->
</div>
</article>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION FEATURE END// ========================= -->


<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content">
<div class="container">

<header class="section-heading">
  <h3 class="section-title">Popular products</h3>
</header><!-- sect-heading -->

  
<div class="row">
  <div class="col-md-3">
    <div href="#" class="card card-product-grid">
      <a href="#" class="img-wrap"> <img src="assets/images/items/1.jpg"> </a>
      <figcaption class="info-wrap">
        <a href="#" class="title">Just another product name</a>
        
        <div class="rating-wrap">
          <ul class="rating-stars">
            <li style="width:80%" class="stars-active"> 
              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
            </li>
            <li>
              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
            </li>
          </ul>
          <span class="label-rating text-muted"> 34 reviws</span>
        </div>
        <div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
      </figcaption>
    </div>
  </div> <!-- col.// -->
  <div class="col-md-3">
    <div href="#" class="card card-product-grid">
      <a href="#" class="img-wrap"> <img src="assets/images/items/2.jpg"> </a>
      <figcaption class="info-wrap">
        <a href="#" class="title">Some item name here</a>
        
        <div class="rating-wrap">
          <ul class="rating-stars">
            <li style="width:80%" class="stars-active"> 
              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
            </li>
            <li>
              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
            </li>
          </ul>
          <span class="label-rating text-muted"> 34 reviws</span>
        </div>
        <div class="price mt-1">$280.00</div> <!-- price-wrap.// -->
      </figcaption>
    </div>
  </div> <!-- col.// -->
  <div class="col-md-3">
    <div href="#" class="card card-product-grid">
      <a href="#" class="img-wrap"> <img src="assets/images/items/3.jpg"> </a>
      <figcaption class="info-wrap">
        <a href="#" class="title">Great product name here</a>
        
        <div class="rating-wrap">
          <ul class="rating-stars">
            <li style="width:80%" class="stars-active"> 
              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
            </li>
            <li>
              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
            </li>
          </ul>
          <span class="label-rating text-muted"> 34 reviws</span>
        </div>
        <div class="price mt-1">$56.00</div> <!-- price-wrap.// -->
      </figcaption>
    </div>
  </div> <!-- col.// -->
  <div class="col-md-3">
    <div href="#" class="card card-product-grid">
      <a href="#" class="img-wrap"> <img src="assets/images/items/4.jpg"> </a>
      <figcaption class="info-wrap">
        <a href="#" class="title">Just another product name</a>
        
        <div class="rating-wrap">
          <ul class="rating-stars">
            <li style="width:80%" class="stars-active"> 
              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
            </li>
            <li>
              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
            </li>
          </ul>
          <span class="label-rating text-muted"> 34 reviws</span>
        </div>
        <div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
      </figcaption>
    </div>
  </div> <!-- col.// -->
</div> <!-- row.// -->

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->



<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content">
<div class="container">

<header class="section-heading">
  <h3 class="section-title">New arrived</h3>
</header><!-- sect-heading -->

<div class="row">
  <div class="col-md-3">
    <div href="#" class="card card-product-grid">
      <a href="#" class="img-wrap"> <img src="assets/images/items/5.jpg"> </a>
      <figcaption class="info-wrap">
        <a href="#" class="title">Just another product name</a>
        
        <div class="rating-wrap">
          <ul class="rating-stars">
            <li style="width:80%" class="stars-active"> 
              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
            </li>
            <li>
              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
            </li>
          </ul>
          <span class="label-rating text-muted"> 34 reviws</span>
        </div>
        <div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
      </figcaption>
    </div>
  </div> <!-- col.// -->
  <div class="col-md-3">
    <div href="#" class="card card-product-grid">
      <a href="#" class="img-wrap"> <img src="assets/images/items/6.jpg"> </a>
      <figcaption class="info-wrap">
        <a href="#" class="title">Some item name here</a>
        
        <div class="rating-wrap">
          <ul class="rating-stars">
            <li style="width:80%" class="stars-active"> 
              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
            </li>
            <li>
              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
            </li>
          </ul>
          <span class="label-rating text-muted"> 34 reviws</span>
        </div>
        <div class="price mt-1">$280.00</div> <!-- price-wrap.// -->
      </figcaption>
    </div>
  </div> <!-- col.// -->
  <div class="col-md-3">
    <div href="#" class="card card-product-grid">
      <a href="#" class="img-wrap"> <img src="assets/images/items/7.jpg"> </a>
      <figcaption class="info-wrap">
        <a href="#" class="title">Great product name here</a>
        
        <div class="rating-wrap">
          <ul class="rating-stars">
            <li style="width:80%" class="stars-active"> 
              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
            </li>
            <li>
              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
            </li>
          </ul>
          <span class="label-rating text-muted"> 34 reviws</span>
        </div>
        <div class="price mt-1">$56.00</div> <!-- price-wrap.// -->
      </figcaption>
    </div>
  </div> <!-- col.// -->
  <div class="col-md-3">
    <div href="#" class="card card-product-grid">
      <a href="#" class="img-wrap"> <img src="assets/images/items/9.jpg"> </a>
      <figcaption class="info-wrap">
        <a href="#" class="title">Just another product name</a>
        
        <div class="rating-wrap">
          <ul class="rating-stars">
            <li style="width:80%" class="stars-active"> 
              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
            </li>
            <li>
              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
            </li>
          </ul>
          <span class="label-rating text-muted"> 34 reviws</span>
        </div>
        <div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
      </figcaption>
    </div>
  </div> <!-- col.// -->
</div> <!-- row.// -->

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->



<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-bottom-sm">
<div class="container">

<header class="section-heading">
  <a href="#" class="btn btn-outline-primary float-right">See all</a>
  <h3 class="section-title">Recommended</h3>
</header><!-- sect-heading -->

<div class="row">
  <div class="col-md-3">
    <div href="#" class="card card-product-grid">
      <a href="#" class="img-wrap"> <img src="assets/images/items/1.jpg"> </a>
      <figcaption class="info-wrap">
        <a href="#" class="title">Just another product name</a>
        <div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
      </figcaption>
    </div>
  </div> <!-- col.// -->
  <div class="col-md-3">
    <div href="#" class="card card-product-grid">
      <a href="#" class="img-wrap"> <img src="assets/images/items/2.jpg"> </a>
      <figcaption class="info-wrap">
        <a href="#" class="title">Some item name here</a>
        <div class="price mt-1">$280.00</div> <!-- price-wrap.// -->
      </figcaption>
    </div>
  </div> <!-- col.// -->
  <div class="col-md-3">
    <div href="#" class="card card-product-grid">
      <a href="#" class="img-wrap"> <img src="assets/images/items/3.jpg"> </a>
      <figcaption class="info-wrap">
        <a href="#" class="title">Great product name here</a>
        <div class="price mt-1">$56.00</div> <!-- price-wrap.// -->
      </figcaption>
    </div>
  </div> <!-- col.// -->
  <div class="col-md-3">
    <div href="#" class="card card-product-grid">
      <a href="#" class="img-wrap"> <img src="assets/images/items/4.jpg"> </a>
      <figcaption class="info-wrap">
        <a href="#" class="title">Just another product name</a>
        <div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
      </figcaption>
    </div>
  </div> <!-- col.// -->
</div> <!-- row.// -->

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<!-- ========================= SECTION  ========================= -->
<section class="section-name bg padding-y-sm">
<div class="container">
<header class="section-heading">
  <h3 class="section-title">Our Brands</h3>
</header><!-- sect-heading -->

<div class="row">
  <div class="col-md-2 col-6">
    <figure class="box item-logo">
      <a href="#"><img src="assets/images/logos/logo1.png"></a>
      <figcaption class="border-top pt-2">36 Products</figcaption>
    </figure> <!-- item-logo.// -->
  </div> <!-- col.// -->
  <div class="col-md-2  col-6">
    <figure class="box item-logo">
      <a href="#"><img src="assets/images/logos/logo2.png"></a>
      <figcaption class="border-top pt-2">980 Products</figcaption>
    </figure> <!-- item-logo.// -->
  </div> <!-- col.// -->
  <div class="col-md-2  col-6">
    <figure class="box item-logo">
      <a href="#"><img src="assets/images/logos/logo3.png"></a>
      <figcaption class="border-top pt-2">25 Products</figcaption>
    </figure> <!-- item-logo.// -->
  </div> <!-- col.// -->
  <div class="col-md-2  col-6">
    <figure class="box item-logo">
      <a href="#"><img src="assets/images/logos/logo4.png"></a>
      <figcaption class="border-top pt-2">72 Products</figcaption>
    </figure> <!-- item-logo.// -->
  </div> <!-- col.// -->
  <div class="col-md-2  col-6">
    <figure class="box item-logo">
      <a href="#"><img src="assets/images/logos/logo5.png"></a>
      <figcaption class="border-top pt-2">41 Products</figcaption>
    </figure> <!-- item-logo.// -->
  </div> <!-- col.// -->
  <div class="col-md-2  col-6">
    <figure class="box item-logo">
      <a href="#"><img src="assets/images/logos/logo2.png"></a>
      <figcaption class="border-top pt-2">12 Products</figcaption>
    </figure> <!-- item-logo.// -->
  </div> <!-- col.// -->
</div> <!-- row.// -->
</div><!-- container // -->
</section>
<!-- ========================= SECTION  END// ========================= -->



<!-- ========================= SECTION  ========================= -->
<section class="section-name padding-y">
<div class="container">

<h3 class="mb-3">Download app demo text</h3>

<a href="#"><img src="assets/images/misc/appstore.png" height="40"></a>
<a href="#"><img src="assets/images/misc/appstore.png" height="40"></a>

</div><!-- container // -->
</section>
<!-- ========================= SECTION  END// ======================= -->




<!-- ========================= FOOTER ========================= -->
<footer class="section-footer border-top bg">
  <div class="container">
    <section class="footer-top  padding-y">
      <div class="row">
        <aside class="col-md col-6">
          <h6 class="title">Brands</h6>
          <ul class="list-unstyled">
            <li> <a href="#">Adidas</a></li>
            <li> <a href="#">Puma</a></li>
            <li> <a href="#">Reebok</a></li>
            <li> <a href="#">Nike</a></li>
          </ul>
        </aside>
        <aside class="col-md col-6">
          <h6 class="title">Company</h6>
          <ul class="list-unstyled">
            <li> <a href="#">About us</a></li>
            <li> <a href="#">Career</a></li>
            <li> <a href="#">Find a store</a></li>
            <li> <a href="#">Rules and terms</a></li>
            <li> <a href="#">Sitemap</a></li>
          </ul>
        </aside>
        <aside class="col-md col-6">
          <h6 class="title">Help</h6>
          <ul class="list-unstyled">
            <li> <a href="#">Contact us</a></li>
            <li> <a href="#">Money refund</a></li>
            <li> <a href="#">Order status</a></li>
            <li> <a href="#">Shipping info</a></li>
            <li> <a href="#">Open dispute</a></li>
          </ul>
        </aside>
        <aside class="col-md col-6">
          <h6 class="title">Account</h6>
          <ul class="list-unstyled">
            <li> <a href="#"> User Login </a></li>
            <li> <a href="#"> User register </a></li>
            <li> <a href="#"> Account Setting </a></li>
            <li> <a href="#"> My Orders </a></li>
          </ul>
        </aside>
        <aside class="col-md">
          <h6 class="title">Social</h6>
          <ul class="list-unstyled">
            <li><a href="#"> <i class="fab fa-facebook"></i> Facebook </a></li>
            <li><a href="#"> <i class="fab fa-twitter"></i> Twitter </a></li>
            <li><a href="#"> <i class="fab fa-instagram"></i> Instagram </a></li>
            <li><a href="#"> <i class="fab fa-youtube"></i> Youtube </a></li>
          </ul>
        </aside>
      </div> <!-- row.// -->
    </section>  <!-- footer-top.// -->

    <section class="footer-bottom row">
      <div class="col-md-2">
        <p class="text-muted">   2021 Company name </p>
      </div>
      <div class="col-md-8 text-md-center">
        <span  class="px-2">info@com</span>
        <span  class="px-2">+000-000-0000</span>
        <span  class="px-2">Street name 123, ABC</span>
      </div>
      <div class="col-md-2 text-md-right text-muted">
        <i class="fab fa-lg fa-cc-visa"></i> 
        <i class="fab fa-lg fa-cc-paypal"></i> 
        <i class="fab fa-lg fa-cc-mastercard"></i>
      </div>
    </section>
  </div><!-- //container -->
</footer>

<!-- Modal Customer -->
<div class="modal fade" id="formCustomer" tabindex="-1" role="dialog" aria-labelledby="formCustomer" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 
      <div class="modal-header">
        <h5 class="modal-title" id="RegisterLabel">Registrasi Customer</h5>
      </div>
      <div class="modal-body">
        <form action="{{url('/registerCustomer')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <!-- Nama -->
        <div class="form-group">
          <label for="name">Nama Lengkap <i style="color: red;">*</i></label>
          <input name="name" type="text" class="form-control" id="name" placeholder="Nama Lengkap" required="">
        </div>
        <!-- Email -->
        <div class="form-group">
          <label for="email">Email <i style="color: red;">*</i></label>
          <input name="email" type="email" class="form-control" id="email" placeholder="E-Mail">
        </div>
        <!-- Password -->
        <div class="form-group">
          <label for="password">Password <i style="color: red;">*</i></label>
          <div class="input-group" id="show_hide_password">
            <input name="password" type="password" minlength="8" class="form-control" id="password" placeholder="Password">
            <a href="">
              <div class="input-group-addon eye">
                <i class="fa fa-eye-slash" aria-hidden="true"></i>
              </div>
            </a>
          </div>
        </div>
        <!-- Gender -->
        <div class="form-group">
          <label for="gender">Jenis Kelamin <i style="color: red;">*</i></label><br>
          <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="gender" value="L" id="male" checked="">
            <label class="form-check-label">Laki - Laki</label>
          </div>
          <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="gender" value="P" id="female">
            <label class="form-check-label">Perempuan</label>
          </div>
        </div>
        <!-- Phone -->
        <div class="form-group">
          <label for="phone">Nomor Telepon <i style="color: red;">*</i></label>
          <input name="phone_number" type="tel" class="form-control" id="phone" placeholder="Nomor Telepon">
        </div>
        <!-- Address -->
        <div class="form-group">
          <label for="address">Alamat <i style="color: red;">*</i></label>
          <textarea name="address" id="address" class="form-control" required=""></textarea>
        </div>

        <!-- Upload image input-->
        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
          <input id="upload" type="file" name="avatar" onchange="readURL(this);" class="form-control">
          <label id="upload-label" for="upload" class="font-weight-light text-muted">Upload Foto disini ...</label>
          <div class="input-group-append">
            <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2"></i><small style="font-size: 12px;" class="text-bold">Pilih Foto</small></label>
          </div>
        </div>

        <!-- Uploaded image area-->
        <p class="font-italic text-center">Gambar preview akan ditampilkan dibawah</p>
        <div class="image-area mt-4">
          <img id="imageResult" src="{{asset('assets/img/dummy/avatar/no-avatar.jpg')}}" alt="" width="300px" height="300px" class="img-fluid rounded shadow-sm mx-auto d-block">
        </div>
        <br>
        <span style="font-size: 12px;"><i style="color: red;"> * </i> : Data harus terisi</span><br>
      </div>
      <div class="modal-footer">
        <!-- Button -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Register</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End of Modal Customer -->

<!-- ========================= FOOTER END // ========================= -->
<!-- Javascript Family         -->
    <script src="{{asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('assets/js/bootstrap-show-password.js')}}"></script>
    <script src="{{asset('assets/js/toastr.min.js')}}"></script>
    <script src="{{ asset('assets/js/upload-images.js') }}"></script>

    <!-- Toaster -->
    <script>
      @if(Session::has('message'))
        toastr.success("{{ Session::get('message') }}");
      @elseif(Session::has('bye'))
        toastr.error("{{ Session::get('bye') }}");
      @endif
    </script>

    <!-- Toastr Validation -->
    <script>
      @if($errors->any())
        @foreach($errors->all() as $error)
          toastr.error("{{ $error }}");
        @endforeach
      @endif
    </script>
  </body>
</html>