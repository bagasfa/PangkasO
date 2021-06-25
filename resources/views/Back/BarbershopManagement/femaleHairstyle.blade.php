@extends('Back.Template.layouts.app')

@section('title', 'Male Hairtyle')

@section('content')
<script type="text/javascript">
  document.getElementById('hairstyle').classList.add('active');
</script>
<section class="section">
  
  <div class="section-header">
    <h1>Female Hairstyle</h1>
  </div>

  <div class="section-body">
    <div class="col-12 col-md-12 col-lg-12">
      <div class="row">
        <div class="col-12 col-sm-2 col-md-2 col-lg-2">
          <div class="card-add" data-toggle="modal" data-target="#addHairstyle" title="Tambah Hairstyle Baru">
            <!-- Modal Button -->
          </div>
        </div>
        @foreach($hairstyle as $h)
        <div class="col-12 col-sm-2 col-md-2 col-lg-2">
          <div class="card-sl">
            <div class="card-image">
              <a href="/assets/images/barbershop/hairstyle/{{$h->images}}" data-fancybox data-caption="Preview {{$h->name}} Hairstyle">
                <img src="/assets/images/barbershop/hairstyle/{{$h->images}}" />
              </a>
            </div>
            <a class="card-action btn-delete-hairstyle" data-id="{{$h->id}}" data-name="{{$h->name}}"><i class="fa fa-trash"></i></a>
            <div class="card-heading">
              {{$h->name}}
            </div>
            <div class="card-text">
              @if($h->deskripsi)
                {{$h->deskripsi}}
              @else
                Tidak Ada Deskripsi.
              @endif
            </div>
            <div class="card-text">
              <label class="float-left mr-1">Rp.</label><p class="uang">{{$h->price}}</p>
            </div>
            <a class="card-button btn-edit-hairstyle" data-id="{{$h->id}}">Edit</a>
          </div>
        </div>
        @endforeach
      </div>

    </div>  
  </div>
</section>

<!-- Add Hairstyle Modal-->
<div class="modal fade" id="addHairstyle" tabindex="-1" role="dialog" aria-labelledby="AddHairstyleModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Hairstyle</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form accept-charset="utf-8" enctype="multipart/form-data" method="post" action="{{url('owner-panel/hairstyle/add')}}">
          @csrf
          <!-- Hairstyle Name -->
          <div class="form-group">
            <label for="name">Nama Hairstyle <i style="color: red;">*</i></label>
            <input type="text" class="form-control" id="name" name="name" autocomplete="new-password">
            <!-- Hidden -->
            <input type="hidden" name="gender" value="female">
            <input type="hidden" name="barbershop_id" value="{{$barber->id}}">
          </div>
          <!-- Harga -->
          <div class="form-group">
            <label for="harga">Harga <i style="color: red;">*</i></label>
            <div class="input-group-prepend">
              <div class="input-group-text">
                Rp.
              </div>
              <input type="tel" class="form-control" id="harga" name="price" maxlength="8" autocomplete="new-password">
            </div>
          </div>
          <!-- Deskripsi -->
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
          </div>
          <!-- Upload image input-->
          <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
            <input id="upload" type="file" name="images" onchange="readURL(this);" class="form-control">
            <label id="upload-label" for="upload" class="font-weight-light text-muted">Upload Foto disini ...</label>
            <div class="input-group-append">
              <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fas fa-cloud-upload-alt mr-2 text-muted"></i> <small style="font-size: 12px;" class="text-bold">Pilih Foto</small> <i style="color: red;">*</i></label>
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
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Submit</button>
          <button class="btn btn-primary btn-loading" type="button" style="display: none;" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Memproses...
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editHairstyle" tabindex="-1" role="dialog" aria-labelledby="EditHairstyleModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Hairstyle</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form accept-charset="utf-8" enctype="multipart/form-data" method="post" id="form-hairstyle-edit">
          @csrf

          <!-- Hairstyle Name -->
          <div class="form-group">
            <label for="edit-name">Nama Hairstyle <i style="color: red;">*</i></label>
            <input type="text" class="form-control" id="edit-name" name="edit-name" autocomplete="new-password">
            <!-- Hidden -->
            <input type="hidden" name="token" value="{{ csrf_token() }}">
            <input type="hidden" name="edit-id" value=""/>
          </div>
          <!-- Harga -->
          <div class="form-group">
            <label for="edit-price">Harga <i style="color: red;">*</i></label>
            <div class="input-group-prepend">
              <div class="input-group-text">
                Rp.
              </div>
              <input type="tel" class="form-control" id="edit-price" name="edit-price" maxlength="8" autocomplete="new-password">
            </div>
          </div>
          <!-- Deskripsi -->
          <div class="form-group">
            <label for="edit-deskripsi">Deskripsi</label>
            <textarea class="form-control" name="edit-deskripsi" id="edit-deskripsi"></textarea>
          </div>
          <div class="form-group mt-3">
              <label for="images">Gambar Preview Hairstyle</label>
              <input class="form-control" input id="edit-images" type="file" name="edit-images" accept="image/*" onchange="readURLe(this);" aria-describedby="inputGroupFileAddon01">
              <script>
                function readURLe(input) {
                  if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                      $('#blah-edit').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                  }
                }
              </script>
              <label for="blah"></label>
              <img id="blah-edit" class="rounded mx-auto d-block" height="200px" src="#" alt="Gambar Preview" />
          </div>
          <br>
          <span style="font-size: 12px;"><i style="color: red;"> * </i> : Data harus terisi</span><br>
          
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-close-edit" type="button" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="btn-save-hairstyle">Simpan</button>
        <button class="btn btn-primary btn-loading-edit" type="button" style="display: none;" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          Memproses...
        </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@push('stylesheet')
  <link rel="stylesheet" href="{{url('assets/css/hairstyle-card.css')}}">
@endpush
@push('javascript')
  <script src="{{ asset('assets/js/upload-images.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ asset('assets/js/AdminPanel/Barbershop/hairstyle.js') }}"></script>
@endpush
