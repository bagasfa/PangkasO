@extends('Back.Template.layouts.app')

@section('title', 'Verify Owners Identity')

@section('content')
<section class="section">
  
  <div class="section-header">
    <h1>
      Verify Owners Identity
    </h1>
  </div>

  <div class="col-12">
    <div class="card card-warning">
      <div class="card-header">
        <div class="badge badge-warning mr-3"><b>Verifikasi Pending</b> : {{$pending}}</div>
        <h4>&nbsp;</h4>
        <div class="card-header-action">
          <a data-collapse="#pending" class="btn btn-icon btn-warning" href="#"><i class="fas fa-minus"></i></a>
        </div>
      </div>
      <div class="collapse show" id="pending">
        <div class="card-body table-responsive">
          <table class="table table-borderless table-striped table-hover">
            <thead>
              <tr>
                <th scope="col" width="5%"><center>#</center></th>
                <th scope="col">NIK</th>
                <th scope="col">Nama</th>
                <th scope="col"><center>KTP</center></th>
                <th scope="col"><center>Selfie KTP</center></th>
                <th scope="col"><center>Aksi</center></th>
              </tr>
            </thead>
            <tbody>
             @forelse($data_pending as $key => $pending)
              <tr>
                <td align="center">{{ $data_pending->firstItem() + $key }}</td>
                <td>{{ $pending->nik }}</td>
                <td>{{ $pending->name }}</td>
                <td align="center">
                  <a href="{{url('assets/images/users/identity/'.$pending->ktp)}}" data-fancybox data-caption="KTP dengan NIK {{$pending->nik}}. milik {{$pending->name}}">
                    <div class="badge badge-success"><b>Lihat KTP</b></div>
                  </a>
                </td>
                <td align="center">
                  <a href="{{url('assets/images/users/identity/'.$pending->ktp_user)}}" data-fancybox data-caption="KTP dengan NIK {{$pending->nik}}. milik {{$pending->name}}">
                    <div class="badge badge-warning"><b>Lihat Selfie</b></div>
                  </a>
                </td>
                <td align="center">
                  <a class="nounderline mr-1" href="{{url('/admin-panel/verify/approve/'.$pending->id)}}">
                    <button type="button" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="left" title="Approve">
                      <i class="fas fa-check"></i>
                    </button>
                  </a>
                  <a class="nounderline" href="{{url('/admin-panel/verify/reject/'.$pending->id)}}">
                    <button type="button" class="btn btn-outline-danger" data-toggle="tooltip" data-placement="right" title="Reject">
                      <i class="fas fa-times"></i>
                    </button>
                  </a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6"><center>Data kosong</center></td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="card-footer">
          <div class="pull-right">{!! $data_pending->appends(request()->except('page'))->render() !!}</div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="card card-success">
      <div class="card-header">
        <div class="badge badge-success"><b>Verifikasi Selesai</b> : {{$approved}}</div>
        <h4>&nbsp;</h4>
        <div class="card-header-action">
          <a data-collapse="#success" class="btn btn-icon btn-success" href="#"><i class="fas fa-minus"></i></a>
        </div>
      </div>
      <div class="collapse show" id="success">
        <div class="card-body table-responsive">
          <table class="table table-borderless table-striped table-hover">
            <thead>
              <tr>
                <th scope="col" width="5%"><center>#</center></th>
                <th scope="col">NIK</th>
                <th scope="col">Nama</th>
                <th scope="col"><center>KTP</center></th>
                <th scope="col"><center>Selfie KTP</center></th>
                <th scope="col">Pengajuan</th>
                <th scope="col">Diverifikasi</th>
              </tr>
            </thead>
            <tbody>
             @forelse($data_approved as $key => $approved)
              <tr>
                <td align="center">{{ $data_approved->firstItem() + $key }}</td>
                <td>{{ $approved->nik }}</td>
                <td>{{ $approved->name }}</td>
                <td align="center">
                  <a href="{{url('assets/images/users/identity/'.$approved->ktp)}}" data-fancybox data-caption="KTP dengan NIK {{$approved->nik}}. milik {{$approved->name}}">
                    <div class="badge badge-success"><b>Lihat KTP</b></div>
                  </a>
                </td>
                <td align="center">
                  <a href="{{url('assets/images/users/identity/'.$approved->ktp_user)}}" data-fancybox data-caption="KTP dengan NIK {{$approved->nik}}. milik {{$approved->name}}">
                    <div class="badge badge-warning"><b>Lihat Selfie</b></div>
                  </a>
                </td>
                <td>{{ $approved->created_at }}</td>
                <td>{{ $approved->updated_at }}</td>
              </tr>
              @empty
              <tr>
                <td colspan="7"><center>Data kosong</center></td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="card-footer">
          <div class="pull-right">{!! $data_approved->appends(request()->except('page'))->render() !!}</div>
        </div>
      </div>
    </div>
  </div>
    
</section>
@endsection