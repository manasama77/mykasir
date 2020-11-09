	function myFunction() {
  confirm("Saya sudah Cek Jumlah Posting!");
}

$(document).ready(function() {	
	$(document).ajaxStart(function(){
		$('#loading').removeClass("hide");
	});
	$(document).ajaxComplete(function(){
		$('#loading').addClass("hide");
	});
	
	$('#nama_produk').select2({
		placeholder: "Pilih Produk"
	});
	$('#pembayaran').number(true, 2);
	$('#harga_jual').number(true, 2);
	$('#discount_rp').number(true, 2);
	$('#discount_persen').number(true, 2);
	$('#harga_jual_nett').number(true, 2);
	$('#total').number(true, 2);
	$('#sub_total').number(true, 2);
	$('#grand_total').number(true, 2);
	$('#discount_persen_total').number(true, 2);
	$('#discount_rp_total').number(true, 2);
	$('#harga_ppn').number(true, 2);
	$('#kembalian').number(true, 2);
	$('[data-toggle="tooltip"]').tooltip(); // Bootstrap Tooltip Enable

	// On Click tombol process => Run Event
	$('#process').click(function() {
		audioElement.play();
	});
	// End On Click tombol process
	
	// First Run Configuration //
	$('#loading').addClass("hide");
	$('#main').trigger("reset");
	$('#clear_form').prop('disabled', true);
	$('#process').prop('disabled', true);
	$('#print').prop('disabled', true);
	$('#tambah').prop('disabled', true);
	$('.member').addClass('fade');
	$('#nama_member').addClass('hide');
	var id_create = $('#id_create').val();
	var kode_penjualan = $('#kode_penjualan').val();
	$('#vlistpenjualan').load('list_penjualan.php?id_create='+id_create+'&kode_penjualan='+kode_penjualan+'&status=0');
	grandTotal();
	
	// End First Run Configuration //
	
	$('#data_baru').click(function() {
		$('#main').trigger("reset");
		jenispelanggan();
		$("#nama_produk").val(null).trigger('change');
		$('#cstock').text('');
		$('#status').val('0');
		$("#barcode").focus();
		grandTotal();
		
		$('#vbaru').load('get_new_code_trans.php', function(){
			var mask_kode_penjualan = $('#mask_kode_penjualan').val();
			var id_create = $('#id_create').val();
			$('#kode_penjualan').val(mask_kode_penjualan);
			
			//check_row_list_penjualan(mask_kode_penjualan); // toggle disable / enable button process dan print
			
			$('#tambah').prop('disabled', false);
			$('#clear_form').prop('disabled', false);
			
			$('#vlistpenjualan').load('list_penjualan.php?id_create='+id_create+'&kode_penjualan='+mask_kode_penjualan+'&status=0');
			
		});
	});
});

function check_row_list_penjualan(kode){
	$('#vjml_transaksi').load('check_list_penjualan.php?kode='+kode, function(){
		var mask_row_list_penjualan = $('#mask_row_list_penjualan').val();
		
		if(mask_row_list_penjualan > 0){
			$('#process').prop('disabled', false);
			$('#print').prop('disabled', false);
			grandTotal();
		}else{
			$('#process').prop('disabled', true);
			$('#print').prop('disabled', true);
		}
	});
}

function jenispelanggan(){
	var jenis_pelanggan = $('#jenis_pelanggan').val();
	
	if(jenis_pelanggan == "umum"){
		$('.member').addClass('fade');
		$('#nama_member').addClass('hide');
	}else if(jenis_pelanggan == "member"){
		$('.member').removeClass('fade');
		$('#nama_member').removeClass('hide');
	}
	
	tipePembayaran();
}

function checkMember(){
	var kode_member = $('#kode_member').val();
	$('#vmember').load('check_member.php?kode_member='+kode_member, function(){
		var mask_row_member = $('#mask_row_member').val();
		var mask_nama_member = $('#mask_nama_member').val();
		
		if(mask_row_member == 0){
			$('#vnamamember').addClass('has-error');
			$('#vhelpnamamember').removeClass('hidden');
			$('#nama_member').val('');
		}else{
			$('#vnamamember').removeClass('has-error');
			$('#vhelpnamamember').addClass('hidden');
			$('#nama_member').val(mask_nama_member);
		}
	});
}

