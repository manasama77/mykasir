<?php
include("../../config.php");

$id_provinsi = $_REQUEST['id_provinsi'];
$q_kota = mysqli_query($con, "SELECT
tbl_kota.id_kota,
tbl_kota.nama_kota
FROM
tbl_kota
WHERE tbl_kota.id_provinsi = '$id_provinsi'");

$nr_kota = mysqli_num_rows($q_kota);

if($nr_kota == 0){
	echo "<option value=\"\">-</option>";
}else{
	while($fa_kota = mysqli_fetch_array($q_kota)){
		$kota_act = "";
		$id_kota = $fa_kota['id_kota'];
		$nama_kota = $fa_kota['nama_kota'];
		if(isset($_REQUEST['id_kota2'])){
			if($_REQUEST['id_kota2'] == $id_kota){
				$kota_act = "selected='selected'";
			}
		}
		
		echo "<option $kota_act value=\"$id_kota\">$nama_kota</option>";
	}
}
?>