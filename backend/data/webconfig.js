function resultMargin(){
	var namaproduk = $( "#nama_produk" ).val();
	if(namaproduk.length > 0){
		$( "#simpan" ).prop("disabled", false);
	}else{
		$( "#simpan" ).prop("disabled", true);
	}
	
	var hpp = $( "#hpp" ).val();
	var decimal_hpp = $( "#decimal_hpp" ).val();
	var hpj = $( "#hpj" ).val();
	var decimal_hpj = $( "#decimal_hpj" ).val();
	var hpg = $( "#hpg" ).val();
	var decimal_hpg = $( "#decimal_hpg" ).val();
	
	if(decimal_hpp !== ""){
		var hpp = hpp+"."+decimal_hpp;
	}else{
		var hpp = hpp+".00";
	}
	
	if(decimal_hpj !== ""){
		var hpj = hpj+"."+decimal_hpj;
	}else{
		var hpj = hpj+".00";
	}
	
	if(decimal_hpg !== ""){
		var hpg = hpg+"."+decimal_hpg;
	}else{
		var hpg = hpg+".00";
	}
	
	var untungHPJ = hpj - hpp;
	var untungHPG = hpg - hpp;
	 
	var margin = (untungHPJ / hpp) * 100;
	var margin2 = (untungHPG / hpp) * 100;
	margin = (margin).toFixed(2);
	margin2 = (margin2).toFixed(2);
	
	$( "#margin_show" ).html(margin+" %");
	$( "#margin2_show" ).html(margin2+" %");
	$( "#margin" ).val(margin);
	$( "#margin2" ).val(margin2);
}

function resultSatuan(){
	var id_produk = $("#id_produk").val();
	$("#satuan_produk").load("../data/satuan_produk.php?id_produk="+id_produk);
}

function resultTipe(){
	var tipe = $("#tipe").val();
	
	if(tipe == 1){
		$( "#qtyd" ).removeClass("hide");
		$( "#qtyp" ).addClass("hide");
		$( ".freeproduct" ).addClass("hide");
		$( ".specialp" ).addClass("hide");
	}else if(tipe == 2){
		$( "#qtyd" ).addClass("hide");
		$( "#qtyp" ).removeClass("hide");
		$( ".freeproduct" ).addClass("hide");
		$( ".specialp" ).addClass("hide");
	}else if(tipe == 3){
		$( "#qtyd" ).addClass("hide");
		$( "#qtyp" ).addClass("hide");
		$( ".freeproduct" ).removeClass("hide");
		var id = $("#id_produk").val();
		satuanMinimal(id);
		$( ".specialp" ).addClass("hide");
	}else if(tipe == 4){
		$( "#qtyd" ).addClass("hide");
		$( "#qtyp" ).addClass("hide");
		$( ".freeproduct" ).addClass("hide");
		$( ".specialp" ).removeClass("hide");
	}
}

function satuanMinimal(id){
	$.post("../data/check_satuan.php?id="+id, function(data){
		var id = $("#satuan_minimal").text(data);
	})
}

function satuanGratis(){
	var id2 = $("#id_produk_gratis").val();
	$.post("../data/check_satuan.php?id="+id2, function(data){
		var id = $("#satuan_gratis").text(data);
	})
}

$.datepicker.setDefaults({
		dateFormat: 'yy-mm-dd',
		autoSize: true,
		changeMonth: true,
		changeYear: true,
		duration: "medium",
		showAnim: "drop"
	});

$(function() {
	$( "#date" ).datepicker().val();
});

$(function() {
	$( "#tanggal_awal" ).datepicker().val();
	$( "#tanggal_akhir" ).datepicker().val();
	$( "#tanggal_harian" ).datepicker().val();
});

$(function() {
	$( "#tanggal_lahir" ).datepicker({ dateFormat: 'yy-mm-dd', maxDate: '0', yearRange: '-100:+0' }).val();
});

$(function() {
	$( "#tanggal_order" ).datepicker({ dateFormat: 'yy-mm-dd', yearRange: '-5:+5' }).val();
});

$(function() {
	$( "#date_expired" ).datepicker({ dateFormat: 'yy-mm-dd', yearRange: '+0:+5', minDate: '0' }).val();
});

