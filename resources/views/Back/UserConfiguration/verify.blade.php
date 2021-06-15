@extends('Back.Template.layouts.app')

@section('title', 'Verify Identity')

@section('content')
<script type="text/javascript">
  document.getElementById('verify').classList.add('active');
</script>
<section class="section">
  
  <div class="section-header">
    <h1>
      Verify Identity
    </h1>
  </div>

  @if(auth()->user()->verify_status == 'Rejected')
  <div class="alert alert-danger alert-dismissible show fade">
    <div class="alert-body">
      <button class="close" data-dismiss="alert">
        <span>&times;</span>
      </button>
      Pengajuan Verifikasi Identitas anda ditolak, mohon lakukan verifikasi ulang.
    </div>
  </div>
  @elseif(auth()->user()->verify_status == 'Processed')
  <div class="alert alert-info alert-dismissible show fade">
    <div class="alert-body">
      <button class="close" data-dismiss="alert">
        <span>&times;</span>
      </button>
      Identitas anda sedang diverifikasi, proses verifikasi membutuhkan waktu 1-3 hari kerja. Mohon bersabar 😊
    </div>
  </div>
  @endif
  
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Verifikasi Identitas</h4>
        </div>
        <div class="card-body">
          <div class="row mt-4">
            <div class="col-12 col-lg-8 offset-lg-2">
              <div class="wizard-steps">
              @if(auth()->user()->verify_status == NULL || auth()->user()->verify_status == 'Rejected')
                <div class="wizard-step wizard-step-active">
                  <div class="wizard-step-icon">
                    <i class="far fa-id-card"></i>
                  </div>
                  <div class="wizard-step-label">
                    Kirim Identitas
                  </div>
                </div>
                <div class="wizard-step">
                  <div class="wizard-step-icon">
                    <i class="fas fa-clock"></i>
                  </div>
                  <div class="wizard-step-label">
                    Proses Verifikasi
                  </div>
                </div>
                <div class="wizard-step">
                  <div class="wizard-step-icon">
                    <i class="fas fa-server"></i>
                  </div>
                  <div class="wizard-step-label">
                    Verifikasi Selesai
                  </div>
                </div>
              </div>
            </div>
            <center><h2>Form Verifikasi</h2></center><br>
            <form name="VerifyForm" method="POST" action="{{url('/owner-panel/send-verify')}}" enctype="multipart/form-data" class="wizard-content mt-2">
              {{csrf_field()}}
              <div class="wizard-pane">
                <!-- NIK -->
                <div class="form-group row mb-4">
                  <div class="d-flex justify-content-center">
                    <div class="col-8 col-md-8 col-lg-8">
                      <input class="form-control" type="tel" name="nik" id="nik" placeholder="NOMOR INDUK KEPENDUDUKAN (NIK)">
                    </div>
                  </div>
                </div>
                <div class="form-group row justify-content-md-center">
                  <!-- KTP -->
                  <div class="col-12 col-md-6">
                    <div class="card card-primary">
                      <div class="card-header">
                        <h4>Scan KTP</h4>
                        <div class="card-header-action">
                          <a data-collapse="#ktp-input" class="btn btn-icon btn-primary" href="#"><i class="fas fa-minus"></i></a>
                        </div>
                      </div>
                      <div class="collapse show" id="ktp-input">
                        <div class="card-body">
                          <img id="ktp_output" src="{{asset('assets/img/dummy/avatar/no-avatar.jpg')}}" width="300px" height="300px" class="img-fluid rounded shadow-sm mb-3 mx-auto d-block" alt="KTP Preview" />
                          <input id="ktp" type="file" name="ktp" class="form-control" accept="image/png, image/jpeg, image/jpg">
                        </div>
                        <div class="card-footer">
                          (*) Max. File 4MB
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- SELFIE + KTP -->
                  <div class="col-12 col-md-6">
                    <div class="card card-primary">
                      <div class="card-header">
                        <h4>Selfie Memegang KTP</h4>
                        <div class="card-header-action">
                          <a data-collapse="#ktp-user-input" class="btn btn-icon btn-primary" href="#"><i class="fas fa-minus"></i></a>
                        </div>
                      </div>
                      <div class="collapse show" id="ktp-user-input">
                        <div class="card-body">
                          <img id="ktp_user_output" src="{{asset('assets/img/dummy/avatar/no-avatar.jpg')}}" width="300px" height="300px" class="img-fluid rounded shadow-sm mb-3 mx-auto d-block" alt="KTP + User Preview" />
                          <input id="ktp_user" type="file" name="ktp_user" class="form-control mb-3" accept="image/png, image/jpeg, image/jpg">
                        </div>
                        <div class="card-footer">
                          (*) Max. File 4MB
                        </div>
                      </div>
                    </div>
                  </div>
                  <center><button type="submit" class="btn btn-primary col-8 col-md-8 col-lg-8">SUBMIT</button></center>
                </div>
              </div>
            </form>
              @elseif(auth()->user()->verify_status == 'Processed')
                <div class="wizard-step">
                  <div class="wizard-step-icon">
                    <i class="far fa-id-card"></i>
                  </div>
                  <div class="wizard-step-label">
                    Kirim Identitas
                  </div>
                </div>
                <div class="wizard-step wizard-step-active">
                  <div class="wizard-step-icon">
                    <i class="fas fa-clock"></i>
                  </div>
                  <div class="wizard-step-label">
                    Proses Verifikasi
                  </div>
                </div>
                <div class="wizard-step">
                  <div class="wizard-step-icon">
                    <i class="fas fa-server"></i>
                  </div>
                  <div class="wizard-step-label">
                    Verifikasi Selesai
                  </div>
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-center">
              <img src="{{asset('assets/img/error-handling/process.jpg')}}" width="50%">
            </div>
              @elseif(auth()->user()->verify_status == 'Approved')
                <div class="wizard-step">
                  <div class="wizard-step-icon">
                    <i class="far fa-id-card"></i>
                  </div>
                  <div class="wizard-step-label">
                    Kirim Identitas
                  </div>
                </div>
                <div class="wizard-step">
                  <div class="wizard-step-icon">
                    <i class="fas fa-clock"></i>
                  </div>
                  <div class="wizard-step-label">
                    Proses Verifikasi
                  </div>
                </div>
                <div class="wizard-step wizard-step-active">
                  <div class="wizard-step-icon">
                    <i class="fas fa-server"></i>
                  </div>
                  <div class="wizard-step-label">
                    Verifikasi Selesai
                  </div>
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-center">
              <img src="{{asset('assets/img/error-handling/success.jpg')}}" width="40%">
            </div>
              @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@push('javascript')
  <script src="{{asset('assets/js/toastr.min.js')}}"></script>
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

  <script type="text/javascript">
    ktp.onchange = evt => {
    const [file] = ktp.files
      if (file) {
          ktp_output.src = URL.createObjectURL(file)
      }
    }

    ktp_user.onchange = evt => {
    const [file] = ktp_user.files
      if (file) {
        ktp_user_output.src = URL.createObjectURL(file)
      }
    }
  </script>
@endpush