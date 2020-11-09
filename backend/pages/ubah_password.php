<?php
include("../../config.php");

$id = $_REQUEST['id'];
$password = md5($_REQUEST['new_password']);
$kueri = mysqli_query($con, "UPDATE tbl_user SET password = '$password' WHERE id_user = '$id'");

if($kueri){
	echo "success";
}else{
	echo "error";
}
?>