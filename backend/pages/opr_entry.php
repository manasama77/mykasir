<?php
include("../../config.php");

$id = $_POST['id'];
$keterangan = $_POST['keterangan'];
$leadger = $_POST['leadger'];
$nominal = $_POST['nominal'];
$tgl_register = $_POST['tgl_register'];
$jenis_kas = $_POST['jenis_kas'];
$status = $_POST['status'];

/*if($current_date == $start_date){
	$status = "1";
}else{
	$status = "0";
} */

$q_insert_tbl_trx = mysqli_query($con, "INSERT INTO trx (id, led, ket, nominal, tgl_reg, jenis_kas, status) 
VALUES ('', '$leadger', '$keterangan', '$nominal', '$tgl_register', '$jenis_kas', '$status')");

if($q_insert_tbl_trx){
	header("location:index.php?page=opr-list&success=add");
}else{
	echo"Proses tambah event error silahkan hubungi team IT KUMS";
}
?>