function checkMember(){
	var kode_member = $('#kode_member').val();
	$('#vmember').load('check_member.php?kode_member='+kode_member, function(){
		var mask_row_member = $('#mask_row_member').val();
		var mask_nama_member = $('#mask_nama_member').val();
		
		if(mask_row_member == 0){
			$('#vnamamember').addClass('has-error');
			$('#vhelpnamamember').removeClass('hidden');
			$('#nama_member').val('');
		}else{
			$('#vnamamember').removeClass('has-error');
			$('#vhelpnamamember').addClass('hidden');
			$('#nama_member').val(mask_nama_member);
		}
	});
}

function checkSalesmanbykode(){
	var kode_salesman = $('#kode_salesman').val();
	$('#vsalesman').load('check_salesman.php?kode_salesman='+kode_salesman+'&by=kode', function(){
		var mask_row_salesman = $('#mask_row_salesman').val();
		var mask_kode_salesman = $('#mask_kode_salesman').val();
		var mask_nama_salesman = $('#mask_nama_salesman').val();
		
		if(mask_row_salesman == 0){
			$('#nama_salesman').val('');
		}else{
			$('#nama_salesman').val(mask_nama_salesman);
		}
	});
}

function checkSalesmanbynama(){
	var nama_salesman = $('#nama_salesman').val();
	$('#vsalesman').load('check_salesman.php?nama_salesman='+nama_salesman+'&by=nama', function(){
		var mask_row_salesman = $('#mask_row_salesman').val();
		var mask_kode_salesman = $('#mask_kode_salesman').val();
		var mask_nama_salesman = $('#mask_nama_salesman').val();
		
		if(mask_row_salesman == 0){
			$('#kode_salesman').val('');
		}else{
			$('#kode_salesman').val(mask_kode_salesman);
		}
	});
}

function checkBarcode(tipe){
	if(tipe == "bar"){	
		var barcode = $('#barcode').val();
		$('#vbarcode').load('check_barcode.php?barcode='+barcode, function(response){
			var mask_row_barcode = $('#mask_row_barcode').val();
			var mask_id_produk = $('#mask_id_produk').val();
			var mask_kode_produk = $('#mask_kode_produk').val();
			var mask_nama_produk = $('#mask_nama_produk').val();
			var mask_satuan = $('#mask_satuan').val();
			var mask_stock = $('#mask_stock').val();
			var mask_hpj = $('#mask_hpj').val();
			var mask_hpg = $('#mask_hpg').val();
			
			var jenis_pelanggan = $('#jenis_pelanggan').val();
			
			if(mask_row_barcode == 0){
				$('#cbarcode').addClass("has-error");
				$('#cbarcodehelp').removeClass("hidden");
				$('#kode_produk').val('');
				$('#nama_produk').val('');
				$('#satuan').val('');
				$('#qty').val('');
				$('#cstock').text('');
				$('#harga_jual').val('');
				$('#total').val('');
			}else{
				$('#cbarcode').removeClass("has-error");
				$('#cbarcodehelp').addClass("hidden");
				$('#kode_produk').val(mask_kode_produk);
				$('#nama_produk').val(mask_id_produk).trigger('change');
				$('#satuan').val(mask_satuan);
				$('#cstock').text('/ '+mask_stock+mask_satuan);
				$('#qty').val('');
				$('#total').val('');
				$('#qty').focus();
				
				if(jenis_pelanggan == "umum"){
					$('#harga_jual').val(mask_hpj);
				}else{
					$('#harga_jual').val(mask_hpg);
				}
			}
		});
		
	}else{
		var nama_produk = $('#nama_produk').val();
		$('#vbarcode').load('check_nama_produk.php?nama_produk='+nama_produk, function(response){
			var mask_row_barcode = $('#mask_row_barcode').val();
			var mask_id_produk = $('#mask_id_produk').val();
			var mask_kode_produk = $('#mask_kode_produk').val();
			var mask_barcode = $('#mask_barcode').val();
			var mask_nama_produk = $('#mask_nama_produk').val();
			var mask_satuan = $('#mask_satuan').val();
			var mask_stock = $('#mask_stock').val();
			var mask_hpj = $('#mask_hpj').val();
			var mask_hpg = $('#mask_hpg').val();
			
			var jenis_pelanggan = $('#jenis_pelanggan').val();
			
			if(mask_row_barcode == 0){
				$('#kode_produk').val('');
				$('#barcode').val('');
				$('#satuan').val('');
				$('#qty').val('');
				$('#cstock').text('');
				$('#harga_jual').val('');
				$('#total').val('');
			}else{
				$('#kode_produk').val(mask_kode_produk);
				$('#barcode').val(mask_barcode);
				$('#satuan').val(mask_satuan);
				$('#cstock').text('/ '+mask_stock+mask_satuan);
				$('#qty').val('');
				$('#total').val('');
				
				if(jenis_pelanggan == "umum"){
					$('#harga_jual').val(mask_hpj);
				}else{
					$('#harga_jual').val(mask_hpg);
				}
			}
		});
	}
}

