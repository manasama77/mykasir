<?php
function check_login($a, $b, $c)
{
	include("../../config.php");
	$q_check_login = mysqli_query($con, "SELECT id_user FROM tbl_user WHERE id_user = '$a' AND unique_id = '$b' AND browser = '$c'");
	$result = mysqli_num_rows($q_check_login);
	return $result;
}
?>