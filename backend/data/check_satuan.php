<?php
include("../../config.php");
$id = $_REQUEST['id'];
$q_satuan = mysqli_query($con, "SELECT tbl_satuan_produk.nama AS satuan FROM tbl_satuan_produk LEFT JOIN tbl_produk ON tbl_produk.id_satuan_produk = tbl_satuan_produk.id_satuan_produk WHERE tbl_produk.id_produk = '$id'");
$row = mysqli_num_rows($q_satuan);

if($row > 0){
	$data = mysqli_fetch_assoc($q_satuan);
	$satuan = $data['satuan'];
}else{
	$satuan = "Satuan";
}

echo $satuan;
?>