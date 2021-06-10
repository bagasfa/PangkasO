<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login Page</title>

  <!-- Logo title -->
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/ub.png')}}">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/toastr.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/stisla.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

</head>

<!-- Main Body -->
<body>
  <div id="app">
    <section class="section">
      <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
          <div class="p-4 m-3">
            <a class="back-btn" href="/">
              <label>< Kembali</label>
            </a>
            <!-- Judul Form -->
            <center><h1 class="logo">Sign In</h1></center>
            
            <!-- Form Login -->
            <form method="POST" action="{{ url('/postLogin') }}">
              {{csrf_field()}}
              <!-- Email -->
              <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" placeholder="E-Mail" tabindex="1" required autofocus>
              </div>
              <!-- Password -->
              <div class="form-group">
                <div class="d-block">
                  <label for="password" class="control-label">Password</label>
                </div>
                <div class="input-group" id="show_hide_password">
                  <input name="password" type="password" minlength="8" class="form-control" tabindex="2" id="inputPassword" placeholder="Password" required="">
                  <!-- Show Hide Password Component -->
                  <a href=""><div class="input-group-addon eye">
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                  </div></a>
                </div>
                <div class="invalid-feedback">
                  Harap Isi Password
                </div>
              </div>
              <div class="form-group text-right">
                <!-- Register Button -->
                <div class="text-left">
                  <p>Belum Punya Akun ? <a href="" data-toggle="modal" data-target="#formRegister">Daftar</a></p>
                </div>
                <!-- Login Button -->
                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                  Masuk
                </button>
              </div>
            </form>
            <!-- Copyright -->
            <div class="text-center mt-5 text-small">
              Copyright &copy; {{ date('Y') }}
            </div>
          </div>
        </div>
        <!-- Side Running Background -->
        <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="{{ asset('assets/img/login-wp.jpg') }}">
          <div class="absolute-bottom-left index-2">
            <div class="text-light p-5 pb-2">
              <div class="mb-5 pb-3">
                <h1 class="mb-2 display-4 font-weight-bold brand-logo">PangkasO</h1>
              </div>
              Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/@jeppemoenster">Jeppe Mønster</a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Modal -->
    <div class="modal fade" id="formRegister" tabindex="-1" role="dialog" aria-labelledby="formRegister" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content"> 
          <div class="modal-header">
            <h5 class="modal-title" id="RegisterLabel">Form Registrasi</h5>
          </div>
          <div class="modal-body">
            <form action="/register" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <!-- Nama -->
            <div class="form-group">
              <label for="inputNama">Nama Lengkap <i style="color: red;">*</i></label>
              <input name="name" type="text" class="form-control" id="inputNama" placeholder="Nama Lengkap" required="">
            </div>
            <!-- Email -->
            <div class="form-group">
              <label for="inputEmail">Email <i style="color: red;">*</i></label>
              <input name="email" type="email" class="form-control" id="inputEmail" placeholder="E-Mail" required="">
            </div>
            <!-- Password -->
            <div class="form-group">
              <label for="inputPassword">Password <i style="color: red;">*</i></label>
              <div class="input-group" id="show_hide_password">
                <input name="password" type="password" minlength="8" class="form-control" id="inputPassword" placeholder="Password" required="">
              <a href=""><div class="input-group-addon eye">
                <i class="fa fa-eye-slash" aria-hidden="true"></i>
              </div></a>
            </div>
            <!-- Gender -->
            <div class="form-group">
              <label for="gender">Jenis Kelamin <i style="color: red;">*</i></label><br>
              <input class="form-check-input" type="radio" name="gender" value="L" id="gender" checked="">Laki - Laki
              <input class="form-check-input" type="radio" name="gender" value="P" id="gender">Perempuan
            </div>
            <!-- Phone -->
            <div class="form-group">
              <label for="phone">Nomor Telepon <i style="color: red;">*</i></label>
              <input name="phone" type="tel" class="form-control" id="phone" placeholder="Nomor Telepon" required="">
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
            <div class="image-area mt-4"><img id="imageResult" src="#" alt="" width="300px" height="300px" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
            <!-- Hidden Role -->
            <input type="hidden" name="role" value="3">
            <br>
            <span style="font-size: 12px;"><i style="color: red;"> * </i> : Data harus terisi</span>
          </div>
          <div class="modal-footer">
            <!-- Button -->
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Register</button>
            </form>
          </div>
        </div>
      </div>
      <!-- Modal -->

  <!-- Online JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js" ></script>

  <!-- Offline JS File -->
  <script type="text/javascript" src="{{asset('assets/js/bootstrap-show-password.js')}}"></script>
  <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/toastr.min.js')}}"></script>
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/upload_images.js') }}"></script>

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