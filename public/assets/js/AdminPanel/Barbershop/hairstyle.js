$(document).ready(function(){
  // Detail Deskripsi Modal
  $('body').on('click', '.btn-detail', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    $.ajax({
      url: '/owner-panel/hairstyle/edit/' + id,
      type: 'GET',
      success: function(res) {
        $('#detail').modal({ backdrop: 'static', keyboard: false });
        $('#detail').modal('show');
        document.getElementById('detail-deskripsi').innerHTML = res.values.deskripsi;
      }
    });
    return false;
  });

  // Open Edit Modal
  $('body').on('click', '.btn-edit-hairstyle', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    $.ajax({
      url: '/owner-panel/hairstyle/edit/' + id,
      type: 'GET',
      success: function(res) {
        $('#editHairstyle').modal({ backdrop: 'static', keyboard: false });
        $('#editHairstyle').modal('show');
        $('#btn-save-hairstyle').css('display', '');
        $('input[name=edit-id]').val(id);
        $('#edit-name').val(res.values.name);
        $('#edit-price').val(res.values.price);
        $('#edit-deskripsi').val(res.values.deskripsi);
        if (res.values.images) {
          $('#blah-edit').attr('src', '/assets/images/barbershop/hairstyle/'+res.values.images);
        }
      }
    });
    return false;
  });

  // Submit Edit
  $('body').on('submit', '#form-hairstyle-edit', function(e) {
    e.preventDefault();
    $('.btn-close-edit').css('display', 'none');
    $('.btn-loading-edit').css('display', '');
    $('#btn-save-hairstyle').css('display', 'none');
    var formData = new FormData();
    var name = $('input[name=edit-name]').val();
    var price = $('input[name=edit-price]').val();
    var deskripsi = $('#edit-deskripsi').val();
    var token = $('input[name=token]').val();
    var id = $('input[name=edit-id]').val();
    formData.append('_token', token);
    formData.append('name', name);
    formData.append('price', price);
    formData.append('deskripsi', deskripsi);
    if ($('#edit-images').get(0).files.length != 0) {
      formData.append('images', $('input[type=file]')[1].files[0]);
    }
    $.ajax({
      type: 'POST',
      url: '/owner-panel/hairstyle/update/' + id,
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        $('.btn-close-edit').css('display', '');
        $('.btn-loading-edit').css('display', 'none');
        $('#btn-save-hairstyle').css('display', '');
        if (response.hasOwnProperty('error')) {
          Swal.fire({
            icon: 'error',
            title: 'Ooopss...',
            text: response.error,
            timer: 1200,
            showConfirmButton: false
          });
        } else {
          $('#editHairstyle').modal('hide');
          $('#form-hairstyle-edit').trigger('reset');
          $('#blah-edit').attr('src', '');
          location.reload();
          Swal.fire({
            icon: 'success',
            title: response.message,
            text: 'Berhasil Mengedit Hairstyle',
            timer: 1200,
            showConfirmButton: false
          });
        }
      },
      error: function(err) {
        console.log(err);
      }
    });
    return false;
  });

  // Delete Modal
  $("body").on("click",".btn-delete-hairstyle", function(e){
    e.preventDefault()
    var id = $(this).attr("data-id");
    var name = $(this).attr("data-name");

    Swal.fire({
      title: 'Hapus ' + name + '?',
      text: 'Anda tidak dapat mengurungkan aksi ini!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: 'get',
          url: '/owner-panel/hairstyle/delete/' + id,
          success: function(response) {
            Swal.fire('Deleted!', name + ' telah dihapus.', 'success');
            location.reload();
          },
          error: function(err) {
            console.log(err);
          }
        });
      }
    });
  })
})