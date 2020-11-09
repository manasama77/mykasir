<?php
include("../../config.php");

$ppn = $_REQUEST['ppn'];
$harga_ppn = $_REQUEST['harga_ppn'];
$id_create = $_REQUEST['id_create'];

$q_check = mysqli_query($con, "SELECT id_user FROM tbl_temp_pembelian WHERE id_user = '$id_create'");
$nm_q_check = mysqli_num_rows($q_check);

if($nm_q_check == 0){
	$q_insert = mysqli_query($con, "INSERT INTO tbl_temp_pembelian (id_temp_pembelian, id_user, ppn, harga_ppn) VALUES ('', '$id_create', '$ppn', '$harga_ppn')");
}else{
	$q_update = mysqli_query($con, "UPDATE tbl_temp_pembelian SET ppn = '$ppn', harga_ppn = '$harga_ppn' WHERE id_user = '$id_create'");
}
?>