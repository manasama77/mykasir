<?php
include("../../config.php");

$barcode = $_REQUEST['barcode'];
$qty = $_REQUEST['qty'];
$hpp = $_REQUEST['hpp'];
$hpj = $_REQUEST['hpj'];
$hpg = $_REQUEST['hpg'];
$discount_persen = $_REQUEST['discount_persen'];
$discount = $_REQUEST['discount'];
$harga_beli_nett = $_REQUEST['harga_beli_nett'];
$total_harga_beli = $_REQUEST['total_harga_beli'];
$status = "0";
$id_pembelian = $_REQUEST['id_pembelian'];
$id_create = $_REQUEST['id_create'];
$tanggal_kadarluarsa = $_REQUEST['tanggal_kadarluarsa'];

if($barcode != ''){
	$q_find_id = mysqli_query($con, "SELECT id_produk FROM tbl_produk WHERE barcode = '$barcode'");
	$data_find_id = mysqli_fetch_array($q_find_id);
	$id_produk = $data_find_id['id_produk'];
}else{
	$id_produk = $_REQUEST['nama_produk_search'];
}

$q_insert = mysqli_query($con, "INSERT INTO tbl_list_pembelian (id_list_pembelian, id_produk, qty, hpp, hpj, hpg, discount_persen, discount_rp, harga_beli_nett, total_harga_beli, status, id_pembelian, id_create, tanggal_kadarluarsa) VALUES ('', '$id_produk', '$qty', '$hpp', '$hpj', '$hpg', '$discount_persen', '$discount', '$harga_beli_nett', '$total_harga_beli', '$status', '$id_pembelian', '$id_create', '$tanggal_kadarluarsa')");
if($q_insert){
	echo "Success";
}else{
	echo "Cannot Insert";
}
?>