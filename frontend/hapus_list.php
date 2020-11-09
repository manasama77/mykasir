<?php
include("../config.php");
$id = $_REQUEST['id'];

$q_event = mysqli_query($con, "SELECT id_event FROM tbl_list_penjualan WHERE id_list_penjualan = '$id'");
$data = mysqli_fetch_assoc($q_event);
$id_event = $data['id_event'];

if($id_event != null){
	$q_hapus_event = mysqli_query($con, "DELETE FROM tbl_list_penjualan_event WHERE id_list_penjualan = '$id'");
}

$q_hapus = mysqli_query($con, "DELETE FROM tbl_list_penjualan WHERE id_list_penjualan = '$id'");

if($q_hapus){
	echo "berhasil";
}else{
	echo "gagal";
}
?>