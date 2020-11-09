<?php
session_start();
if($_SESSION['username'] == ""){
	header("location:../index.php?error=3");
}else{
	include("../config.php");
	include("../backend/pages/lib/function_base.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Application for UD Mandiri Cahaya Abadi">
	<meta name="author" content="RIMSMEDIA">
    <title>UD Mandiri Cahaya Abadi - Kasir</title>
    <link href="../backend/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../backend/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="../backend/vendor/jqueryui/jquery-ui.min.css" rel="stylesheet" >
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet">
	<link href="assets/css/kasir.css" rel="stylesheet" >
</head>
<body>
	<div id="loading"><img src="assets/images/ajax-loader.gif" id="img-load" /></div>
	<div class="container-fluid">
		<form id="main" class="form-horizontal" autocomplete="off">
			<input type="hidden" id="id_create" name="id_create" value="<?=$_SESSION['id_user'];?>">
			<?php include('nav.php'); ?>
			<?php include('main.php'); ?>
		</form>
	</div>
</body>
</html>

<div id="vbaru"></div>
<div id="vjml_transaksi"></div>
<div id="vmember"></div>
<div id="vsalesman"></div>
<div id="vbarcode"></div>
<div id="vgrand"></div>
<?php
}
?>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">Print Transaksi</h4>
			</div>
			<div class="modal-body">
				<p>Some text in the modal.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- jQuery -->
<script src="../backend/vendor/jquery/jquery.min.js"></script>
<script src="../backend/vendor/jquery/jquery.number.js"></script>
<script src="../backend/vendor/jqueryui/jquery-ui.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../backend/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/config-datepicker.js"></script>
<script src="assets/js/dynamic_clock.js"></script>
<script src="assets/js/config_number.js"></script>
<script src="assets/js/config_audio.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>

<script>
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
	$('.member').addClass('hidden');
	var id_create = $('#id_create').val();
	var kode_penjualan = $('#kode_penjualan').val();
	$('#vlistpenjualan').load('list_penjualan.php?id_create='+id_create+'&kode_penjualan='+kode_penjualan);
	grandTotal();
	
	// End First Run Configuration //
	
	$('#data_baru').click(function() {
		$('#main').trigger("reset");
		$("#nama_produk").val(null).trigger('change');
		$('#cstock').text('');
		grandTotal();
		
		$('#vbaru').load('get_new_code_trans.php', function(){
			var mask_kode_penjualan = $('#mask_kode_penjualan').val();
			var id_create = $('#id_create').val();
			$('#kode_penjualan').val(mask_kode_penjualan);
			
			check_row_list_penjualan(mask_kode_penjualan); // toggle disable / enable button process dan print
			
			$('#tambah').prop('disabled', false);
			$('#clear_form').prop('disabled', false);
			
			$('#vlistpenjualan').load('list_penjualan.php?id_create='+id_create+'&kode_penjualan='+mask_kode_penjualan);
			
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
		$('.member').addClass('hidden');
	}else{
		$('.member').removeClass('hidden');
	}
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
	
	var total = parseInt(qty) * parseFloat(harga_jual);
	$('#total').val(total);
}

function tambahListPenjualan(){
	event.preventDefault();
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
	
	// reset form nama produk //
	$("#nama_produk").select2("val", "");
	
	$.ajax({
		type: "POST",
		url: "tambah_keranjang.php",
		data: {a: a, b: b, c: c, d: d, e: e, f: f, g: g, h: h, i: i, j: j, k: k},
		success: function(xhr) {
			if(xhr == "berhasil"){
				var id_create = $('#id_create').val();
				var kode_penjualan = $('#kode_penjualan').val();
				$('#vlistpenjualan').load('list_penjualan.php?id_create='+id_create+'&kode_penjualan='+kode_penjualan);
				$('#barcode').val('');
				$('#kode_produk').val('');
				$("#nama_produk").val(null).trigger('change');
				$('#satuan').val('');
				$('#qty').val('');
				$('#cstock').text('');
				$('#harga_jual').val('');
				$('#total').val('');
				$('#barcode').focus();
				grandTotal();
			}else{
				alert(xhr);
			}
		}
	});
}

function hapusList(id){
	$.post( "hapus_list.php?id="+id, function(xhr) {
		if(xhr == "berhasil"){
			var id_create = $('#id_create').val();
			var kode_penjualan = $('#kode_penjualan').val();
			$('#vlistpenjualan').load('list_penjualan.php?id_create='+id_create+'&kode_penjualan='+kode_penjualan);
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
			$('#vlistpenjualan').load('list_penjualan.php?id_create='+id_create+'&kode_penjualan='+kode_penjualan);
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
	$('#vgrand').load('check_grand_total.php?disc='+discount_rp_total+'&id='+id_create+'&ppn='+harga_ppn+'&kode_penjualan='+kode_penjualan, function(){
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
		var discount_rp_total = parseFloat(sub_total) * parseInt(discount_persen_total) / 100;
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
	kembalian = parseFloat(grand_total) - parseFloat(pembayaran);
	$('#kembalian').val(kembalian);
	grandTotal();
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
	
	if(ppn == true){
		ppn = 1;
	}else{
		ppn = 0;
	}
	
	if(kembalian < 0 || kembalian == "0"){
		var status = "lunas";
	}else{
		var status = "piutang";
	}
	
	event.preventDefault();
	
	$.ajax({
		type: "POST",
		url: "simpan.php",
		data: {kode_penjualan: kode_penjualan, mask_running_number: mask_running_number, sub_total: sub_total, grand_total: grand_total, discount_persen: discount_persen, discount_rp: discount_rp, ppn: ppn, harga_ppn: harga_ppn, pembayaran: pembayaran, kembalian: kembalian, tanggal_pelunasan: tanggal_pelunasan, tanggal_jatuh_tempo: tanggal_jatuh_tempo, catatan: catatan, id_create: id_create, ppn: ppn, status: status, jenis_pelanggan: jenis_pelanggan, kode_member: kode_member, kode_salesman: kode_salesman},
		success: function(xhr, data) {
			if(xhr == "berhasil"){
				alert("Transaksi berhasil disimpan, Silahkan Print Transaksi");
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
	var id_create = $('#id_create').val();
	var myWindow = window.open("print_penjualan.php?kode_penjualan="+kode_penjualan+"&id_create="+id_create, "", "width=1024px,height=768px");

}
</script>