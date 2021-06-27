$(document).ready(function() {

    //DATATABLE ADMIN
	LoadAdmin();
	function LoadAdmin() {
        // AlertCount();
		$('#datatable-admin').load('/admin-panel/admins/load/table-admin', function() {
			$('#table-users').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: '/admin-panel/admins/load/data-admin',
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
						data: 'name',
						name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'gender',
                        name: 'gender',
                        className: 'text-center'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'verify_status',
                        name: 'verify_status',
                        className: 'text-center'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
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
    //OPEN MODAL TAMBAH ADMIN
    $("#btn-modal-admin").on("click",function(e){
        e.preventDefault()
        $(".btn-close").css("display","");
        $(".btn-submit-admin").css("display","");
        $(".btn-loading").css("display","none");
        $("#AdminModal").modal("show");
    });

    //SUBMIT DATA ADMIN
    $("body").on("submit","#FormAdmin", function(e){
        e.preventDefault()
        $(".btn-close").css("display","none")
        $(".btn-loading").css("display","")
        $(".btn-submit-admin").css("display","none")
        var data = $("#FormAdmin").serialize()

        $.ajax({
            type: "post",
            url: "/admin-panel/admins/add",
            data: data,
            success: function(response){

                if(response.hasOwnProperty('error')){
                    $(".btn-close").css("display","")
                    $(".btn-loading").css("display","none")
                    $(".btn-submit-admin").css("display","")
                    Swal.fire({
                        icon: 'error',
                        title: 'Ooopss...',
                        text: response.error
                    });
                }else{
                    $(".btn-close").css("display","")
                    $(".btn-loading").css("display","none")
                    $(".btn-submit-admin").css("display","")
                    $("#AdminModal").modal("hide")
                    $("#FormAdmin").trigger("reset")
                    LoadAdmin()
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Berhasil Menambahkan Admin',
                        timer: 1200,
                        showConfirmButton: false
                    });
                }

            },
            error: function(err){
                console.log(err)
            }
        })
    })

    //HAPUS ADMIN
    $("body").on("click",".btn-delete-admin",function(e){
        e.preventDefault()
        var id = $(this).attr("data-id")
        var name = $(this).attr("data-name")

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
					url: "/admin-panel/admins/delete/"+id,
					success: function(response) {
						Swal.fire('Deleted!', name + ' telah dihapus.', 'success');
						LoadAdmin();
					},
					error: function(err) {
						console.log(err);
					}
				});
			}
		});
    });

    //DATATABLE OWNER
    LoadOwner();
    function LoadOwner() {
        // AlertCount();
        $('#datatable-owner').load('/admin-panel/owners/load/table-owner', function() {
            $('#table-users').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin-panel/owners/load/data-owner',
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'gender',
                        name: 'gender',
                        className: 'text-center'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'verify_status',
                        name: 'verify_status',
                        className: 'text-center'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
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
    //OPEN MODAL TAMBAH OWNER
    $("#btn-modal-owner").on("click",function(e){
        e.preventDefault()
        $(".btn-close").css("display","");
        $(".btn-submit-owner").css("display","");
        $(".btn-loading").css("display","none");
        $("#OwnerModal").modal("show");
    });

    //SUBMIT DATA OWNER
    $("body").on("submit","#FormOwner", function(e){
        e.preventDefault()
        $(".btn-close").css("display","none")
        $(".btn-loading").css("display","")
        $(".btn-submit-owner").css("display","none")
        var data = $("#FormOwner").serialize()

        $.ajax({
            type: "post",
            url: "/admin-panel/owners/add",
            data: data,
            success: function(response){

                if(response.hasOwnProperty('error')){
                    $(".btn-close").css("display","")
                    $(".btn-loading").css("display","none")
                    $(".btn-submit-owner").css("display","")
                    Swal.fire({
                        icon: 'error',
                        title: 'Ooopss...',
                        text: response.error
                    });
                }else{
                    $(".btn-close").css("display","")
                    $(".btn-loading").css("display","none")
                    $(".btn-submit-owner").css("display","")
                    $("#OwnerModal").modal("hide")
                    $("#FormOwner").trigger("reset")
                    LoadOwner()
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Berhasil Menambahkan Owner',
                        timer: 1200,
                        showConfirmButton: false
                    });
                }

            },
            error: function(err){
                console.log(err)
            }
        })
    })

    //HAPUS OWNER
    $("body").on("click",".btn-delete-owner",function(e){
        e.preventDefault()
        var id = $(this).attr("data-id")
        var name = $(this).attr("data-name")

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
                    url: "/admin-panel/owners/delete/"+id,
                    success: function(response) {
                        Swal.fire('Deleted!', name + ' telah dihapus.', 'success');
                        LoadOwner();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
        });
    });

    //DATATABLE CUSTOMER
    LoadCustomer();
    function LoadCustomer() {
        // AlertCount();
        $('#datatable-customer').load('/admin-panel/customers/load/table-customer', function() {
            $('#table-users').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin-panel/customers/load/data-customer',
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'gender',
                        name: 'gender',
                        className: 'text-center'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'verify_status',
                        name: 'verify_status',
                        className: 'text-center'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
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
    

    //HAPUS CUSTOMER
    $("body").on("click",".btn-delete-customer",function(e){
        e.preventDefault()
        var id = $(this).attr("data-id")
        var name = $(this).attr("data-name")

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
                    url: "/admin-panel/customers/delete/"+id,
                    success: function(response) {
                        Swal.fire('Deleted!', name + ' telah dihapus.', 'success');
                        LoadCustomer();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
        });
    });

});