function checkTotal(){
	var qty = $('#qty').val();
	var harga_jual = $('#harga_jual').val();
	harga_jual = harga_jual.replace(/,/g , '');
	
	if(harga_jual == ""){
		harga_jual = 0;
	}
	
	var total = parseFloat(qty) * parseFloat(harga_jual);
	$('#total').val(total);
	
	var keycode = event.keyCode || event.which;
    if(keycode == '13') {
		if(qty == ""){
			alert("QTY Tidak Boleh kosong");
		}else{
			tambahListPenjualan();
		}
    }
}

function tambahListPenjualan(){
	var a = $('#kode_penjualan').val();
	var b = $('#nama_produk').val();
	var c = $('#mask_nama_produk').val();
	var d = $('#satuan').val();
	var e = $('#qty').val();
	var f = $('#harga_jual').val();
	var g = $('#total').val();
	var h = $('#id_create').val();
	var i = $('#jenis_pelanggan').val();
	var j = $('#kode_member').val();
	var k = $('#nama_member').val();
	var l = $('#special_event').is(':checked');
	var m = $('#tipe_pembayaran').val();
	
	// reset form nama produk //
	$("#nama_produk").select2("val", "");
	
	$.ajax({
		type: "POST",
		url: "tambah_keranjang.php",
		data: {a: a, b: b, c: c, d: d, e: e, f: f, g: g, h: h, i: i, j: j, k: k, k: k, l: l, m: m},
		success: function(xhr) {
			if(xhr == "berhasil"){
				var id_create = $('#id_create').val();
				var kode_penjualan = $('#kode_penjualan').val();
				$('#vlistpenjualan').load('list_penjualan.php?id_create='+id_create+'&kode_penjualan='+kode_penjualan+'&status=0');
				$('#barcode').val('');
				$('#kode_produk').val('');
				$("#nama_produk").val(null).trigger('change');
				$('#satuan').val('');
				$('#qty').val('');
				$('#cstock').text('');
				$('#harga_jual').val('');
				$('#total').val('');
				$('#barcode').focus();
				$('#special_event').prop('checked', false);
				$('#special_event').prop('checked', false);
				grandTotal();
			}else{
				alert(xhr);
				console.log(xhr);
			}
		}
	});
}

function hapusList(id){
	$.post( "hapus_list.php?id="+id, function(xhr) {
		if(xhr == "berhasil"){
			var id_create = $('#id_create').val();
			var kode_penjualan = $('#kode_penjualan').val();
			$('#vlistpenjualan').load('list_penjualan.php?id_create='+id_create+'&kode_penjualan='+kode_penjualan+'&status=0');
			$("#nama_produk").val(null).trigger('change');
			grandTotal();
		}else{
			alert(xhr);
		}
	});
}

