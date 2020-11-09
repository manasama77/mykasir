<?php
include("../config.php");
$id = $_REQUEST['id'];

$q_hapus = mysqli_query($con, "DELETE FROM tbl_list_penjualan_event WHERE id_list_penjualan_event = '$id'");

if($q_hapus){
	echo "berhasil";
}else{
	echo "gagal";
}
?>