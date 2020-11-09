<?php
include("../../config.php");

$id = $_POST['id'];
$nama = $_POST['nama'];

$kueri = mysqli_query($con, "UPDATE tbl_satuan_produk SET nama = '$nama' WHERE id_satuan_produk = '$id'");

if($kueri){
	header("location:index.php?page=satuan_produk-list");
}else{
	echo "error";
}
?>