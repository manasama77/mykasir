<?php
include("../../config.php");
$id = $_REQUEST['id'];
$password_baru = md5($_REQUEST['password_baru']);

$q_update = mysqli_query($con, "UPDATE tbl_user SET password = '$password_baru' WHERE id_user = '$id'");

if($q_update){
	echo "Success";
}else{
	echo "Error";
}
?>