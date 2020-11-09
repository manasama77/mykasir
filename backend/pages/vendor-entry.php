<?php
include("../../config.php");

$nama_perusahaan = $_POST['nama_perusahaan'];
$alamat = $_POST['alamat'];
$id_provinsi = $_POST['id_provinsi'];
$id_kota = $_POST['id_kota'];
$kodepos = $_POST['kodepos'];
$no_telepon = $_POST['no_telepon'];
$no_fax = $_POST['no_fax'];
$email = $_POST['email'];
$pic = $_POST['pic'];
$no_handphone = strip_tags($_POST['no_handphone']);
$no_rekening = $_POST['no_rekening'];
$id_bank = strip_tags($_POST['id_bank']);
$atas_nama = $_POST['atas_nama'];
$catatan = $_POST['catatan'];
$date_create = $_POST['date_create'];
$id_create = $_POST['id_create'];

$q_get_latest_id = mysqli_query($con, "SELECT id_vendor AS lates_id FROM tbl_vendor ORDER BY id_vendor DESC LIMIT 1");
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
	header("location:index.php?page=vendor-add&error=failed_insert_db");
}

$kode_vendor = "V".$running_number;

$q_insert_tbl_vendor = mysqli_query($con, "INSERT INTO tbl_vendor (id_vendor, kode_vendor, nama_perusahaan, alamat, id_provinsi, id_kota, kodepos, no_telepon, no_fax, email, pic, no_handphone, no_rekening, id_bank, atas_nama, catatan, date_create, id_create) VALUES ('', '$kode_vendor', '$nama_perusahaan', '$alamat', '$id_provinsi', '$id_kota', '$kodepos', '$no_telepon', '$no_fax', '$email', '$pic', '$no_handphone', '$no_rekening', '$id_bank', '$atas_nama', '$catatan', '$date_create', '$id_create')");

if($q_insert_tbl_vendor){
	header("location:index.php?page=vendor-list&success=add");
}else{
	//echo"error";
	header("location:index.php?page=vendor-add&error=failed_insert_db");
}
?>