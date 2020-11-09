<?php
include("../config.php");
$kode = $_REQUEST['kode'];

$q_check = mysqli_query($con, "SELECT kode_penjualan, status FROM tbl_penjualan_hutang WHERE kode_penjualan = '$kode'");
$row_kode = mysqli_num_rows($q_check);

$data_kode = mysqli_fetch_assoc($q_check);

echo $row_kode." ".$data_kode['status'];
?>