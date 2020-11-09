<?php
include("../../config.php");

$id = $_REQUEST['id'];

$q_hapus = mysqli_query($con, "DELETE FROM tbl_list_koreksi WHERE id_list_koreksi = '$id'");
?>