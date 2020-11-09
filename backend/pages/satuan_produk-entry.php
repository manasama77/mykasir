<?php
include("../../config.php");

$nama = $_POST['nama'];

$q_insert_tbl_satuan_produk = mysqli_query($con, "INSERT INTO tbl_satuan_produk (id_satuan_produk, nama) VALUES ('', '$nama')");

if($q_insert_tbl_satuan_produk){
	header("location:index.php?page=satuan_produk-list");
}else{
	echo "error";
}
?>