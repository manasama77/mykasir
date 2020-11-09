<?php
include("../../config.php");

$nama_member = $_POST['nama_member'];
$alamat = $_POST['alamat'];
$kodepos = $_POST['kodepos'];
$no_telepon = $_POST['no_telepon'];
$no_handphone = $_POST['no_handphone'];
$email = $_POST['email'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$nama_usaha = $_POST['nama_usaha'];
$jenis_usaha = $_POST['jenis_usaha'];
$alamat_usaha = $_POST['alamat_usaha'];
$no_telepon_usaha = $_POST['no_telepon_usaha'];
$catatan = $_POST['catatan'];
$npwp = $_POST['npwp'];
$date_expired = $_POST['date_expired'];
$date_create = $_POST['date_create'];
$id_create = $_POST['id_create'];

$q_get_latest_id = mysqli_query($con, "SELECT id_member AS lates_id FROM tbl_member ORDER BY id_member DESC LIMIT 1");
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
	header("location:index.php?page=member-add&error=failed_insert_db");
}

$kode_member = "C".$running_number;

//echo "'$nama_member'<br> '$alamat'<br> '$kodepos'<br> '$no_telepon'<br> '$no_handphone'<br> '$email'<br> '$tanggal_lahir'<br> '$nama_usaha'<br> '$jenis_usaha'<br> '$alamat_usaha'<br> '$no_telepon_usaha'<br> '$catatan'<br> '$npwp'<br> '$no_kartu_member'<br> '$date_expired'<br> '$date_create'<br> '$id_create'";

$q_insert_tbl_member = mysqli_query($con, "INSERT INTO tbl_member (id_member, kode_member, nama_member, alamat, kodepos, no_telepon, no_handphone, email, tanggal_lahir, nama_usaha, jenis_usaha, alamat_usaha, no_telepon_usaha, catatan, npwp, date_expired, date_create, id_create) VALUES ('', '$kode_member', '$nama_member', '$alamat', '$kodepos', '$no_telepon', '$no_handphone', '$email', '$tanggal_lahir', '$nama_usaha', '$jenis_usaha', '$alamat_usaha', '$no_telepon_usaha', '$catatan', '$npwp', '$date_expired', '$date_create', '$id_create')");

if($q_insert_tbl_member){
	header("location:index.php?page=member-list&success=add");
}else{
	//echo"error";
	header("location:index.php?page=member-add&error=failed_insert_db");
}
?>