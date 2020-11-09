<?php
session_start();
include("../../config.php");
$q_kode = mysqli_query($con, "SELECT id_produk, kode_produk, nama_produk FROM tbl_produk");
?>
<style>
#ui-datepicker-div{
	z-index:3000 !important;
}

.ui-datepicker select.ui-datepicker-month{ z-index: 3003 !important;}
.ui-datepicker select.ui-datepicker-year{ z-index: 3003 !important;}
option{ z-index: 3003 !important }

</style>
<form id="add_barang" class="form-horizontal" autocomplete="off">
	<div class="col-lg-12">
		<div class="form-group">
			<div class="col-lg-2">
				<label class="control-label"><i class="fa fa-barcode fa-fw"></i> Barcode</label>
			</div>
			<div id="blockbarcode" class="col-lg-10">
				<input type="text" class="form-control input-sm" id="barcode" name="barcode" placeholder="Barcode Produk" maxlength="13" onKeyUp="CheckBarcode();" onChange="CheckBarcode();">
				<div id="barcodeerror" class="help-block">Barcode Produk Tidak Ditemukan</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg-2">
				<label class="control-label"><i class="fa fa-cubes fa-fw"></i> Nama Produk</label>
			</div>
			<div class="col-lg-10">
				<select class="form-control input-sm" style="width:100%;" id="nama_produk_search" name="nama_produk_search" onKeyUp="CheckBarcode();" onChange="CheckBarcode();">
					<option value="">-</option>
				<?php
				while($data_kode = mysqli_fetch_assoc($q_kode)){
				?>
					<option value="<?=$data_kode['id_produk'];?>"><?=$data_kode['nama_produk'];?></option>
				<?php
				}
				?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<hr>
		</div>
	</div>
	<div id="vInfoProduk"></div>
	<div class="col-lg-12">
		<div class="form-group">
			<div class="col-lg-2">
				<label class="control-label">Kode</label>
			</div>
			<div class="col-lg-10">
				<input type="text" class="form-control input-sm" id="kode_produk" name="kode_produk" placeholder="Kode Produk" readonly>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="form-group">
			<div class="col-lg-2">
				<label class="control-label">Nama Produk</label>
			</div>
			<div class="col-lg-10">
				<input type="text" class="form-control input-sm" id="nama_produk" name="nama_produk" placeholder="Nama Produk" readonly>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="form-group">
			<div class="col-lg-2">
				<label class="control-label">Qty</label>
			</div>
			<div class="col-lg-10">
				<div class="input-group">
					<input type="number" class="form-control input-sm" id="qty" name="qty" placeholder="Qty" min="1" max="99999" onKeyUp="checkTotal();" onChange="checkTotal();" required>
					<div id="satuan" class="input-group-addon">Satuan</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="form-group">
			<div class="col-lg-2">
				<label class="control-label">Tgl Kadarluarsa</label>
			</div>
			<div class="col-lg-10">
				<input type="text" class="form-control input-sm" id="tanggal_kadarluarsa" name="tanggal_kadarluarsa" placeholder="Tanggal Kadarluarsa">
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="form-group">
			<div class="col-lg-2">
				<label class="control-label">Harga Beli</label>
			</div>
			<div class="col-lg-10">
				<div class="input-group">
					<span class="input-group-addon">Rp.</span>
					<input type="number" min="0" max="999999999" class="form-control input-sm" id="hpp" name="hpp" placeholder="Harga Beli" onChange="checkHargaBeliNett();" onKeyUp="checkHargaBeliNett();" required>
					<span class="input-group-addon">.</span>
					<input type="number" min="0" max="99" class="form-control input-sm" id="hpp_decimal" name="hpp_decimal" placeholder="Decimal" onChange="checkHargaBeliNett();" onKeyUp="checkHargaBeliNett();">
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="form-group">
			<div class="col-lg-2">
				<label class="control-label">Harga Jual</label>
			</div>
			<div class="col-lg-10">
				<div class="input-group">
					<span class="input-group-addon">Rp.</span>
					<input type="number" class="form-control input-sm" id="hpj" name="hpj" placeholder="Harga Jual" required>
					<span class="input-group-addon">.</span>
					<input type="number" class="form-control input-sm" id="hpj_decimal" name="hpj_decimal" placeholder="Decimal">
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="form-group">
			<div class="col-lg-2">
				<label class="control-label">Harga Grosir</label>
			</div>
			<div class="col-lg-10">
				<div class="input-group">
					<span class="input-group-addon">Rp.</span>
					<input type="number" class="form-control input-sm" id="hpg" name="hpg" placeholder="Harga Grosir" required>
					<span class="input-group-addon">.</span>
					<input type="number" class="form-control input-sm" id="hpg_decimal" name="hpg_decimal" placeholder="Decimal">
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="form-group">
			<div class="col-lg-2">
				<label class="control-label">Discount</label>
			</div>
			<div class="col-lg-10">
				<div class="input-group">
					<input type="number" min="0" max="99" class="form-control input-sm" id="discount_persen" name="discount_persen" placeholder="Persentase Discount" onKeyUp="discountPersen();" onChange="discountPersen();">
					<div class="input-group-addon">%</div>
				</div>
			</div>
			<div class="col-lg-offset-2 col-lg-10">
				<div class="input-group">
					<span class="input-group-addon">Rp.</span>
					<input type="number" min="0" max="999999999" class="form-control input-sm" id="discount_rp" name="discount_rp" placeholder="Nominal Rupiah Discount" onKeyUp="discountRp();" onChange="discountRp();">
					<span class="input-group-addon">.</span>
					<input type="number" min="0" max="99" class="form-control input-sm" id="discount_rp_decimal" name="discount_rp_decimal" placeholder="Decimal" onKeyUp="discountRp();" onChange="discountRp();">
				</div>
			</div>
		</div>
		<div class="form-group">
			<hr>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="form-group">
			<div class="col-lg-2">
				<label class="control-label">Harga Beli Nett</label>
			</div>
			<div class="col-lg-10">
				<input type="text" class="form-control input-sm" id="harga_beli_nett" name="harga_beli_nett" placeholder="Harga Beli Nett" readonly>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="form-group">
			<div class="col-lg-2">
				<label class="control-label">Total Harga Beli</label>
			</div>
			<div class="col-lg-10">
				<input type="text" class="form-control input-sm" id="total_harga_beli" name="total_harga_beli" placeholder="Total Harga Beli" readonly>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-10">
			<input type="hidden" id="id_create" name="id_create" value="<?=$_SESSION['id_user'];?>">
			<button id="simpan" disabled type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Daftar Barang</button>
		</div>
	</div>
