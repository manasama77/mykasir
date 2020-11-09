<?php
include("../../config.php");
include("check_login.php");

$nama_produk = $_REQUEST['nama_produk'];
$q_nama_produk = mysqli_query($con, "SELECT nama_produk FROM tbl_produk WHERE nama_produk = '$nama_produk'");
$row_nama_produk = mysqli_num_rows($q_nama_produk);
echo $row_nama_produk;
?>