function hapusListEvent(id){
	$.post( "hapus_list_event.php?id="+id, function(xhr) {
		if(xhr == "berhasil"){
			var id_create = $('#id_create').val();
			var kode_penjualan = $('#kode_penjualan').val();
			$('#vlistpenjualan').load('list_penjualan.php?id_create='+id_create+'&kode_penjualan='+kode_penjualan+'&status=0');
			$("#nama_produk").val(null).trigger('change');
			grandTotal();
		}else{
			alert(xhr);
		}
	});
}

function hapusListHutang(id){
	$.post( "hapus_list_hutang.php?id="+id, function(xhr) {
		if(xhr == "berhasil"){
			var id_create = $('#id_create').val();
			var kode_penjualan = $('#kode_penjualan').val();
			$('#vlistpenjualan').load('list_penjualan.php?id_create='+id_create+'&kode_penjualan='+kode_penjualan+'status=0');
			$("#nama_produk").val(null).trigger('change');
			grandTotal();
		}else{
			alert(xhr);
		}
	});
}

function grandTotal(){
	discount_rp_total = $('#discount_rp_total').val();
	harga_ppn = $('#harga_ppn').val();
	id_create = $('#id_create').val();
	kode_penjualan = $('#kode_penjualan').val();
	pembayaran = $('#pembayaran').val();
	status = $('#status').val();
	$('#vgrand').load('check_grand_total.php?disc='+discount_rp_total+'&id='+id_create+'&ppn='+harga_ppn+'&kode_penjualan='+kode_penjualan+'&status='+status, function(){
		mask_sub_total = $('#mask_sub_total').val();
		mask_grand_total = $('#mask_grand_total').val();
		mask_terbilang = $('#mask_terbilang').val();
		
		$('#sub_total').val(mask_sub_total);
		$('#grand_total').val(mask_grand_total);
		$('#terbilang').text(mask_terbilang.toUpperCase());
		
		if(mask_grand_total != "" && kode_penjualan != "" && pembayaran != ""){
			$('#process').prop("disabled", false);
			$('#print').prop("disabled", false);
		}else{
			$('#process').prop("disabled", true);
			$('#print').prop("disabled", true);
		}
		
	});
}

function checkDiscountTotal(tipe){
	sub_total = $('#sub_total').val();
	if(tipe == "persen"){
		discount_persen_total = $('#discount_persen_total').val();
		var discount_rp_total = parseFloat(sub_total) * parseFloat(discount_persen_total) / 100;
		$('#discount_rp_total').val(discount_rp_total);
		checkPPN();
		grandTotal();
	}else{
		discount_rp_total = $('#discount_rp_total').val();
		var discount_persen_total = (parseFloat(discount_rp_total) / parseFloat(sub_total) * 100);
		$('#discount_persen_total').val(discount_persen_total);
		checkPPN();
		grandTotal();
	}
	
}

function checkPPN(){
	var ppn = $('#ppn').is(':checked');
	var sub_total = $('#sub_total').val();
	var discount_rp_total = $('#discount_rp_total').val();
	if(discount_rp_total == ""){
		discount_rp_total = 0;
	}
	
	if(ppn == true){
		var new_sub_total = parseFloat(sub_total) - parseFloat(discount_rp_total);
		harga_ppn  = (parseFloat(new_sub_total) * 10 / 100);
		$('#harga_ppn').val(harga_ppn);
	}else{
		$('#harga_ppn').val('');
	}
	
	grandTotal();
}

function bayar(){
	var pembayaran = $('#pembayaran').val();
	var grand_total = $('#grand_total').val();
	kembalian = parseFloat(pembayaran) - parseFloat(grand_total);
	$('#kembalian').val(kembalian);
	grandTotal();
	
	var keycode = event.keyCode || event.which;
    if(keycode == '13') {
        prosessimpan();
    }
}

