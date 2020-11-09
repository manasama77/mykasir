<?php
include("../../config.php");

//parameter posting neraca

$nominal = $_POST['nominal'];
$kredit = $_POST['kredit'];
$tgl_posting = $_POST['tgl_posting'];
$param = $_POST['param'];
$ket = $_POST['ket'];

$tanggal_awal = $_POST['tanggal_awal'];
$tanggal_akhir = $_POST['tanggal_akhir'];

//cek parameter
echo "<br>"; echo $_POST['nominal'];
echo "<br>"; echo $_POST['kredit'];
echo "<br>"; echo $_POST['tgl_posting'];
echo "<br>"; echo $_POST['param']; 
echo "<br>"; echo $_POST['ket'];


//cek saldo kredit
$q_saldo_kredit=mysqli_query($con, "SELECT saldo FROM lead WHERE kode='$kredit'");
$q_saldo_row_kredit = mysqli_fetch_assoc($q_saldo_kredit);
$saldo_awal_kredit=$q_saldo_row_kredit['saldo'];

$saldo_posting=$_POST['nominal'];
$saldo_k=$saldo_awal_kredit+$saldo_posting;

//cek saldo posting 10001
$q_posting=mysqli_query($con, "SELECT saldo, id_leadger FROM tbl_neraca_posting WHERE id_leadger='$kredit' order by id DESC LIMIT 1");
$q_data=mysqli_fetch_assoc($q_posting);
$saldo_kredit=$q_data['saldo']+$nominal;


if($_POST['nominal']>0){

//	$q_d = mysqli_query($con, "INSERT INTO tbl_neraca_posting (id, id_leadger, tgl_posting, debit, kredit, saldo, param, ket) 
//	VALUES ('', $debet', '$tgl_posting', $nominal, 0, '$saldo_debit', 0, '$param', '$ket')");

	$q_k = mysqli_query($con, "INSERT INTO tbl_neraca_posting 
			(id, 	id_leadger, 	tgl_posting, 		debit, 		kredit, 		saldo, 				param, 		ket) 
	VALUES 	('', 	'$kredit', 		'$tgl_posting', 	0, 			'$nominal', 	'$saldo_kredit', 	'$param', 	'$ket')");

//	$q_du=mysqli_query($con, "UPDATE lead SET saldo = '$saldo_d' WHERE lead.kode = '$debet'");
	$q_ku=mysqli_query($con, "UPDATE lead SET saldo = '$saldo_k', last_update = now() WHERE lead.kode = '$kredit'");



	//UPDATE STATUS TABEL PENJUALAN "POSTING"
	$qp= mysqli_query($con, "UPDATE
	tbl_penjualan
	SET post = 1
	WHERE DATE(create_date) >= '$tanggal_awal' AND DATE(create_date) <= '$tanggal_akhir'
	AND status = 'lunas'");

	$qph= mysqli_query($con, "UPDATE
	tbl_pembayaran_penjualan
	SET post = 1
	WHERE DATE(tgl_pembayaran) >= '$tanggal_awal' AND DATE(tgl_pembayaran) <= '$tanggal_akhir'");

} else {header("location:laporan-penjualan-berjarak.php?tanggal_awal=$tgl_posting&tanggal_akhir=$tgl_posting");}


if($q_ku){
	header("location:laporan-penjualan-berjarak.php?tanggal_awal=$tgl_posting&tanggal_akhir=$tgl_posting");
}else{
	echo"Proses tambah event error silahkan hubungi team IT KUMS";
}
?>