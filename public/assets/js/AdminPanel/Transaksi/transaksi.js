$(document).ready(function(){

  //DATATABLE TRANSAKSI
  LoadTransaksi();
  function LoadTransaksi() {
      $('#datatable-transaksi').load('/owner-panel/transactions/load/table-transaksi', function() {
          $('#table-transaksi').DataTable({
              processing: true,
              serverSide: true,
              ajax: {
                  url: '/owner-panel/transactions/load/data-transaksi',
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
                  }
              ]
          });
      });
  }

  // Open Cancel Modal
  $('body').on('click', '.btn-cancel-order', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    $('input[name=id]').val(id);
    $('#cancelOrder').modal({ backdrop: 'static', keyboard: false });
    $('#cancelOrder').modal('show');
  });

});