</form>

<div id="cariNamaProduk"></div>
<script>
$( "#barcodeerror" ).fadeOut(0);
$( "#qty" ).prop("disabled", true);
$( "#hpp" ).prop("disabled", true);
$( "#hpp_decimal" ).prop("disabled", true);
$( "#hpj" ).prop("disabled", true);
$( "#hpj_decimal" ).prop("disabled", true);
$( "#hpg" ).prop("disabled", true);
$( "#hpg_decimal" ).prop("disabled", true);
$( "#discount_persen" ).prop("disabled", true);
$( "#discount_rp" ).prop("disabled", true);
$( "#discount_rp_decimal" ).prop("disabled", true);
$( "#tanggal_kadarluarsa" ).prop("disabled", true);
/*$( "#tanggal_kadarluarsa" ).datepicker({ dateFormat: 'yy-mm-dd' }).val().on('click', function(ev){
	$('.datepicker').css("z-index", "999999999");
});*/

function vProduk(){
	var kode = $( "#kode_produk" ).val();
	$.get("../data/nama_produk.php?kode="+kode+"", function(data, status){
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

function CheckBarcode(){
	var barcode = $( "#barcode" ).val();
	var nama_produk_search = $( "#nama_produk_search" ).val();
	$.get("../data/info_produk.php?barcode="+barcode+"&nama_produk_search="+nama_produk_search+"", function(data, status){
		
		var id_produk = $( data ).filter( '#getid' ).val();
		var kodeProduk = $( data ).filter( '#getkode' ).val();
		var namaProduk = $( data ).filter( '#getnama' ).val();
		var namaSatuan = $( data ).filter( '#getsatuan' ).val();
		var hpp = $( data ).filter( '#gethpp' ).val();
		var hpj = $( data ).filter( '#gethpj' ).val();
		var hpg = $( data ).filter( '#gethpg' ).val();
		
		if(hpp == ''){
			hpp = '0';
		}
		
		if(hpj == ''){
			hpj = '0';
		}
		
		if(hpg == ''){
			hpg = '0';
		}
		
		var arrayhpp = hpp.split('.');
		var arrayhpj = hpj.split('.');
		var arrayhpg = hpg.split('.');
		
		if(id_produk != ''){
			$( "#blockbarcode" ).removeClass('has-error');
			$( "#barcodeerror" ).fadeOut(500);
			$( "#qty" ).prop("disabled", false);
			$( "#hpp" ).prop("disabled", false);
			$( "#hpp_decimal" ).prop("disabled", false);
			$( "#hpj" ).prop("disabled", false);
			$( "#hpj_decimal" ).prop("disabled", false);
			$( "#hpg" ).prop("disabled", false);
			$( "#hpg_decimal" ).prop("disabled", false);
			$( "#discount_persen" ).prop("disabled", false);
			$( "#discount_rp" ).prop("disabled", false);
			$( "#discount_rp_decimal" ).prop("disabled", false);
			$( "#tanggal_kadarluarsa" ).prop("disabled", false);
			
			$( "#kode_produk" ).val(kodeProduk);
			$( "#nama_produk" ).val(namaProduk);
			$( "#satuan" ).text(namaSatuan);
			$( "#hpp" ).val(arrayhpp[0]);
			$( "#hpp_decimal" ).val(arrayhpp[1]);
			$( "#hpj" ).val(arrayhpj[0]);
			$( "#hpj_decimal" ).val(arrayhpj[1]);
			$( "#hpg" ).val(arrayhpg[0]);
			$( "#hpg_decimal" ).val(arrayhpg[1]);
			
			$( "#harga_beli_nett" ).val(hpp);
		}else{
			$( "#blockbarcode" ).addClass('has-error');
			$( "#barcodeerror" ).fadeIn(500);
			
			$( "#kode_produk" ).val('');
			$( "#nama_produk" ).val('');
			$( "#qty" ).val('');
			$( "#satuan" ).text('Satuan');
			$( "#hpp" ).val('');
			$( "#hpp_decimal" ).val('');
			$( "#hpj" ).val('');
			$( "#hpj_decimal" ).val('');
			$( "#hpg" ).val('');
			$( "#hpg_decimal" ).val('');
			$( "#discount_persen" ).val('');
			$( "#discount_rp" ).val('');
			$( "#discount_rp_decimal" ).val('');
			$( "#harga_beli_nett" ).val('');
			$( "#total_harga_beli" ).val('');
			
			$( "#qty" ).prop("disabled", true);
			$( "#hpp" ).prop("disabled", true);
			$( "#hpp_decimal" ).prop("disabled", true);
			$( "#hpj" ).prop("disabled", true);
			$( "#hpj_decimal" ).prop("disabled", true);
			$( "#hpg" ).prop("disabled", true);
			$( "#hpg_decimal" ).prop("disabled", true);
			$( "#discount_persen" ).prop("disabled", true);
			$( "#discount_rp" ).prop("disabled", true);
			$( "#discount_rp_decimal" ).prop("disabled", true);
		}
	});
}

function checkHargaBeliNett(){
	var discountp = $( "#discount_persen" ).val();
	var discountrp =$( "#discount_rp" ).val();
	var hpp1 = $( "#hpp" ).val();
	var hpp2 = $( "#hpp_decimal" ).val();
	var qty = $( "#qty" ).val();
	
	if(hpp1 == ''){
		hpp1 = '0';
	}
	
	if(hpp2 == ''){
		hpp2 = '0';
	}else if(hpp2 == '0'){
		hpp2 = '0';
	}
	
	var hpp = hpp1+'.'+hpp2;
	
	if(discountp != ''){
		var hargadiscountrp = (hpp * discountp / 100);
		var hargaBeliNett = (hpp - hargadiscountrp);
		$( "#harga_beli_nett" ).val(hargaBeliNett);
		var hargadiscountrp2 = String(hpp * discountp / 100);
		var arrayrp = hargadiscountrp2.split(".");
		$( "#discount_rp" ).val(arrayrp[0]);
		$( "#discount_rp_decimal" ).val(arrayrp[1]);
	}else{
		$( "#harga_beli_nett" ).val(hpp);
	}
	
	if(qty != ''){
		var a = $( "#harga_beli_nett" ).val();
		var b = qty;
		var total = parseFloat(a) * parseInt(b);
		$( "#total_harga_beli" ).val(total);
	}else{
		$( "#total_harga_beli" ).val('0');
	}
}

function discountPersen(){
	var discountp = $( "#discount_persen" ).val();
	var hpp1 = $( "#hpp" ).val();
	var hpp2 = $( "#hpp_decimal" ).val();
	var qty = $( "#qty" ).val();
	
	if(hpp1 == ''){
		hpp1 = '0';
	}
	
	if(hpp2 == ''){
		hpp2 = '0';
	}else if(hpp2 == '0'){
		hpp2 = '0';
	}
	
	var hpp = hpp1+'.'+hpp2;
	
	if(hpp == "0.0"){
		$( "#harga_beli_nett" ).val("0.0");
		$( "#total_harga_beli" ).val("0.0");
	}else{
		if(discountp != ''){
			var discountrp = String(hpp * discountp / 100);
			var arrayrp = discountrp.split(".");
			$( "#discount_rp" ).val(arrayrp[0]);
			$( "#discount_rp_decimal" ).val(arrayrp[1]);
			var hargaBeliNett = (hpp - discountrp);
			$( "#harga_beli_nett" ).val(hargaBeliNett);
			total = (hargaBeliNett * qty);
			$( "#total_harga_beli" ).val(total);
		}else{
			$( "#harga_beli_nett" ).val(hpp);
		}
	}
}

function discountRp(){
	var discountrp = $( "#discount_rp" ).val();
	var discountrpdecimal = $( "#discount_rp_decimal" ).val();
	var hpp1 = $( "#hpp" ).val();
	var hpp2 = $( "#hpp_decimal" ).val();
	var qty = $( "#qty" ).val();
	
	if(discountrp == ''){
		discountrp = '0';
	}
	
	if(discountrpdecimal == ''){
		discountrpdecimal = '0';
	}
	
	if(hpp1 == ''){
		hpp1 = '0';
	}
	
	if(hpp2 == ''){
		hpp2 = '0';
	}
	
	var hpp = hpp1+'.'+hpp2;
	var discountinrp = discountrp+'.'+discountrpdecimal;
	
	if(hpp == "0.0"){
		$( "#harga_beli_nett" ).val("0.0");
		$( "#total_harga_beli" ).val("0.0");
	}else{
		if(discountinrp != ''){
			var discountPersen = Number(discountinrp / hpp * 100);e
			$( "#discount_persen" ).val(discountPersen);
			var hargaBeliNett = (hpp - discountinrp);
			$( "#harga_beli_nett" ).val(hargaBeliNett);
			total = (hargaBeliNett * qty);
			$( "#total_harga_beli" ).val(total);
		}else{
			$( "#harga_beli_nett" ).val(hpp);
		}		
	}
}

function checkTotal(){
	var qty = $( "#qty" ).val();
	var hargaBeliNett = $( "#harga_beli_nett" ).val();
	var total = parseFloat(hargaBeliNett) * parseFloat(qty);
	$( "#total_harga_beli" ).val(total);
	
	if(qty == '0'){
		$( "#simpan" ).prop("disabled", true);
	}else{
		$( "#simpan" ).prop("disabled", false);
	}
}

$("#simpan").click(function(e) {
	e.preventDefault();
	var barcode = $("#barcode").val();
	var nama_produk_search = $("#nama_produk_search").val();
	var qty = $("#qty").val();
	console.log(qty);
	var hpp1 = $("#hpp").val();
	var hpp2 = $("#hpp_decimal").val();
	var hpp = hpp1+'.'+hpp2;
	var hpj1 = $("#hpj").val();
	var hpj2 = $("#hpj_decimal").val();
	var hpj = hpj1+'.'+hpj2;
	var hpg1 = $("#hpg").val();
	var hpg2 = $("#hpg_decimal").val();
	var hpg = hpg1+'.'+hpg2;
	var discount_persen = $("#discount_persen").val();
	var discount_rp = $("#discount_rp").val();
	var discount_rp_decimal = $("#discount_rp_decimal").val();
	var discount = discount_rp+'.'+discount_rp_decimal;
	var harga_beli_nett = $("#harga_beli_nett").val();
	var total_harga_beli = $("#total_harga_beli").val();
	var id_create = $("#id_create").val();
	var tanggal_kadarluarsa = $("#tanggal_kadarluarsa").val();
	var dataString = 'barcode='+barcode+'&qty='+qty+'&hpp='+hpp+'&hpj='+hpj+'&hpg='+hpg+'&discount_persen='+discount_persen+'&discount='+discount+'&harga_beli_nett='+harga_beli_nett+'&total_harga_beli='+total_harga_beli+'&id_create='+id_create+'&tanggal_kadarluarsa='+tanggal_kadarluarsa+'&nama_produk_search='+nama_produk_search;
	$.ajax({
		type:'POST',
		data:dataString,
		url:'tambah_produk_entry.php',
		success:function(status) {
			$('#tambahProdukModal').modal('hide');
		},
		error: function(status)
		{
			alert("Proses tambah data gagal, silahkan hubungi Rimsmedia");
		}
	});
});

$( "#tanggal_kadarluarsa" ).datepicker({ dateFormat: 'yy-mm-dd' });
$('#nama_produk_search').select2({
	placeholder: "Pilih Produk",
	allowClear: true
}).val("").trigger("change");
</script>