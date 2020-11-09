// DEFAULT SETTING
$.extend( true, $.fn.dataTable.defaults, {
	"paging":   true,
	"ordering": true,
	"info":     true,
	"order": [[ 1, "asc" ]],
	"dom": '<"top"f>rt<"bottom"tip><"clear">',
	"pagingType": "full_numbers",
	//"scrollX": true,
	"pageLength": 10
});


// Setup - add a text input to each footer cell
$('#memberList tfoot th').each( function () {
	var title = $(this).text();
	if(title != "ID" && title != "Config" ){
		$(this).html( '<input type="text" class="form-control input-sm" placeholder="Cari '+title+'" />' );
	}else{
		$(this).html('');
	}
} );

$('#vendorList tfoot th').each( function () {
	var title = $(this).text();
	if(title != "ID" && title != "Config" ){
		$(this).html( '<input type="text" class="form-control input-sm" placeholder="Cari '+title+'" />' );
	}else{
		$(this).html('');
	}
} );

$('#produkList tfoot th').each( function () {
	var title = $(this).text();
	if(title != "ID" && title != "Config" ){
		$(this).html( '<input type="text" class="form-control input-sm" placeholder="Cari '+title+'" />' );
	}else{
		$(this).html('');
	}
} );

// End Setup

var tableMemberList = $('#memberList').DataTable({
	"columnDefs": [
		{ targets: [0, 6], visible: true, orderable: false, searchable: true},
		{ targets: '_all', visible: true, orderable: true, searchable: true}
	],
	"scrollX": true,
	dom: 'Bfrtip',
	buttons: [
		{
            extend: 'copy',
            text: 'Copy',
			className: 'btn btn-default btn-sm',
            exportOptions: {
                modifier: {
                    //page: 'current'
					selected: true
                }
            }
        },
		{
            extend: 'excel',
            text: 'Excel',
			filename: 'UD Mandiri Cahaya Abadi - List Member',
			extension: '.xlsx',
			title: 'UD Mandiri Cahaya Abadi',
			messageTop: 'List Member',
			sheetName: 'List Member',
			className: 'btn btn-success btn-sm',
            exportOptions: {
                modifier: {
                    //page: 'current'
					selected: true
                }
            }
        },
		{
            extend: 'print',
            text: 'Print',
			className: 'btn btn-info btn-sm',
			title: 'UD Mandiri Cahaya Abadi - List Member',
            exportOptions: {
                modifier: {
                    //page: 'current'
					selected: true
                }
            }
        }
	]
});

var tableVendorList = $('#vendorList').DataTable({
	"scrollX": true,
	dom: 'Bfrtip',
	buttons: [
		{
            extend: 'copy',
            text: 'Copy',
			className: 'btn btn-default btn-sm',
            exportOptions: {
                modifier: {
                    //page: 'current'
					selected: true
                }
            }
        },
		{
            extend: 'excel',
            text: 'Excel',
			filename: 'UD Mandiri Cahaya Abadi - List Supplier',
			extension: '.xlsx',
			title: 'UD Mandiri Cahaya Abadi',
			messageTop: 'List Supplier',
			sheetName: 'List Supplier',
			className: 'btn btn-success btn-sm',
            exportOptions: {
                modifier: {
                    //page: 'current'
					selected: true
                }
            }
        },
		{
            extend: 'print',
            text: 'Print',
			className: 'btn btn-info btn-sm',
			title: 'UD Mandiri Cahaya Abadi - List Supplier',
            exportOptions: {
                modifier: {
                    //page: 'current'
					selected: true
                }
            }
        }
	],
	"columnDefs": [ {
		"searchable": false,
		"orderable": false,
		"targets": [0,7]
	} ]
});

var tableProdukList = $('#produkList').DataTable({
	"scrollX": false,
	dom: 'Bfrtip',
	buttons: [
		{
            extend: 'copy',
            text: 'Copy',
			className: 'btn btn-default btn-sm',
            exportOptions: {
                modifier: {
                    //page: 'current'
					selected: true
                }
            }
        },
		{
            extend: 'excel',
            text: 'Excel',
			filename: 'UD Mandiri Cahaya Abadi - List Produk',
			extension: '.xlsx',
			title: 'UD Mandiri Cahaya Abadi',
			messageTop: 'List Produk',
			sheetName: 'List Produk',
			className: 'btn btn-success btn-sm',
            exportOptions: {
                modifier: {
                    //page: 'current'
					selected: true
                }
            }
        },
		{
            extend: 'print',
            text: 'Print',
			className: 'btn btn-info btn-sm',
			title: 'UD Mandiri Cahaya Abadi - List Produk',
            exportOptions: {
                modifier: {
                    //page: 'current'
					selected: true
                }
            }
        }
	],
	"columnDefs": [ {
		"searchable": false,
		"orderable": false,
		"targets": [0,8]
	} ]
});

