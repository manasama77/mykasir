<?php
include("../../config.php");

$id_produk = $_POST['id_produk'];
$qty = $_POST['qty'];
$kadarluarsa = $_POST['kadarluarsa'];

$q_insert_tbl_stock = mysqli_query($con, "INSERT INTO tbl_stock (id_stock, id_produk, qty, kadarluarsa) VALUES ('', '$id_produk', '$qty', '$kadarluarsa')");

if($q_insert_tbl_stock){
	$q_sum_stock = mysqli_query($con, "SELECT SUM(tbl_stock.qty) AS sum_qty FROM tbl_stock WHERE id_produk = '$id_produk'");
	$fa_sum_stock = mysqli_fetch_array($q_sum_stock);
	$sum_qty = $fa_sum_stock['sum_qty'];
	
	$q_update_tbl_produk = mysqli_query($con, "UPDATE tbl_produk SET qty = '$sum_qty' WHERE id_produk = '$id_produk'");
	header("location:index.php?page=produk-list");
}else{
	echo"error";
}
?>