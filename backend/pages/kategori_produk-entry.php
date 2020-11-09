<?php
include("../../config.php");

$nama = $_POST['nama'];

$q_insert_tbl_kategori_produk = mysqli_query($con, "INSERT INTO tbl_kategori_produk (id_kategori_produk, nama) VALUES ('', '$nama')");

if($q_insert_tbl_kategori_produk){
	header("location:index.php?page=kategori_produk-list");
}else{
	echo "error";
}
?>