<?php
// grand total - harga ppn - discount
include("../config.php");
include("kumpulan_function.php");
$disc = $_REQUEST['disc']; // harga_discount_total
$id = $_REQUEST['id'];
$kode_penjualan = $_REQUEST['kode_penjualan'];
$ppn = $_REQUEST['ppn']; // harga_ppn
$status = $_REQUEST['status']; // harga_ppn

if($disc == ""){
	$disc = 0;
}

if($ppn == ""){
	$ppn = 0;
}

$q_sub_total_penjualan = mysqli_query($con, "SELECT SUM(lp.total_harga) AS sub_total FROM tbl_list_penjualan AS lp WHERE lp.status = '$status' AND lp.id_create = '$id' AND lp.kode_penjualan = '$kode_penjualan'");
$data_sub_total_penjualan = mysqli_fetch_assoc($q_sub_total_penjualan);
$sub_total_penjualan = $data_sub_total_penjualan['sub_total'];

$q_sub_total_penjualan_event = mysqli_query($con, "SELECT SUM(lpe.total_harga) AS sub_total_event FROM tbl_list_penjualan_event AS lpe WHERE lpe.status = '$status' AND lpe.id_create = '$id' AND lpe.kode_penjualan = '$kode_penjualan' AND lpe.tipe = '4'");
$data_sub_total_penjualan_event = mysqli_fetch_assoc($q_sub_total_penjualan_event);
$sub_total_event = $data_sub_total_penjualan_event['sub_total_event'];

$q_sub_total_penjualan_hutang = mysqli_query($con, "SELECT SUM(lph.total_harga) AS sub_total_hutang FROM tbl_list_penjualan_hutang AS lph WHERE lph.status = '$status' AND lph.id_create = '$id' AND lph.kode_penjualan = '$kode_penjualan'");
$data_sub_total_penjualan_hutang = mysqli_fetch_assoc($q_sub_total_penjualan_hutang);
$sub_total_penjualan_hutang = $data_sub_total_penjualan_hutang['sub_total_hutang'];

$sub_total = $sub_total_penjualan + $sub_total_event + $sub_total_penjualan_hutang;

$grand_total = ($sub_total - $disc) + $ppn;
?>
<input type="hidden" id="mask_sub_total" name="mask_sub_total" value="<?=$sub_total;?>">
<input type="hidden" id="mask_grand_total" name="mask_grand_total" value="<?=$grand_total;?>">
<input type="hidden" id="mask_terbilang" name="mask_terbilang" value="<?=terbilang($grand_total);?>">