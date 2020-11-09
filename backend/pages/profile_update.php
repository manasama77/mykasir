<?php
include("../../config.php");
$id = $_REQUEST['id'];
$nama = $_REQUEST['nama'];

$q_update = mysqli_query($con, "UPDATE tbl_user SET nama = '$nama' WHERE id_user = '$id'");

if($q_update){
	echo "Success";
}else{
	echo "Error";
}
?>