function prosessimpan(){
	$('#kembalianModal').modal('show');
	simpan();
	printstruk();
}

function buatbaru(){
	$('#kembalianModal').modal('hide');
	$('#main').trigger("reset");
		jenispelanggan();
		$("#nama_produk").val(null).trigger('change');
		$('#cstock').text('');
		$('#status').val('0');
		grandTotal();
		
		$('#vbaru').load('get_new_code_trans.php', function(){
			var mask_kode_penjualan = $('#mask_kode_penjualan').val();
			var id_create = $('#id_create').val();
			$('#kode_penjualan').val(mask_kode_penjualan);
			
			check_row_list_penjualan(mask_kode_penjualan); // toggle disable / enable button process dan print
			
			$('#tambah').prop('disabled', false);
			$('#clear_form').prop('disabled', false);
			
			$('#vlistpenjualan').load('list_penjualan.php?id_create='+id_create+'&kode_penjualan='+mask_kode_penjualan+'&status=0');
			
		});
	
}

function simpan(){
	var kode_penjualan = $('#kode_penjualan').val();
	var mask_running_number = $('#mask_running_number').val();
	var sub_total = $('#sub_total').val();
	var grand_total = $('#grand_total').val();
	var discount_persen = $('#discount_persen_total').val();
	var discount_rp = $('#discount_rp_total').val();
	var ppn = $('#ppn').is(':checked');
	var harga_ppn = $('#harga_ppn').val();
	var pembayaran = $('#pembayaran').val();
	var kembalian = $('#kembalian').val();
	var tanggal_pelunasan = $('#tanggal_pelunasan').val();
	var tanggal_jatuh_tempo = $('#tanggal_jatuh_tempo').val();
	var catatan = $('#catatan').val();
	var id_create = $('#id_create').val();
	var jenis_pelanggan = $('#jenis_pelanggan').val();
	var kode_member = $('#kode_member').val();
	var kode_salesman = $('#kode_salesman').val();
	var tipe_pembayaran = $('#tipe_pembayaran').val();
	var status2 = $('#status').val();
	
	if(ppn == true){
		ppn = 1;
	}else{
		ppn = 0;
	}
	
	if(kembalian > 0 || kembalian == "0"){
		var status = "lunas";
	}else{
		var status = "hutang";
	}
	
	$.ajax({
		type: "POST",
		url: "simpan.php",
		data: {kode_penjualan: kode_penjualan, mask_running_number: mask_running_number, sub_total: sub_total, grand_total: grand_total, discount_persen: discount_persen, discount_rp: discount_rp, ppn: ppn, harga_ppn: harga_ppn, pembayaran: pembayaran, kembalian: kembalian, tanggal_pelunasan: tanggal_pelunasan, tanggal_jatuh_tempo: tanggal_jatuh_tempo, catatan: catatan, id_create: id_create, ppn: ppn, status: status, jenis_pelanggan: jenis_pelanggan, kode_member: kode_member, kode_salesman: kode_salesman, tipe_pembayaran: tipe_pembayaran, status2: status2},
		success: function(xhr, data) {
			if(xhr == "berhasil"){
				//alert("Transaksi berhasil disimpan, Silahkan Print Transaksi");
				$('#process').prop('disabled', true);
				$('#tambah').prop('disabled', true);
			}else{
				alert(xhr);
			}
		}
	});
	
}

function printstruk(){
	var kode_penjualan = $('#kode_penjualan').val();
	var status = $('#status').val();
	var jenis_pelanggan = $('#jenis_pelanggan').val();
	var tipe_pembayaran = $('#tipe_pembayaran').val();
	
	//alert(status);
	
	if(status == 1){
		var myWindow = window.open("print_penjualan_hutang.php?kode_penjualan="+kode_penjualan+"&status="+status, "", "width=1024px,height=768px");
	}else{
		if(jenis_pelanggan == "member" && tipe_pembayaran == "hutang"){
			var myWindow = window.open("print_penjualan_hutang.php?kode_penjualan="+kode_penjualan+"&status="+status, "", "width=1024px,height=768px");
		}else{
			var myWindow = window.open("print_penjualan.php?kode_penjualan="+kode_penjualan+"&status="+status, "", "width=1024px,height=768px");
		}
	}
	

}