var tableSalesmanList = $('#salesmanList').DataTable({
	"columnDefs": [ {
		"searchable": false,
		"orderable": false,
		"targets": [6]
	} ]
});

var tableSatuanList = $('#satuanList').DataTable({
	"columnDefs": [ {
		"searchable": false,
		"orderable": false,
		"targets": [2]
	} ]
});

var tableKategoriList = $('#kategoriList').DataTable({
	"columnDefs": [ {
		"searchable": false,
		"orderable": false,
		"targets": [2]
	} ]
});

// Apply the search
tableMemberList.columns().every( function () {
	var that = this;

	$( 'input', this.footer() ).on( 'keyup change', function () {
		if ( that.search() !== this.value ) {
			that
			.search( this.value )
			.draw();
		}
	} );
} );

tableVendorList.columns().every( function () {
	var that = this;

	$( 'input', this.footer() ).on( 'keyup change', function () {
		if ( that.search() !== this.value ) {
			that
			.search( this.value )
			.draw();
		}
	} );
} );

var tablePembelianList = $('#pembelianList').DataTable({
	"scrollX": true,
	"order": [[0, "desc"]],
	dom: 'Bfrtip',
	buttons: [
		{
            extend: 'copy',
            text: 'Copy',
			className: 'btn btn-default btn-sm',
            exportOptions: {
                modifier: {
                    //page: 'current'
					selected: true
                }
            }
        },
		{
            extend: 'excel',
            text: 'Excel',
			filename: 'UD Mandiri Cahaya Abadi - List Pembelian Produk',
			extension: '.xlsx',
			title: 'UD Mandiri Cahaya Abadi',
			messageTop: 'List Pembelian Produk',
			sheetName: 'List Pembelian Produk',
			className: 'btn btn-success btn-sm',
            exportOptions: {
                modifier: {
                    //page: 'current'
					selected: true
                }
            }
        },
		{
            extend: 'print',
            text: 'Print',
			className: 'btn btn-info btn-sm',
			title: 'UD Mandiri Cahaya Abadi - List Pembelian Produk',
            exportOptions: {
                modifier: {
                    //page: 'current'
					selected: true
                }
            }
        }
	],
	"columnDefs": [
	{
		"searchable": false,
		"orderable": false,
		"targets": [12]
	}
	]
});

var tableHistoryList = $('#historyList').DataTable({
	"scrollX": true,
	dom: 'Bfrtip',
	buttons: [
		{
            extend: 'copy',
            text: 'Copy',
			className: 'btn btn-default btn-sm',
            exportOptions: {
                modifier: {
                    //page: 'current'
					selected: true
                }
            }
        },
		{
            extend: 'excel',
            text: 'Excel',
			filename: 'UD Mandiri Cahaya Abadi - History Pembayaran',
			extension: '.xlsx',
			title: 'UD Mandiri Cahaya Abadi',
			messageTop: 'History Pembayaran',
			sheetName: 'History Pembayaran',
			className: 'btn btn-success btn-sm',
            exportOptions: {
                modifier: {
                    //page: 'current'
					selected: true
                }
            }
        },
		{
            extend: 'print',
            text: 'Print',
			className: 'btn btn-info btn-sm',
			title: 'UD Mandiri Cahaya Abadi - History Pembayaran',
            exportOptions: {
                modifier: {
                    //page: 'current'
					selected: true
                }
            }
        }
	],
	"columnDefs": [
	{
		"searchable": false,
		"orderable": false,
		"targets": [12]
	}
	]
});

var tableEventList = $('#EventList').DataTable({
	"columnDefs": [
	{
		"searchable": false,
		"orderable": false,
		"targets": [0,11]
	}
	]
});

var tableKoreksiList = $('#koreksiList').DataTable({
	"columnDefs": [
	{
		"searchable": false,
		"orderable": false,
		"targets": [3]
	}
	]
});

