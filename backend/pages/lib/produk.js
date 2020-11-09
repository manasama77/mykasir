function checkNamaProduk(){
	var nama_produk = $('#nama_produk').val();
	$.post("check_nama_produk.php?nama_produk="+nama_produk, function(data){
		if(data == 1){
			$('#group_nama_produk').addClass("has-error");
			$('#helper_nama_produk').fadeIn("fast");
			$('#simpan').addClass("disabled");
		}else{
			$('#group_nama_produk').removeClass("has-error");
			$('#helper_nama_produk').fadeOut("fast");
			$('#simpan').removeClass("disabled");
		}
	});
}

function checkBarcode(){
	var barcode = $('#barcode').val();
	$.post("check_barcode.php?barcode="+barcode, function(data){
		if(data == 1){
			$('#group_barcode').addClass("has-error");
			$('#helper_barcode').fadeIn("fast");
			$('#simpan').addClass("disabled");
		}else{
			$('#group_barcode').removeClass("has-error");
			$('#helper_barcode').fadeOut("fast");
			$('#simpan').removeClass("disabled");
		}
	});
}