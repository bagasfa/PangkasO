$(document).ready(function() {

    //DATATABLE HISTORY
	LoadTableHistory();
	function LoadTableHistory() {
        // AlertCount();
		$('#datatable-history').load('/admin-panel/activity-history/load/table-history', function() {
			$('#table-history').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: '/admin-panel/activity-history/load/data-history',
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
						data: 'nama',
						name: 'nama'
					},
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        className: 'text-center'
                    }
				]
			});
		});
    }

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
