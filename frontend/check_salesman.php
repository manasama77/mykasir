<?php
include("../config.php");

$by = $_REQUEST['by'];

if($by == "kode"){
	$kode_salesman = $_REQUEST['kode_salesman'];
	$q_salesman = mysqli_query($con, "SELECT id_salesman, kode_salesman, nama_salesman FROM tbl_salesman WHERE kode_salesman = '$kode_salesman'");
}else{
	$nama_salesman = $_REQUEST['nama_salesman'];
	$q_salesman = mysqli_query($con, "SELECT id_salesman, kode_salesman, nama_salesman FROM tbl_salesman WHERE nama_salesman = '$nama_salesman'");
}

$row_salesman = mysqli_num_rows($q_salesman);
$data_salesman = mysqli_fetch_assoc($q_salesman);
?>

<input type="hidden" id="mask_row_salesman" value="<?=$row_salesman;?>">
<input type="hidden" id="mask_id_salesman" name="mask_id_salesman" value="<?=$data_salesman['id_salesman'];?>">
<input type="hidden" id="mask_kode_salesman" name="mask_kode_salesman" value="<?=$data_salesman['kode_salesman'];?>">
<input type="hidden" id="mask_nama_salesman" name="mask_nama_salesman" value="<?=$data_salesman['nama_salesman'];?>">