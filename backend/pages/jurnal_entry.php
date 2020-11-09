<?php
include("../../config.php");


$debet = $_POST['debet'];
$kredit = $_POST['kredit'];

$tgl_posting = $_POST['tgl_posting'];
$nominal = $_POST['nominal'];
$param = $_POST['param'];

$ket = $_POST['ket'];

/*if($current_date == $start_date){
	$status = "1";
}else{
	$status = "0";
} */

echo "<br>"; echo $_POST['ket'];
echo "<br>"; echo $_POST['debet'];
echo "<br>"; echo $_POST['kredit'];
echo "<br>"; echo $_POST['nominal'];
echo "<br>"; echo $_POST['tgl_posting'];
echo "<br>"; echo $_POST['param']; 
echo "<br>";




//cek saldo debet
$q_saldo=mysqli_query($con, "SELECT saldo as saldo FROM lead WHERE kode='$debet'");
$q_saldo_row = mysqli_fetch_assoc($q_saldo);
$saldo_awal=$q_saldo_row['saldo'];

$saldo_posting=$_POST['nominal'];
$saldo_d=$saldo_awal-$saldo_posting;

//cek saldo kredit
$q_saldo_kredit=mysqli_query($con, "SELECT saldo FROM lead WHERE kode='$kredit'");
$q_saldo_row_kredit = mysqli_fetch_assoc($q_saldo_kredit);
$saldo_awal_kredit=$q_saldo_row_kredit['saldo'];

$saldo_posting=$_POST['nominal'];
$saldo_k=$saldo_awal_kredit+$saldo_posting;

//cek saldo posting debet
$q_saldo_posting_debet=mysqli_query($con, "SELECT saldo FROM tbl_neraca_posting WHERE id_leadger='$debet' ORDER by id DESC LIMIT 1");
$q_saldo_row_posting = mysqli_fetch_assoc($q_saldo_posting_debet);
$saldo_debit=$q_saldo_row_posting['saldo']-$nominal;

//cek saldo posting kredit
$q_saldo_posting_kredit=mysqli_query($con, "SELECT saldo FROM tbl_neraca_posting WHERE id_leadger='$kredit' ORDER by id DESC LIMIT 1");
$q_saldo_row_posting_kredit = mysqli_fetch_assoc($q_saldo_posting_kredit);
$saldo_kredit=$q_saldo_row_posting_kredit['saldo']+$nominal;




if($_POST['debet']>0 AND $_POST['kredit']> 0 AND $saldo_awal>=$saldo_posting){

	$q_d = mysqli_query($con, "INSERT INTO tbl_neraca_posting (id, id_leadger, kredit, debit, saldo, tgl_posting, ket, param) 
	VALUES ('', '$debet', 0, $nominal, $saldo_debit, '$tgl_posting', '$ket', '$param')");

	$q_k = mysqli_query($con, "INSERT INTO tbl_neraca_posting (id, id_leadger, kredit, debit, saldo, tgl_posting, ket, param) 
	VALUES ('', '$kredit', $nominal, 0, $saldo_kredit, '$tgl_posting', '$ket', '$param')");

	$q_du=mysqli_query($con, "UPDATE lead SET saldo = '$saldo_d' WHERE lead.kode = '$debet'");
	$q_ku=mysqli_query($con, "UPDATE lead SET saldo = '$saldo_k' WHERE lead.kode = '$kredit'");

} else {header("location:index.php?page=jurnal_rca_add&saldo=error");}


if($q_d){
	header("location:index.php?page=jurnal_rca_add&success=add");
}else{
	echo"Proses tambah event error silahkan hubungi team IT KUMS";
}
?>