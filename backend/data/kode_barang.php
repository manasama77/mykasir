<?php
include("../../config.php");

$barcode = $_REQUEST['barcode'];
$q_search_barcode = mysqli_query($con, "SELECT kode_produk FROM tbl_produk WHERE barcode = '$barcode'");
$fa_q_search_barcode = mysqli_fetch_array($q_search_barcode);
$kode_produk = $fa_q_search_barcode['kode_produk'];
?>

<input type="hidden" id="getkode" name="getkode" value="<?=$kode_produk;?>">