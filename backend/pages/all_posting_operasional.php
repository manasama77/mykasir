<?php
include("../../config.php");

//parameter posting neraca

$nominal = $_POST['nominal'];
$leadger = $_POST['leadger'];
$tgl_posting = $_POST['tgl_posting'];
$param = $_POST['status'];
$ket = $_POST['ket'];

$tanggal_awal = $_POST['tanggal_awal'];
$tanggal_akhir = $_POST['tanggal_akhir'];

//cek parameter
echo "<br>"; echo $_POST['nominal'];
echo "<br>"; echo $_POST['leadger'];
echo "<br>"; echo $_POST['tgl_posting'];
echo "<br>"; echo $_POST['status']; 
echo "<br>"; echo $_POST['ket'];

//cek saldo kredit
$q_saldo_kredit=mysqli_query($con, "SELECT saldo FROM lead WHERE kode='$leadger'");
$q_saldo_row_kredit = mysqli_fetch_assoc($q_saldo_kredit);
$saldo_awal_kredit=$q_saldo_row_kredit['saldo'];

$saldo_posting=$_POST['nominal'];
$saldo_d=$saldo_awal_kredit-$saldo_posting;

//cek saldo jurnal posting 10001
$q_posting=mysqli_query($con, "SELECT saldo, id_leadger FROM tbl_neraca_posting WHERE id_leadger='$leadger' order by id DESC LIMIT 1");
$q_data=mysqli_fetch_assoc($q_posting);
$saldo_debit=$q_data['saldo']-$nominal;


if($_POST['nominal']>0){

$q_sttus=mysqli_query($con, "UPDATE trx SET status = 1 WHERE DATE(tgl_reg) >= '$tanggal_awal' AND DATE(tgl_reg) <= '$tanggal_akhir'");
$q_du=mysqli_query($con, "UPDATE lead SET saldo = '$saldo_d', last_update = now() WHERE lead.kode = '$leadger'");
$q_d = mysqli_query($con, "INSERT INTO tbl_neraca_posting 
			(id, 	id_leadger, 	tgl_posting, 		debit, 			kredit, 		saldo, 				param, 		ket) 
	VALUES 	('', 	'$leadger', 	'$tgl_posting', 	'$nominal', 	0, 				'$saldo_debit', 	1, 			'$ket')");
}
?>