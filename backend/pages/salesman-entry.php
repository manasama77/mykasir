<?php
include("../../config.php");

$nama_salesman = $_POST['nama_salesman'];
$no_telepon = $_POST['no_telepon'];
$no_handphone = $_POST['no_handphone'];
$alamat = $_POST['alamat'];
$date_create = $_POST['date_create'];
$id_create = $_POST['id_create'];

$q_get_latest_id = mysqli_query($con, "SELECT id_salesman AS lates_id FROM tbl_salesman ORDER BY id_salesman DESC LIMIT 1");
$fa_q_get_latest_id = mysqli_fetch_array($q_get_latest_id);
$lates_id = $fa_q_get_latest_id['lates_id'];
$lates_id = $lates_id + 1;

if($lates_id < 10){
	$running_number = "000".$lates_id;
}elseif($lates_id < 100){
	$running_number = "00".$lates_id;
}elseif($lates_id < 1000){
	$running_number = "0".$lates_id;
}elseif($lates_id < 10000){
	$running_number = $lates_id;
}else{
	header("location:index.php?page=salesman-add&error=failed_insert_db");
}

$kode_salesman = "S".$running_number;

$q_insert_tbl_salesman = mysqli_query($con, "INSERT INTO tbl_salesman (id_salesman, kode_salesman, nama_salesman, no_telepon, no_handphone, alamat, date_create, id_create) VALUES ('', '$kode_salesman', '$nama_salesman', '$no_telepon', '$no_handphone', '$alamat', '$date_create', '$id_create')");

if($q_insert_tbl_salesman){
	header("location:index.php?page=salesman-list&success=add");
}else{
	//echo"error";
	header("location:index.php?page=salesman-add&error=failed_insert_db");
}
?>