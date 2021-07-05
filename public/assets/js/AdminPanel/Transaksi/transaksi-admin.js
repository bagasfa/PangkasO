$(document).ready(function() {

    //DATATABLE TRANSAKSI
    LoadTransaksi();
    function LoadTransaksi() {
        $('#datatable-transaksi').load('/admin-panel/transactions/load/table-transaksi', function() {
            $('#table-transaksi').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin-panel/transactions/load/data-transaksi',
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
                        data: 'jenis_layanan',
                        render: function (data, type, row) {
                            data = data.replace('COD', 'Cash On Delivery');
                            data = data.replace('AO', 'Antrian Online');
                            return data;
                        },
                        className: 'text-center'
                    },
                    {
                        data: 'no_antri',
                        name: 'no_antri',
                        className: 'text-center'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'barbername',
                        name: 'barbername'
                    },
                    {
                        data: 'hairname',
                        name: 'hairname'
                    },
                    {
                        data: 'harga',
                        name: 'harga',
                        className: 'text-center'
                    },
                    {
                        data: 'jam_booking',
                        name: 'jam_booking',
                        className: 'text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
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
    
    //HAPUS TRANSAKSI
    $("body").on("click",".btn-delete-transaksi",function(e){
        e.preventDefault()
        var id = $(this).attr("data-id")
        var antri = $(this).attr("data-antri")

        Swal.fire({
            title: 'Hapus Transaksi : ' + antri + '?',
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
                    url: "/admin-panel/transactions/delete/"+id,
                    success: function(response) {
                        Swal.fire('Deleted!', antri + ' telah dihapus.', 'success');
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
