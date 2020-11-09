<?php
include("../../config.php");

$table = $_REQUEST['table'];
$id = $_REQUEST['id'];
$page = $_REQUEST['page'];

if($page == "pembelian"){
	$q_delete_column = mysqli_query($con, "DELETE FROM tbl_".$table." WHERE id_".$table." = '".$id."'");
	$q_delete_column2 = mysqli_query($con, "DELETE FROM tbl_list_pembelian WHERE id_pembelian = '$id' AND status = '1'");
	$q_delete_column3 = mysqli_query($con, "DELETE FROM tbl_pembayaran_pembelian WHERE id_pembelian = '$id'");
}
elseif($page == "koreksi-list"){
	$chain_koreksi = $_REQUEST['chain_koreksi'];
	$q_delete_column = mysqli_query($con, "DELETE FROM tbl_".$table." WHERE id_".$table." = '".$id."'");
	$q_delete_column2 = mysqli_query($con, "DELETE FROM tbl_list_koreksi WHERE chain_koreksi = '$chain_koreksi' AND status = '1'");
	if($q_delete_column2){
		header("location:index.php?page=".$page."&success=delete");
	}else{
		header("location:index.php?page=".$page."&error=failed_delete_db");
	}
}
elseif($page == "opr-list"){
	$del_id = $_REQUEST['del_id'];
	$q_delete_column = mysqli_query($con, "DELETE FROM trx WHERE id = $del_id");	
	if($q_delete_column){
		header("location:index.php?page=".$page."&success=delete");
	}
	}
else{
	$q_delete_column = mysqli_query($con, "DELETE FROM tbl_".$table." WHERE id_".$table." = '".$id."'");
	if($q_delete_column){
		header("location:index.php?page=".$page."&success=delete");
	}else{
		header("location:index.php?page=".$page."&error=failed_delete_db");
	}
}
?>