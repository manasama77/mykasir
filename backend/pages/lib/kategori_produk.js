function checkNamaKategori(){
	var nama = $('#nama').val();
	$.post("check_nama_kategori.php?nama="+nama, function(data){
		if(data == 1){
			$('#group_nama_kategori').addClass("has-error");
			$('#helper_nama_kategori').fadeIn("fast");
			$('#simpan').addClass("disabled");
		}else{
			$('#group_nama_kategori').removeClass("has-error");
			$('#helper_nama_kategori').fadeOut("fast");
			$('#simpan').removeClass("disabled");
		}
	});
}