<?php
if(isset($_GET['error'])){
	if($_GET['error'] == "failed_insert_db"){
?>
		<div class="col-lg-12">
			<div class="alert alert-danger">Mohon Maaf, Proses Input Data Gagal, Segera Hubungi Team <strong>IT KUMS</strong>. Terima Kasih</div>
		</div>
<?php
	}elseif($_GET['error'] == "failed_delete_db"){
?>
		<div class="col-lg-12">
			<div class="alert alert-danger">Mohon Maaf, Proses Hapus Data Gagal, Segera Hubungi Team <strong>IT KUMS</strong>. Terima Kasih</div>
		</div>
<?php
	}
}


if(isset($_GET['saldo'])){
	if($_GET['saldo'] == "error"){
?>
		<div class="col-lg-12">						
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
		Mohon Maaf, Proses Input Data Gagal Input Akun Debet & Kredit dengan benar, saldo debit lebih besar dari jumlah kredit. Terima Kasih</div>
		</div>
<?php
	}elseif($_GET['saldo'] == "sukses"){
?>
		<div class="col-lg-12">
			<div class="alert alert-success">Saldo akun berhasil di pindahkan. Terima Kasih</div>
		</div>
<?php
	}
}


if(isset($_GET['success'])){
	if($_GET['success'] == "add"){
?>
		<div class="col-lg-12">
			<div class="alert alert-success alert-dismissable">
				 <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
				Proses Tambah Data Berhasil
			</div>
		</div>
<?php
	}elseif($_GET['success'] == "delete"){
?>
		<div class="col-lg-12">
			<div class="alert alert-success alert-dismissable">
				 <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
				Proses Hapus Data Berhasil
			</div>
		</div>
<?php
	}elseif($_GET['success'] == "pembayaran"){
		$kode_pembelian = $_REQUEST['kode_pembelian'];
?>
		<div class="col-lg-12">
			<div class="alert alert-success alert-dismissable">
				 <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
				Proses Pembayaran <?=$kode_pembelian;?> Berhasil
			</div>
		</div>
<?php
	}
}
?>