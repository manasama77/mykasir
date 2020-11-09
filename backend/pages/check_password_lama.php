<?php
include("../../config.php");
$password = md5($_REQUEST['password']);
$q_check = mysqli_query($con, "SELECT * FROM tbl_user WHERE password = '$password'");
$row = mysqli_num_rows($q_check);
if($row == 1){
	echo "sama";
}else{
	echo "beda";
}
?>