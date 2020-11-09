<?php
include("../config.php");
$current_date = ('Y-m-d');
$q_check_special = mysqli_query($con, "SELECT
*
FROM tbl_event
WHERE `end_date` >= '$current_date'
AND tipe = '4'");

$data_special = mysqli_fetch_array($q_check_special);
$id_event = $data_special['id_event'];
$pesan = $data_special['pesan'];
?>

<input type="hidden" id="mask_pesannya" value="<?=$pesan;?>">
<input type="hidden" id="mask_id_event_special" value="<?=$id_event;?>">