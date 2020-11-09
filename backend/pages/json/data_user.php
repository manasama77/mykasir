<?php
//header("Content-Type: application/json; charset=UTF-8");
include("../../../config.php");
$result = $con->query("SELECT id_user, username, nama, IF(id_role = '1', 'Super Admin', IF(id_role = '2', 'Kasir', IF(id_role = '3', 'Admin', ''))) AS role, last_login FROM tbl_user");
$outp = array();
//$outp = $result->fetch_all(MYSQLI_ASSOC);
while($row = $result->fetch_assoc()){
	$outp[] = $row;
}

echo json_encode($outp);
?>