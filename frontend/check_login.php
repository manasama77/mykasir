<?php
session_start();
include("../config.php");
include("lib/check_login.php");
$restric = check_login($_SESSION['id_user'], $_SESSION['unique_id'], $_SESSION['browser']);
if($restric != 1){
	header("location:../index.php");
}
?>