<?php
include("../../config.php");
include("check_login.php");

$nama = $_REQUEST['nama'];
$q_nama = mysqli_query($con, "SELECT nama FROM tbl_kategori_produk WHERE nama = '$nama'");
$row_nama = mysqli_num_rows($q_nama);
echo $row_nama;
?>