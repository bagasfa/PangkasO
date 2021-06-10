$(document).ready(function() {

    //DATATABLE SOSMED
	LoadTableRoles();
	function LoadTableRoles() {
        // AlertCount();
		$('#datatable-roles').load('/admin-panel/roles/load/table-roles', function() {
			$('#table-roles').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: '/admin-panel/roles/load/data-roles',
					type: 'get'
				},
				columns: [
					{
						data: 'DT_RowIndex',
						name: 'DT_RowIndex',
                        className: 'text-center',
						searchable: false
					},
					{
						data: 'role_name',
						name: 'role_name'
					},
					{
						data: 'created_at',
						name: 'created_at',
                        className: 'text-center'
					},
					{
						data: 'aksi',
						name: 'aksi',
                        className: 'text-center',
						searchable: false,
						orderable: false
					}
				]
			});
		});
    }

    //OPEN MODAL TAMBAH ROLES
    $("#btn-modal-roles").on("click",function(e){
        e.preventDefault()
        $(".btn-close").css("display","");
        $(".btn-submit-roles").css("display","");
        $(".btn-loading").css("display","none");
        $("#RolesModal").modal("show");
    });

    //SUBMIT ROLES
    $("body").on("submit","#FormAddRoles", function(e){
        e.preventDefault()
        $(".btn-submit-roles").css("display","none");
        $(".btn-loading").css("display","");
        $(".btn-close").css("display","none");
        var data = $("#FormAddRoles").serialize();
        var role_name = $("#role_name").val();

        if(role_name != ''){
            $.ajax({
                type: "post",
                url: "/admin-panel/roles/add",
                data: data,
                success: function(response){
                    LoadTableRoles();
                    $("#RolesModal").modal("hide");
                    $("#FormAddRoles").trigger("reset");
                    $(".btn-submit-roles").css("display","");
                    $(".btn-loading").css("display","none");
                    $(".btn-close").css("display","");
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Berhasil Menambahkan Role',
                        timer: 1200,
                        showConfirmButton: false
                    });
                },
                error: function(err){
                    console.log(err);
                }
            })
        }else{
            $(".btn-submit-roles").css("display","");
            $(".btn-loading").css("display","none");
            $(".btn-close").css("display","");
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Form tidak boleh kosong!',
                timer: 1200,
                showConfirmButton: false
            });
        }

    })

    //DELETE ROLES
    $("body").on("click",".btn-delete-roles", function(e){
        e.preventDefault()
        var id = $(this).attr("data-id");
        var role_name = $(this).attr("data-role_name");

        Swal.fire({
			title: 'Hapus ' + role_name + '?',
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
					url: '/admin-panel/roles/delete/' + id,
					success: function(response) {
						Swal.fire('Deleted!', role_name + ' telah dihapus.', 'success');
						LoadTableRoles();
					},
					error: function(err) {
						console.log(err);
					}
				});
			}
		});
    })

    //OPEN MODAL EDIT ROLES
    $("body").on("click",".btn-edit-roles",function(e){
        e.preventDefault()
        $(".btn-close").css("display","");
        $(".btn-save-roles").css("display","");
        $(".btn-loading").css("display","none");
        $("#editRolesModal").modal("show");
        var id = $(this).attr("data-id");
        var role_name = $(this).attr("data-role_name");

        $("#id-roles").val(id);
        $("#edit_role_name").val(role_name);
    })

    //SAVE EDIT ROLES
    $("body").on("submit","#FormEditRoles", function(e){
        e.preventDefault()
        var id = $("#id-roles").val();
        var data = $("#FormEditRoles").serialize();
        var role_name = $("#edit_role_name").val();

        $(".btn-close").css("display","none");
        $(".btn-save-roles").css("display","none");
        $(".btn-loading").css("display","");

        if(role_name != ''){
            $.ajax({
                type: "post",
                url: "/admin-panel/roles/update/"+id,
                data: data,
                success: function(response){
                    LoadTableRoles();
                    $(".btn-close").css("display","");
                    $(".btn-save-roles").css("display","");
                    $(".btn-loading").css("display","none");
                    $("#FormEditRoles").trigger("reset");
                    $("#editRolesModal").modal("hide");
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Berhasil Memperbarui Role',
                        timer: 1200,
                        showConfirmButton: false
                    });
                },
                error: function(err){
                    console.log(err);
                }
            })
        }else{
            $(".btn-close").css("display","");
            $(".btn-save-roles").css("display","");
            $(".btn-loading").css("display","none");
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Form tidak boleh kosong!',
                timer: 1200,
                showConfirmButton: false
            });
        }

    });

    //ALERT HISTORY COUNT
    // function AlertCount(){
    //     $.ajax({
    //         type: "get",
    //         url: "/count-today-history-alert",
    //         success: function(response){
    //             $("#jumlah_history_today").html(response.total);
    //         },
    //         error: function(err){
    //             console.log(err);
    //         }
    //     });
    // }
    
});
