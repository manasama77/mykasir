<?php
include("../../config.php");

$nama = $_POST['nama'];
$id_produk = $_POST['id_produk'];
$tipe = $_POST['tipe'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$current_date = date("Y-m-d");

if($tipe == 1){
	$discount = $_POST['discount'];
	$potongan_harga = $_POST['potongan_harga'];
	$qty_minimal_pembelian = "";
	$id_produk_gratis = "";
	$qty_gratis = "";
	$akumulasi = "";
}elseif($tipe == 2){
	$discount = "";
	$potongan_harga = $_POST['potongan_harga'];
	$qty_minimal_pembelian = "";
	$id_produk_gratis = "";
	$qty_gratis = "";
	$akumulasi = "";
}elseif($tipe == 3){
	$discount = "";
	$potongan_harga = "";
	$qty_minimal_pembelian = $_POST['qty_minimal_pembelian'];
	$id_produk_gratis = $_POST['id_produk_gratis'];
	$qty_gratis = $_POST['qty_gratis'];
	$akumulasi = $_POST['akumulasi'];
}


if($current_date == $start_date){
	$status = "1";
}else{
	$status = "0";
}

$q_insert_tbl_event = mysqli_query($con, "INSERT INTO tbl_event (id_event, nama, id_produk, tipe, start_date, end_date, status, discount, potongan_harga, qty_minimal_pembelian, id_produk_gratis, qty_gratis, akumulasi) VALUES ('', '$nama', '$id_produk', '$tipe', '$start_date', '$end_date', '$status', '$discount', '$potongan_harga', '$qty_minimal_pembelian', '$id_produk_gratis', '$qty_gratis', '$akumulasi')");

if($q_insert_tbl_event){
	header("location:index.php?page=event-list&success=add");
}else{
	echo"Proses tambah event error silahkan hubungi team RimsMedia";
}
?>