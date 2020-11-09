<?php
include("../../config.php");
include("check_login.php");

$barcode = $_REQUEST['barcode'];
$q_barcode = mysqli_query($con, "SELECT barcode FROM tbl_produk WHERE barcode = '$barcode'");
$row_barcode = mysqli_num_rows($q_barcode);
echo $row_barcode;
?>