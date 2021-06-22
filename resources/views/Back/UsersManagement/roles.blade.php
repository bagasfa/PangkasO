@extends('Back.Template.layouts.app')

@section('title', 'Roles')

@section('content')
<script type="text/javascript">
  document.getElementById('roles').classList.add('active');
</script>
<section class="section">
  
  <div class="section-header">
    <h1>Roles</h1>
  </div>

  <div class="section-body">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <button type="button" class="btn btn-primary" id="btn-modal-roles"><i class="fa fa-plus"></i> Tambah Roles</button>
          </div>

          <div class="counter">
            <b>Total Roles</b> : {{$counter}}
          </div>

          <div class="card-body table-responsive">
              <div id="datatable-roles"></div>
          </div>

          <div class="card-footer text-right">
            <nav class="d-inline-block">
              
            </nav>
          </div>
        </div>
    </div>  
  </div>
</section>

<!-- Add Roles Modal-->
<div class="modal fade" id="RolesModal" tabindex="-1" role="dialog" aria-labelledby="AddRolesModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="AddRolesModal">Add Roles</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
          <form accept-charset="utf-8" id="FormAddRoles" enctype="multipart/form-data" method="post">
            @csrf
            <label for="roles_name">Nama Role</label>
            <input type="text" class="form-control" id="role_name" name="role_name">
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary btn-submit-roles">Submit</button>
            <button class="btn btn-primary btn-loading" type="button" style="display: none;" disabled>
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Memproses...
            </button>
          </form>
        </div>
    </div>
  </div>
</div>

<!-- Edit Roles Modal-->
<div class="modal fade" id="editRolesModal" tabindex="-1" role="dialog" aria-labelledby="EditRolesModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditRolesModal">Edit Roles</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form accept-charset="utf-8" enctype="multipart/form-data" method="post" id="FormEditRoles">
          @csrf
          <input type="hidden" id="id-roles" value="">
          <label for="roles_name">Nama Role</label>
          <input type="text" class="form-control" id="edit_role_name" name="role_name">
      </div>
      <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary btn-save-roles">Save</button>
          <button class="btn btn-primary btn-loading" type="button" style="display: none;" disabled>
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Memproses...
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@push('javascript')
  <script type="text/javascript" src="{{asset('assets/js/AdminPanel/UsersManagement/roles.js')}}"></script>
@endpush
