function checkNamaKategori(){
	var nama = $('#nama').val();
	$.post("check_nama_satuan.php?nama="+nama, function(data){
		if(data == 1){
			$('#group_nama_satuan').addClass("has-error");
			$('#helper_satuan').fadeIn("fast");
			$('#simpan').addClass("disabled");
		}else{
			$('#group_nama_satuan').removeClass("has-error");
			$('#helper_satuan').fadeOut("fast");
			$('#simpan').removeClass("disabled");
		}
	});
}