<?php
include("../../config.php");

$id_produk = $_REQUEST['id_produk'];
$purpose = $_REQUEST['purpose'];
$qty = $_REQUEST['qty'];
$keterangan = $_REQUEST['keterangan'];
$tanggal_transaksi = $_REQUEST['tanggal_transaksi'];
$id_create = $_REQUEST['id_create'];
$chain_koreksi = $_REQUEST['chain_koreksi'];

$q_insert = mysqli_query($con, "INSERT INTO tbl_list_koreksi(id_list_koreksi, id_produk, qty, keterangan, date_create, id_create, status, chain_koreksi, purpose) VALUES ('', '$id_produk', '$qty', '$keterangan', '$tanggal_transaksi', '$id_create', '0', '$chain_koreksi', '$purpose')");
?>