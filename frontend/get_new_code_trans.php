<?php
session_start();
$id_create = $_SESSION['id_user'];
include("../config.php");

$current_date = date('Y-m-d');
$explode_date = explode('-', $current_date);
$tahun = $explode_date[0];
$bulan = $explode_date[1];
$hari = $explode_date[2];
$separator = "-";

$q_run_num = mysqli_query($con, "SELECT running_number FROM tbl_temp_penjualan WHERE DATE(date_create) = '$current_date' ORDER BY running_number DESC LIMIT 1");
$data_run_num = mysqli_fetch_assoc($q_run_num);
$running_number = $data_run_num['running_number'];

if(in_array($running_number, ['', NULL])){
	$running_number = 1;
}else{
	$running_number = $running_number + 1;
}

$new_kode_penjualan = $tahun.$bulan.$separator.$hari.$running_number;

$q_del_temp = mysqli_query($con, "DELETE FROM tbl_temp_penjualan WHERE id_create = '$id_create'");

$q_temp_penjualan = mysqli_query($con, "INSERT INTO tbl_temp_penjualan (id_temp_penjualan, kode_penjualan, id_create, date_create, running_number) VALUES ('', '$new_kode_penjualan', '$id_create', now(), '$running_number')");
?>
<input type="hidden" id="mask_kode_penjualan" name="mask_kode_penjualan" value="<?=$new_kode_penjualan;?>">
<input type="hidden" id="mask_running_number" name="mask_running_number" value="<?=$running_number;?>">
<input type="hidden" id="mask_running_number" name="mask_running_number" value="<?=$current_date;?>">