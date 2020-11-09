<?php
include("../../config.php");

$tanggal_transaksi = $_REQUEST['tanggal_transaksi'];
$id_create = $_REQUEST['id_create'];
$chain_koreksi = $_REQUEST['chain_koreksi'];

$q_get_latest_id = mysqli_query($con, "SELECT id_koreksi AS lates_id FROM tbl_koreksi ORDER BY id_koreksi DESC LIMIT 1");
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
	header("location:index.php?page=koreksi-add&error=failed_insert_db");
}

$kode_transaksi = "TK".$running_number;

$q_insert = mysqli_query($con, "INSERT INTO tbl_koreksi(id_koreksi, kode_transaksi, tanggal_transaksi, id_create, chain_koreksi) VALUES ('', '$kode_transaksi', '$tanggal_transaksi', '$id_create', '$chain_koreksi')");

$q_update = mysqli_query($con, "UPDATE tbl_list_koreksi SET status = '1' WHERE chain_koreksi = '$chain_koreksi'");

$q_check = mysqli_query($con, "SELECT * FROM tbl_list_koreksi WHERE status = '1' AND chain_koreksi = '$chain_koreksi'");
while($data_check = mysqli_fetch_assoc($q_check)){
	$id_produk = $data_check['id_produk'];
	$qty = $data_check['qty'];
	$purpose = $data_check['purpose'];
	
	$q_latest_qty = mysqli_query($con, "SELECT qty FROM tbl_produk WHERE id_produk = '$id_produk'");
	$data_latest_qty = mysqli_fetch_assoc($q_latest_qty);
	$latest_qty = $data_latest_qty['qty'];
	
	if($purpose == "hilang" || $purpose == "expired" || $purpose == "retur" || $purpose == "koreksimin"){
		$new_qty = $latest_qty - $qty;
	}elseif($purpose == "koreksiplus"){
		$new_qty = $latest_qty + $qty;
	}
	
	$q_update_produk = mysqli_query($con, "UPDATE tbl_produk SET qty = '$new_qty' WHERE id_produk = '$id_produk'");
		
}
?>