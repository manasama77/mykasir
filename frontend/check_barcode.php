<?php
include("../config.php");
$barcode = $_REQUEST['barcode'];

$q_check_barcode = mysqli_query($con, "SELECT
p.id_produk,
p.kode_produk,
p.nama_produk,
p.qty AS stock,
p.hpj,
p.hpg,
sp.nama AS satuan
FROM tbl_produk AS p
LEFT JOIN tbl_satuan_produk AS sp ON sp.id_satuan_produk = p.id_satuan_produk
WHERE p.barcode = '$barcode'");
$row_barcode = mysqli_num_rows($q_check_barcode);

$data_barcode = mysqli_fetch_assoc($q_check_barcode);
?>

<input type="hidden" id="mask_row_barcode" value="<?=$row_barcode;?>">
<input type="hidden" id="mask_id_produk" value="<?=$data_barcode['id_produk'];?>">
<input type="hidden" id="mask_kode_produk" value="<?=$data_barcode['kode_produk'];?>">
<input type="hidden" id="mask_nama_produk" value="<?=$data_barcode['nama_produk'];?>">
<input type="hidden" id="mask_satuan" value="<?=$data_barcode['satuan'];?>">
<input type="hidden" id="mask_stock" value="<?=$data_barcode['stock'];?>">
<input type="hidden" id="mask_hpj" value="<?=$data_barcode['hpj'];?>">
<input type="hidden" id="mask_hpg" value="<?=$data_barcode['hpg'];?>">