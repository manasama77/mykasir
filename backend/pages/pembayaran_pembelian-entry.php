<?php
include("../../config.php");

$kode_pembelian = $_REQUEST['kode_pembelian'];
$tanggal_pelunasan = $_REQUEST['tanggal_pelunasan'];
$pembayaran = $_REQUEST['pembayaran'];
$pembayaran_decimal = $_REQUEST['pembayaran_decimal'];
$id = $_REQUEST['id'];
$hutang = $_REQUEST['hutang'];
$id_create = $_REQUEST['id_create'];
$grand_total = $_REQUEST['grand_total'];

if($pembayaran_decimal == null){
	$pembayaran_decimal = "00";
}

$pembayarannya = $pembayaran.".".$pembayaran_decimal;

$q_get_latest_id = mysqli_query($con, "SELECT id_pembayaran_pembelian AS lates_id FROM tbl_pembayaran_pembelian ORDER BY id_pembayaran_pembelian DESC LIMIT 1");
$fa_q_get_latest_id = mysqli_fetch_array($q_get_latest_id);
$lates_id = $fa_q_get_latest_id['lates_id'];
$lates_id = $lates_id + 1;

if($lates_id < 10){
	$running_number = "000".$lates_id;
}elseif($lates_id < 100){
	$running_number = "00".$lates_id;
}elseif($lates_id < 1000){
	$running_number = "0".$lates_id;
}elseif($lates_id < 10000){
	$running_number = $lates_id;
}else{
	header("location:index.php?page=pembelian-list&error=failed_insert_db");
}

$kode_pembayaran = "TP".$running_number;

$hutang_terbaru = $hutang - $pembayarannya;

$q_insert = mysqli_query($con, "INSERT INTO tbl_pembayaran_pembelian (id_pembayaran_pembelian, id_pembelian, kode_pembayaran, grand_total, hutang_sebelumnya, pembayaran, hutang_terbaru, tanggal_pelunasan, id_create) VALUES ('', '$id', '$kode_pembayaran', '$grand_total', '$hutang', '$pembayarannya', '$hutang_terbaru', '$tanggal_pelunasan', '$id_create')");

if($q_insert){
	if($hutang_terbaru == 0){
		$status = 1;
	}else{
		$status = 0;
	}
	
	$q_update = mysqli_query($con, "UPDATE tbl_pembelian SET pembayaran = '$pembayaran', hutang = '$hutang_terbaru', status = '$status', tanggal_pelunasan = '$tanggal_pelunasan' WHERE id_pembelian = '$id'");
	
	if($q_update){
		header("location:index.php?page=pembelian-list&success=pembayaran&kode_pembelian=$kode_pembelian");
	}else{
		header("location:index.php?page=pembelian-add&error=failed_insert_db");
	}
}else{
	header("location:index.php?page=pembelian-add&error=failed_insert_db");
}
?>