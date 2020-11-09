<?php
include("../config.php");
$kode_member = $_REQUEST['kode_member'];

$q_member = mysqli_query($con, "SELECT id_member, kode_member, nama_member FROM tbl_member WHERE kode_member = '$kode_member' AND CURDATE() <= date_expired");
$row_member = mysqli_num_rows($q_member);
$data_member = mysqli_fetch_assoc($q_member);
?>

<input type="hidden" id="mask_row_member" value="<?=$row_member;?>">
<input type="hidden" id="mask_id_member" name="mask_id_member" value="<?=$data_member['id_member'];?>">
<input type="hidden" id="mask_kode_member" name="mask_kode_member" value="<?=$data_member['kode_member'];?>">
<input type="hidden" id="mask_nama_member" name="mask_nama_member" value="<?=$data_member['nama_member'];?>">