var tablePenjualanList = $('#penjualanList').DataTable({
	"ajax":{
		"url": 'json/data_penjualan.php',
		"dataSrc": ""
	},
	"columns": [
		{ "data": "kode_penjualan" },
		{ "data": "jenis_pelanggan" },
		{ "data": "create_date" },
		{
			"data": "grand_total",
			"render": $.fn.dataTable.render.number( ',', '.', 2, '' )
		},
		{ "data": "catatan" },
		{ "data": null }
	],
	"columnDefs": [
		{
			"targets": -1,
			"data": null,
			"defaultContent": "<button id=\"listdetail\" class=\"btn btn-info btn-block btn-xs\"><i class=\"fa fa-info\"></i></button>"
		},
		{
			"targets": [3],
			"sClass": "dt-right"
		},
		{
			"targets": [0,1,2,4],
			"sClass": "dt-upper dt-center"
		},
		{
			"searchable": false,
			"orderable": false,
			"targets": [5]
		}
	],
	"deferRender": true,
	"processing": true,
	dom: 'Bfrtip',
	buttons: [
		{
            extend: 'copy',
            text: 'Copy',
			className: 'btn btn-default btn-sm',
            exportOptions: {
                modifier: {
                    //page: 'current'
					selected: true
                }
            }
        },
		{
            extend: 'excel',
            text: 'Excel',
			filename: 'UD Mandiri Cahaya Abadi - List Penjualan',
			extension: '.xlsx',
			title: 'UD Mandiri Cahaya Abadi',
			messageTop: 'List Penjualan',
			sheetName: 'List Penjualan',
			className: 'btn btn-success btn-sm',
            exportOptions: {
                modifier: {
                    //page: 'current'
					selected: true
                }
            }
        },
		{
            extend: 'print',
            text: 'Print',
			className: 'btn btn-info btn-sm',
			title: 'UD Mandiri Cahaya Abadi - List Penjualan',
            exportOptions: {
                modifier: {
                    //page: 'current'
					selected: true
                }
            }
        }
	]
});

$('#penjualanList tbody').on( 'click', '#listdetail', function () {
	var datapenjualan =  tablePenjualanList.row( $(this).parents('tr') ).data();
	var kode_penjualan = datapenjualan['kode_penjualan'];
	$("#penjualanModal").modal('toggle');
	$('#vPenjualan').load('../data/penjualan_detail.php?kode='+kode_penjualan);
} );

function bersihkan(){
	$('#vPenjualan').empty();
}

var tableKadarluarsaList = $('#kadarluarsaList').DataTable({
	"order": [[3, "asc"]],
	"columnDefs": [
	{
		"searchable": false,
		"orderable": false,
		"targets": [4]
	}
	]
});

var tableUserList = $('#userList').DataTable({
	"ajax":{
		"url": 'json/data_user.php',
		"dataSrc": ""
	},
	"columns": [
		{ "data": "id_user" },
		{ "data": "username" },
		{ "data": "nama" },
		{ "data": "role" },
		{ "data": "last_login" },
		{
			"data": null,
			"render": function(data){
				var id_user = data.id_user;
				
				if(id_user != 1){
					return "<button class=\"btn btn-info btn-block btn-xs\" onClick=\"passwordUser("+id_user+")\"><i class=\"fa fa-key\"></i></button><button class=\"btn btn-danger btn-block btn-xs\" onClick=\"hapusUser("+id_user+")\"><i class=\"fa fa-trash\"></i></button>"
				}else{
					return "";
				}
				
			}
		}
	],
	"columnDefs": [
		{
			"searchable": false,
			"orderable": false,
			"targets": [5]
		}
	],
	"deferRender": true,
	"processing": true
});

function hapusUser(id){
	$.ajax({
		type:'POST',
		url:'hapus_user.php?id='+id,
		success:function(status) {
			alert("Hapus Data Berhasil");
			location.reload();
		},
		error: function(status)
		{
			alert("Proses hapus data gagal, silahkan hubungi Rimsmedia");
		}
	});
}

function passwordUser(id){
	$('#userModal').modal('show');
	$('#vUser').load('ganti_password.php?id='+id, function(){
		$('#ubah').click(function(){
			var new_password = $('#new_password').val();
			$.ajax({
				type:'POST',
				data: 'id='+id+'&new_password='+new_password,
				url:'ubah_password.php',
				success:function(status) {
					alert("Ganti Password Berhasil");
					$('#userModal').modal('hide');
				},
				error: function(status)
				{
					alert("Proses update password data gagal, silahkan hubungi Rimsmedia");
				}
			});
		});
	});
}