$(function() {
	$( "#tanggal_pelunasan" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
});

$(function() {
	$( "#tanggal_jatuh_tempo" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
});

$(function() {
	$( "#kadarluarsa" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
});

$(function() {
	$( "#start_date" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
});

$(function() {
	$( "#end_date" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
});

function openModalMember(id){
	$('#memberModal').modal();
	$("#vMember").load("../data/member_detail.php?id="+id);
}

function openModalPembelian(id){
	$('#pembelianModal').modal();
	$("#vPembelian").load("../data/pembelian_detail.php?id="+id);
}

function openModalPembayaran(id){
	$('#pembelianModal').modal();
	$("#vPembelian").load("../data/pembayaran_pembelian.php?id="+id);
}

function openModalVendor(id){
	$('#vendorModal').modal();
	$("#vVendor").load("../data/vendor_detail.php?id="+id);
}

function openModalTambahProduk(){
	$("#vTambahProduk").load("../data/tambah_produk.php");
	$('#tambahProdukModal').modal();
}

function openModalProduk(id){
	$('#produkModal').modal();
	$("#vProduk").load("../data/produk_detail.php?id="+id);
}

function openModalKoreksi(chain, kode_transaksi, tanggal_transaksi){
	$('#koreksiModal').modal();
	$("#vKoreksi").load("../data/koreksi_detail.php?chain="+chain+"&kode_transaksi="+kode_transaksi+"&tanggal_transaksi="+tanggal_transaksi);
}

function loadKota(id_kota2){
	var id_provinsi = $("#id_provinsi").val();
	
	if(id_provinsi != null){
		$( "#id_kota" ).prop("disabled", false);
		$("#id_kota").load("../data/list_kota.php?id_provinsi="+id_provinsi+"&id_kota2="+id_kota2);
	}else{
		$( "#id_kota" ).prop("disabled", true);
	}
}

$('#id_provinsi').select2();

/*$('#id_provinsi').select2({
	placeholder: "Pilih Provinsi",
	allowClear: true
}).val("").trigger("change");*/

$('#id_kota').select2({
	placeholder: "Pilih Kota",
	allowClear: true
}).val("").trigger("change");

$('#id_vendor').select2({
	placeholder: "Pilih Supplier",
	allowClear: true
}).val("").trigger("change");

//$('#id_produk').select2();


$('#id_produk').select2({
	placeholder: "Pilih Produk",
	allowClear: true
}).val("").trigger("change");

$('#id_produk_gratis').select2({
	placeholder: "Pilih Produk Gratis",
	allowClear: true
}).val("").trigger("change");

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#thumbnail').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#foto").change(function(){
    readURL(this);
});

function loadListPembelian(){
	$('#listPembelian').load('list_pembelian.php');
}

function loadListKoreksi(){
	$('#listKoreksi').load('list_koreksi.php');
}

var url = $(location).attr('search');
if(url == '?page=pembelian-add' || url == '?page=pembelian-add&error=failed_insert_db'){
	loadListPembelian();
	setInterval(function(){
		loadListPembelian()
	},1000);
	
	setInterval(function(){
		count_list()
	},5000);
}else if(url == '?page=koreksi-add' || url == '?page=koreksi-add&error=failed_insert_db'){
	loadListKoreksi();
	setInterval(function(){
		loadListKoreksi()
	},1000);
}

function count_list(){
	var count_pembelian = $("#count_pembelian").val();
	
	if(count_pembelian > 0){
		$("#simpan_pembelian").prop('disabled', false);
	}else{
		$("#simpan_pembelian").prop('disabled', true);
	}
}

function checkPPN(){
	var id_create = $("#id_create").val();
	var ppn = $("#ppn").val();
	var sub_total = $("#sub_total").text();
	sub_total = sub_total.replace(/,/g , "");
	var harga_ppn = (parseFloat(sub_total) * 10) / 100;
	$.ajax({
		type:'POST',
		url:'ppn_produk_entry.php?ppn='+ppn+'&harga_ppn='+harga_ppn+'&id_create='+id_create,
		success:function(data) {
		},
		error: function(data)
		{
			alert("Proses ppn data gagal, silahkan hubungi Rimsmedia");
		}
	});
}

function simpan_list_koreksi(){
	var tanggal_transaksi = $("#tanggal_transaksi").val();
	var id_produk = $("#id_produk").val();
	var purpose = $("#purpose").val();
	var qty = $("#qty").val();
	var keterangan = $("#keterangan").val();
	var id_create = $("#id_create").val();
	var chain_koreksi = $("#chain_koreksi").val();
	var dataString = 'tanggal_transaksi='+tanggal_transaksi+'&id_produk='+id_produk+'&purpose='+purpose+'&qty='+qty+'&keterangan='+keterangan+'&id_create='+id_create+'&chain_koreksi='+chain_koreksi;
	$.ajax({
		type:'POST',
		data:dataString,
		url:'tambah_produk_koreksi_entry.php',
		success:function(status) {
			var id_produk = $("#id_produk").val("").trigger('change');
			var purpose = $("#purpose").val("");
			var qty = $("#qty").val("");
			var keterangan = $("#keterangan").val("");
		},
		error: function(status)
		{
			alert("Proses tambah data gagal, silahkan hubungi Rimsmedia");
		}
	});
}

function hapus_koreksi_list(id){
	$.ajax({
		type:'POST',
		url:'hapus_produk_koreksi_entry.php?id='+id,
		success:function(status) {
		},
		error: function(status)
		{
			alert("Proses tambah data gagal, silahkan hubungi Rimsmedia");
		}
	});
}

function simpan_koreksi(){
	var tanggal_transaksi = $("#tanggal_transaksi").val();
	var id_create = $("#id_create").val();
	var chain_koreksi = $("#chain_koreksi").val();
	var dataString = 'tanggal_transaksi='+tanggal_transaksi+'&id_create='+id_create+'&chain_koreksi='+chain_koreksi;
	$.ajax({
		type:'POST',
		data:dataString,
		url:'koreksi-entry.php',
		success:function(status) {
			window.location.href = "index.php?page=koreksi-list&&success=add";
		},
		error: function(status)
		{
			alert("Proses tambah data gagal, silahkan hubungi Rimsmedia");
		}
	});
}

var d = new Date(),
    n = d.getMonth(),
    y = d.getFullYear();
$('#bulan option:eq('+n+')').prop('selected', true);

function ubahPassword(id){
	$('#profileModal').modal("show", function(){
		$("#password_lama").focus();
		$('#update_password').prop("disabled", true);
	});
}

function checkPasswordLama(){
	var password_lama = $("#password_lama").val();
	$.post('check_password_lama.php?password='+password_lama, function(data){
		if(data == "beda"){
			$('#pass_lama').addClass("has-error");
			$('#pass_help').removeClass("hide");
			$('#update_password').prop("disabled", true);
		}else{
			$('#pass_lama').removeClass("has-error");
			$('#pass_help').addClass("hide");
			$('#update_password').prop("disabled", true);
		}
	});
}

function checkPasswordBaru(){
	var password_baru = $("#password_baru").val();
	var password_konfirmasi = $("#password_konfirmasi").val();
	
	if(password_baru == null || password_baru == ""){
		$('#update_password').prop("disabled", true);
	}else{
		if(password_baru != password_konfirmasi){
			$('#pass_kon').addClass("has-error");
			$('#pass_ver').removeClass("hide");
		}else{
			$('#pass_kon').removeClass("has-error");
			$('#pass_ver').addClass("hide");
			$('#update_password').prop("disabled", false);
		}
	}
}

function gantiPassword(id){
	var password_baru = $("#password_baru").val();
	$.ajax({
		type:'POST',
		url:'password_update.php?id='+id+'&password_baru='+password_baru,
		success:function(response) {
			$('#passok').removeClass('hide');
			setTimeout(function(){
				$('#profileModal').modal('hide');
				$('#passok').addClass('hide');
				$( '#updatepass' ).each(function(){
					this.reset();
				});
			}, 1000);
		},
		error: function(response)
		{
			alert("Proses Update data gagal, silahkan hubungi Rimsmedia");
		}
	});
}

function ubahProfile(id){
	var nama = $("#nama").val();
	
	$.ajax({
		type:'POST',
		url:'profile_update.php?',
		data: 'id='+id+'&nama='+nama,
		success:function(response) {
			$("#profileok").removeClass("hide");
			$("#profileok").fadeTo(2000, 500).slideUp(500, function(){
				$("#profileok").slideUp(500);
			});
		},
		error: function(response)
		{
			alert("Proses Update data gagal, silahkan hubungi Rimsmedia");
		}
	});
}

function vProduk(){
	var id = $( "#id_produk" ).val();
	$.get("../data/nama_produk.php?id="+id+"", function(data, status){
		var namaProduk = $( data ).filter( '#getnamaproduk' ).val();
		var namaSatuan = $( data ).filter( '#getnamasatuan' ).val();
		
		$( "#nama_produk" ).val(namaProduk);
		
		if(namaSatuan == ''){
			$( "#nama_satuan" ).text("Satuan");
		}else{
			$( "#nama_satuan" ).text(namaSatuan);
		}
	});
}