function tipePembayaran(){
	var tipe_penjualan = $('#tipe_pembayaran').val();
	
	if(tipe_penjualan == "hutang"){
		$('#harga_jual').prop('readonly', false);
		$('#special_event').prop('disabled', false);
	}else{
		$('#harga_jual').prop('readonly', false);
		$('#special_event').prop('disabled', false);
	}
}

function passwordModal(){
	var id = $('#id_create').val();
	$('#passwordModal').modal('show');
}

function checkPasswordLama(){
	var password_lama = $("#password_lama").val();
	var id_create = $("#id_create").val();
	$.post('check_password_lama.php?password_lama='+password_lama+'&id_create='+id_create, function(data){
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
				$('#passwordModal').modal('hide');
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

function searchKode(){
	var kode = $('#kode').val('');
	$('#kodeModal').modal('show');
}

function checkKode(){
	var kode = $('#kode').val();
	$.post('check_kode.php?kode='+kode, function(xhr){
		if(xhr == 0){
			$('#searchkode').addClass('has-error');
			$('#kode_help').removeClass('hide');
		}else{
			if(xhr == "1 lunas"){
				alert("Transaksi Sudah Lunas");
			}else{
				$('#kodeModal').modal('hide');
				$('#kode_penjualan').val(kode);
				$('#status').val('1');
				$('#vhutang').load('hutang_info.php?kode='+kode, function(data){
					var mask_hutang_jenis_pelanggan = $('#mask_hutang_jenis_pelanggan').val();
					var mask_hutang_kode_member = $('#mask_hutang_kode_member').val();
					var mask_hutang_catatan = $('#mask_hutang_catatan').val();
					var mask_hutang_kembalian = $('#mask_hutang_kembalian').val();
					var mask_hutang_discount_persen = $('#mask_hutang_discount_persen').val();
					var mask_hutang_discount_rp = $('#mask_hutang_discount_rp').val();
					var mask_hutang_ppn = $('#mask_hutang_ppn').val();
					var mask_hutang_harga_ppn = $('#mask_hutang_harga_ppn').val();
					var mask_hutang_tanggal_pelunasan = $('#mask_hutang_tanggal_pelunasan').val();
					var mask_hutang_tanggal_jatuh_tempo = $('#mask_hutang_tanggal_jatuh_tempo').val();
					//var mask_hutang_pembayaran = $('#mask_hutang_pembayaran').val();
					
					$('#jenis_pelanggan').val(mask_hutang_jenis_pelanggan);
					jenispelanggan();
					$('#kode_member').val(mask_hutang_kode_member);
					checkMember();
					//$('#pembayaran').val(mask_hutang_pembayaran);
					$('#catatan').val(mask_hutang_catatan);
					$('#kembalian').val(mask_hutang_kembalian);
					$('#discount_persen_total').val(mask_hutang_discount_persen);
					$('#discount_rp_total').val(mask_hutang_discount_rp);
					
					if(mask_hutang_ppn == 0){
						$('#ppn').prop('checked', false);
					}else{
						$('#ppn').prop('checked', true);
					}
					
					$('#harga_ppn').val(mask_hutang_harga_ppn);
					$('#tanggal_pelunasan').val(mask_hutang_tanggal_pelunasan);
					$('#tanggal_jatuh_tempo').val(mask_hutang_tanggal_jatuh_tempo);
					$('#tipe_pembayaran').val('kontan');
					
				});
				
				var id_create = $('#id_create').val();
				$('#vlistpenjualan').load('list_penjualan.php?id_create='+id_create+'&kode_penjualan='+kode+'&status=1');
				grandTotal();
				$('#pembayaran').focus();
			}
		}
	});
}

$('#searchkode').on('keypress', function(e) {
    return e.which !== 13;
});
