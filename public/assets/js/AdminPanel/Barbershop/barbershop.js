$(document).ready(function() {
    //DATATABLE BARBERSHOP
    LoadBarbershop();
    function LoadBarbershop() {
        $('#datatable-barbershop').load('/admin-panel/barbershop/load/table-barbershop', function() {
            $('#table-barbershop').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin-panel/barbershop/load/data-barbershop',
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
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        
                        data: 'service_preferences',
                        render: function (data, type, row) {
                            data = data.replace('COD', 'Cash On Delivery');
                            data = data.replace('AO', 'Antrian Online');
                            data = data.replace('COA', 'COD & Antrian Online');
                            return data;
                        },
                        className: 'text-center'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number',
                        className: 'text-center'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'latitude',
                        render: function(data, type, row, meta){
                            if(type === 'display'){
                                data = '<a href="https://www.google.com/maps/?q='+row.latitude+','+row.longitude+'" target="_blank" class="badge badge-primary nounderline"><i class="fas fa-map-marked-alt"></i> Lihat</a>';
                            }

                            return data;
                        },
                        sortable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    }
                ]
            });
        });
    }

});