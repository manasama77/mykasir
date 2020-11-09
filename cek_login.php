<?php
session_start();
require("config.php");
require("lib_login.php");

$username = strip_tags($_REQUEST['username']);
$username = stripslashes($_REQUEST['username']);
$password = MD5($_POST['password']);
$row_username = check_username($username);

if($row_username == 0){
	header("location:index.php?error=1&username=".$username);
}elseif($row_username == 1){
	$row_login = check_login($username, $password);
	
	if($row_login != 0){
		$q_check = mysqli_query($con, "SELECT usernya.id_user, usernya.id_role, usernya.nama FROM tbl_user AS usernya WHERE usernya.username = '$username' AND usernya.password = '$password'");
		$array_check = mysqli_fetch_assoc($q_check);
		
		$id_user = $array_check['id_user'];
		$id_role = $array_check['id_role'];
		$nama = $array_check['nama'];
		$unique_id = generate_session_id($username);
		$browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);
		
		// STORE SESSION //
		$_SESSION["id_user"] = $id_user;
		$_SESSION["username"] = $username;
		$_SESSION["id_role"] = $id_role;
		$_SESSION["nama"] = $nama;
		$_SESSION["unique_id"] = $unique_id;
		$_SESSION["browser"] = $browser;
		// END STORE SESSION //
		
		// UPDATE LOG LOGIN //
		$q_log = mysqli_query($con, "UPDATE tbl_user SET last_login = now(), unique_id = '$unique_id', browser = '$browser' WHERE id_user = '$id_user'");
		// END UPDATE LOG LOGIN //
		
		// SEPARATE DIRECT PAGE ADMIN OR KASIR //
		if($id_role == 1){
			header("location:backend/");
		}elseif($id_role == 2){
			header("location:frontend/");
		}elseif($id_role == 3){
			header("location:backend/");
		}
		// END SEPARATE DIRECT PAGE ADMIN OR KASIR //
		
	}else{
		header("location:index.php?error=2");
	}
	
}else{
	header("location:index.php?error=2");
}
?>