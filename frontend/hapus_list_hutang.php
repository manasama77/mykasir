<?php
include("../config.php");
$id = $_REQUEST['id'];

$q_hapus = mysqli_query($con, "DELETE FROM tbl_list_penjualan_hutang WHERE id_list_penjualan_hutang = '$id'");

if($q_hapus){
	echo "berhasil";
}else{
	echo "gagal";
}
?>