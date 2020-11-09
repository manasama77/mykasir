<?php
include("../../config.php");

$id = $_REQUEST['id'];

$q_hapus = mysqli_query($con, "DELETE FROM tbl_list_pembelian WHERE id_list_pembelian = '$id'");
if($q_hapus){
	echo "Success";
}else{
	echo "Cannot Insert";
}
?>