<?php
include("../../config.php");

$nama_user = $_POST['nama_user'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$role = $_POST['role'];

$q_insert = mysqli_query($con, "INSERT INTO tbl_user (id_user, username, password, nama, id_role) VALUES ('', '$username', '$password', '$nama_user', '$role')");

if($q_insert){
	header("location:index.php?page=user-list&success=add");
}else{
	echo"Proses tambah user error silahkan hubungi team RimsMedia";
}
?>