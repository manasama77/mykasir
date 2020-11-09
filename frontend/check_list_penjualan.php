<?php
include("../config.php");
$kode = $_REQUEST['kode'];

$q_check_list_penjualan = mysqli_query($con, "SELECT * FROM tbl_list_penjualan WHERE kode_penjualan = '$kode'");
$row_list_penjualan = mysqli_num_rows($q_check_list_penjualan);
?>

<input type="hidden" id="mask_row_list_penjualan" value="<?=$row_list_penjualan;?>">