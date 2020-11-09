<?php
date_default_timezone_set('Asia/Jakarta');
$con = new mysqli('localhost', 'root', '', 'matrial_db');

if ($con->connect_error) {
	die('Connect Error (' . $con->connect_errno . ') '
		. $con->connect_error);
}

$head_alamat = "<h5 class='header'>										
<b>UD Mandiri Cahaya Abadi</b><br>
Jl. Raya Cibeber Leuwisadeng KM.03 Desa Leuwisadeng Kecamatan Leuwisadeng - Bogor<br>										
<b>Telp:</b> 0251 8591 345 | <b>HP.</b> 0838 7307 5238 | <b>WA.</b> 0821 2525 9537</b><br><br>
<small>Tanggal Cetak: <?=date('Y-m-d');?></small>
</h5>";

?>