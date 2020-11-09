<?php
include("../../config.php");

$id = $_POST['id'];
$nama = $_POST['nama'];

$kueri = mysqli_query($con, "UPDATE tbl_kategori_produk SET nama = '$nama' WHERE id_kategori_produk = '$id'");

if($kueri){
	header("location:index.php?page=kategori_produk-list");
}else{
	echo "error";
}
?>