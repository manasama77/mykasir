<?php
include("../../config.php");

$id = $_POST['id'];
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

$kueri = mysqli_query($con, "UPDATE tbl_vendor SET nama_perusahaan = '$nama_perusahaan', alamat = '$alamat', id_provinsi = '$id_provinsi', id_kota = '$id_kota', kodepos = '$kodepos', no_telepon = '$no_telepon', no_fax = '$no_fax', email = '$email', pic = '$pic', no_handphone = '$no_handphone', no_rekening = '$no_rekening', id_bank = '$id_bank', atas_nama = '$atas_nama', catatan = '$catatan', date_create = '$date_create', id_create = '$id_create' WHERE id_vendor = '$id'");

if($kueri){
	header("location:index.php?page=vendor-list&success=update");
}else{
	echo"error";
	//header("location:index.php?page=vendor-add&error=failed_insert_db");
}
?>