<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'PangkasO')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/img/logo/logo.png') }}" type="image/x-icon"/>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/stisla-custom.css') }}">
    @stack('stylesheet')        
  </head>
  <body>
    <header class="section-header">
      <nav class="navbar navbar-dark navbar-expand p-0 bg-primary">
        <div class="container">
            <ul class="navbar-nav d-none d-md-flex mr-auto">
            <li class="nav-item"><a id="home" class="nav-link" href="{{ url('/') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/barbershop') }}">Barbershop</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/hairstyle') }}">Hairstyle</a></li>
            </ul>
            <ul class="navbar-nav">
            <li  class="nav-item"><a href="#" class="nav-link"> Call Center: +62 8961-2625-259</a></li>
          </ul> <!-- list-inline //  -->
        </div> <!-- container //  -->
      </nav> <!-- header-top-light.// -->

      <section class="header-main border-bottom">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-2 col-6">
              <a href="{{ url('/') }}" class="brand-wrap nounderline">
                <h1 class="mb-2 mr-2 display-4 font-weight-bold brand-logo"><img src="{{ asset('assets/img/logo/logo-horizontal.png') }}" width="100%"></h1>
              </a> <!-- brand-wrap.// -->
            </div>
            <div class="col-lg-6 col-12 col-sm-12">
              <form action="{{url('/hairstyle/search')}}" method="get" class="search">
                <div class="p-1 bg-light rounded rounded-pill shadow-sm">
                  <div class="input-group">
                    <input type="search" name="search" placeholder="Cari Hairstyle disini ..." aria-describedby="button-addon1" class="form-control border-0 bg-light">
                    <div class="input-group-append">
                      <button id="button-addon1" type="submit" class="btn btn-link text-primary pt-2"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </form> <!-- search-wrap .end// -->
            </div> <!-- col.// -->
            <div class="col-lg-4 col-sm-6 col-12">
              <div class="widgets-wrap float-md-right">
                <div class="widget-header" style="margin-right: 5px;">
                  <a href="{{ url('/orders') }}" class="icon icon-sm rounded-circle border"><i class="fa fa-receipt"></i></a>
                  @guest
                  @else
                  @if(auth()->user()->id_role == 4)
                  <span id="pending-counter" class="badge badge-pill badge-danger notify" style="font-size: 0.7em; top: -10px; left: 28px;"></span>
                  @endif
                  @endguest
                </div>
                <div class="widget-header icontext">
                @if(auth()->check())
                  <a href="#" data-toggle="dropdown" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ url('/profile') }}"><i class="fas fa-user"></i> Profile</a>
                    <a class="dropdown-item" href="" data-toggle="modal" data-target="#updatePassword"><i class="fas fa-key"></i> Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('/orders/history') }}"><i class="fas fa-history"></i> Order History</a>
                    <a class="dropdown-item" href="{{ url('/activity') }}"><i class="fas fa-bolt"></i> Activity</a>
                  @if(auth()->user()->verify_status != 'Approved')
                    <a class="dropdown-item" href="{{ url('/verify') }}"><i class="fas fa-id-card"></i> Verify Identity</a>
                  @endif
                  </div>
                @else
                  <a href="#" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>
                @endif
                  
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
                <a class="nav-link pl-0" data-toggle="dropdown" href="#"><strong> <i class="fas fa-cut"></i> Hairstyle</strong></a>
                <div class="dropdown-menu">
                  <a id="male" class="dropdown-item" href="{{ url('/hairstyle/male') }}">Pria</a>
                  <a id="female" class="dropdown-item" href="{{ url('/hairstyle/female') }}">Wanita</a>
                  <a id="hairstyle" class="dropdown-item" href="{{ url('/hairstyle') }}">Semua</a>
                </div>
              </li>
              <li class="nav-item">
                <a id="barbershop" class="nav-link" href="{{ url('/barbershop') }}">Barbershop</a>
              </li>
            </ul>
          </div> <!-- collapse .// -->
        </div> <!-- container .// -->
      </nav>
    </header> <!-- section-header.// -->

    @yield('content')
    @stack('modal')

    <!-- ========================= FOOTER ========================= -->
    <footer class="section-footer border-top bg">
      <div class="container">
        <section class="footer-top  padding-y">
          <div class="row">
            <aside class="col-md col-6">
              <h6 class="mb-3">Download our Apps</h6>
              <div class="mb-2">
                <a href="#"><img src="{{asset('assets/images/misc/playstore.png')}}" height="35"></a>
              </div>
              <div class="mb-2">
                <a href="#"><img src="{{asset('assets/images/misc/appstore.png')}}" height="35"></a>
              </div>
            </aside>
            <aside class="col-md col-6">
              <h6 class="title">Company</h6>
              <ul class="list-unstyled">
                <li> <a href="{{ url('/about') }}">About us</a></li>
                <li> <a href="{{ url('/career') }}">Career</a></li>
                <li> <a href="{{ url('/rules') }}">Rules and terms</a></li>
              </ul>
            </aside>
            <aside class="col-md col-6">
              <h6 class="title">Help</h6>
              <ul class="list-unstyled">
                <li> <a href="{{ url('/contact') }}">Contact us</a></li>
                <li> <a href="{{ url('/faq') }}">FAQ</a></li>
              </ul>
            </aside>
            <aside class="col-md col-6">
              <h6 class="title">Account</h6>
              <ul class="list-unstyled">
              @guest
                <li> <a href="" data-toggle="modal" data-target="#loginForm"> Login </a></li>
                <li> <a href="" data-toggle="modal" data-target="#formCustomer"> Register </a></li>
              @else
              @endguest
                <li> <a href="{{ url('/profile') }}"> Account Setting </a></li>
                <li> <a href="{{ url('/cart') }}"> My Orders </a></li>
              </ul>
            </aside>
            <aside class="col-md">
              <h6 class="title">Social</h6>
              <ul class="list-unstyled">
                <li><a href="#" class="nounderline"> <i class="fab fa-facebook"></i> Facebook </a></li>
                <li><a href="#" class="nounderline"> <i class="fab fa-twitter"></i> Twitter </a></li>
                <li><a href="#" class="nounderline"> <i class="fab fa-instagram"></i> Instagram </a></li>
                <li><a href="#" class="nounderline"> <i class="fab fa-youtube"></i> Youtube </a></li>
              </ul>
            </aside>
          </div> <!-- row.// -->
        </section>  <!-- footer-top.// -->

        <section class="footer-bottom row">
          <div class="col-md-2">
            <p class="text-muted">Copyright © <span id="copyright-year"></span> PangkasO </p>
          </div>
          <div class="col-md-10">
            <span class="px-2">info@pangkaso.com</span>
            <span class="px-2">+62 8961-2625-259</span>
          </div>
        </section>
      </div><!-- //container -->
    </footer>
    <!-- ========================= FOOTER END // ========================= -->

    <!-- ========================= UBAH PASSWORD MODAL ========================= -->
    <div class="modal fade" id="updatePassword" tabindex="-1" role="dialog" aria-labelledby="updatePassword" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content"> 
          <div class="modal-header">
            <h5 class="modal-title">Update Password</h5>
          </div>
          <div class="modal-body">
            <form action="{{url('/password/update')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="form-group">
              <label for="oldPassword">Password Lama <i style="color: red;">*</i></label>
              <div class="input-group" id="show_hide_password">
                <input name="oldPassword" type="password" class="form-control" id="oldPassword" required="">
                <a href=""><div class="input-group-addon eye">
                  <i class="fa fa-eye-slash" aria-hidden="true"></i>
                </div></a>
              </div>
            </div><hr>

            <div class="form-group">
              <label for="newPassword">Password Baru <i style="color: red;">*</i></label>
              <div class="input-group" id="show_hide_password">
                <input name="newPassword" type="password" class="form-control" id="newPassword" required="">
                <a href=""><div class="input-group-addon eye">
                  <i class="fa fa-eye-slash" aria-hidden="true"></i>
                </div></a>
              </div>
            </div>

            <div class="form-group">
              <label for="confirmPassword">Konfirmasi Password Baru <i style="color: red;">*</i></label>
              <div class="input-group" id="show_hide_password">
                <input name="confirmPassword" type="password" class="form-control" id="confirmPassword" required="">
                <a href=""><div class="input-group-addon eye">
                  <i class="fa fa-eye-slash" aria-hidden="true"></i>
                </div></a>
              </div>
            </div>
            
            <br>
            <span style="font-size: 12px;"><i style="color: red;"> * </i> : Data harus terisi</span><br>
          </div>
          <div class="modal-footer">
            <!-- Button -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- ========================= UBAH PASSWORD MODAL END // ========================= -->

    <!-- ========================= LOGIN MODAL ========================= -->
    <div class="modal fade" id="loginForm" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content"> 
          <div class="modal-header">
            <h5 class="modal-title" id="loginForm">Silahkan Login Terlebih dahulu</h5>
            <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Form Login -->
            <form method="POST" action="{{ url('/postLogin') }}">
              {{csrf_field()}}
              <!-- Email -->
              <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" placeholder="E-Mail" tabindex="1" autofocus>
              </div>
              <!-- Password -->
              <div class="form-group">
                <div class="d-block">
                  <label for="password" class="control-label">Password</label>
                </div>
                <div class="input-group" id="show_hide_password">
                  <input name="password" type="password" minlength="8" class="form-control" tabindex="2" id="password" placeholder="Password">
                  <!-- Show Hide Password Component -->
                  <a href=""><div class="input-group-addon eye">
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                  </div></a>
                </div>
              </div>
              <div class="form-group text-right">
                <p><a href="{{ route('password.request') }}" class="nounderline">Lupa Password ?</a></p>
                <div class="float-right">
                  <!-- Button -->
                  <button type="submit" class="btn btn-primary">Login</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- ========================= LOGIN MODAL END // ========================= -->

    <!-- ========================= REGISTRATION MODAL ========================= -->
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
              <label for="reg-email">Email <i style="color: red;">*</i></label>
              <input name="email" type="email" class="form-control" id="reg-email" placeholder="E-Mail">
            </div>
            <!-- Password -->
            <div class="form-group">
              <label for="reg-password">Password <i style="color: red;">*</i></label>
              <div class="input-group" id="show_hide_password">
                <input name="password" type="password" minlength="8" class="form-control" id="reg-password" placeholder="Password">
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
                <label for="upload" class="btn btn-light m-0 rounded-pill px-4"><i class="fa fa-cloud-upload-alt mr-2"></i> <small style="font-size: 12px;" class="text-bold">Pilih Foto</small></label>
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
    <!-- ========================= REGISTRATION MODAL END // ========================= -->

    <!-- Back to Top Button -->
    <a href="#" class="scrollToTop"><i class="fas fa-chevron-up"></i></a>
    
    <!-- Javascript Family -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap-show-password.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/js/upload-images.js') }}"></script>
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyC6F6nQGKRfKiVJVZlaLuGe1YwCoRPlFjY&sensor=true"></script>
    <script src="{{ asset('assets/js/gmaps.min.js') }}"></script>
    @stack('javacsript')

    <!-- Toaster -->
    <script>
      @if(Session::has('message'))
        toastr.success("{{ Session::get('message') }}");
      @elseif(Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
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

    <!-- Format IDR -->
    <script>
      // Copyright Years
      document.querySelector('#copyright-year').innerText = new Date().getFullYear();

      // Format mata uang.
      $( '.uang' ).mask('000.000.000', {reverse: true});

      
      $(document).ready(function(){

        // Order Pending Counter
        $.ajax({
          url: '/pending-counter',
          type: 'GET',
          success: function(res) {
            document.getElementById('pending-counter').innerHTML = res.values;
          }
        });

        // Back to Top button
        $(window).scroll(function(){
          if ($(this).scrollTop() > 100) {
              $('.scrollToTop').fadeIn();
          } else {
              $('.scrollToTop').fadeOut();
          }
        });

        //Click event to scroll to top
        $('.scrollToTop').click(function(){
            $('html, body').animate({scrollTop : 0},800);
            return false;
        });

      });
    </script>
    <script>
        $('#hairstyleStar').change('.star', function(e) {
          $(this).submit();
        });

        $('#barbershopStar').change('.star', function(e) {
          $(this).submit();
        });
    </script>

  </body>
</html>