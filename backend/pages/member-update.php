<?php
include("../../config.php");

$id = $_POST['id'];
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
$date_edit = $_POST['date_edit'];
$id_edit = $_POST['id_edit'];

$kueri = mysqli_query($con, "UPDATE tbl_member SET nama_member = '$nama_member', alamat = '$alamat', kodepos = '$kodepos', no_telepon = '$no_telepon', no_handphone = '$no_handphone', email = '$email', tanggal_lahir = '$tanggal_lahir', nama_usaha = '$nama_usaha', jenis_usaha = '$jenis_usaha', alamat_usaha = '$alamat_usaha', no_telepon_usaha = '$no_telepon_usaha', catatan = '$catatan', npwp = '$npwp', date_expired = '$date_expired', date_edit = '$date_edit', id_edit = '$id_edit' WHERE id_member = '$id'");

if($kueri){
	header("location:index.php?page=member-list&success=update");
}else{
	echo"error";
	//header("location:index.php?page=member-edit&error=failed_insert_db");
}
?>