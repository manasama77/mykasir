<?php
include("../config.php");
$password_lama = md5($_REQUEST['password_lama']);
$id_create = $_REQUEST['id_create'];
$q_check = mysqli_query($con, "SELECT * FROM tbl_user WHERE password = '$password_lama' AND id_user = '$id_create'");
$row = mysqli_num_rows($q_check);
if($row == 1){
	echo "sama";
}else{
	echo "beda";
}
?>