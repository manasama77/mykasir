<?php
include("../../config.php");

$kode = $_REQUEST['kode'];
$q_search = mysqli_query($con, "SELECT
tbl_produk.nama_produk,
tbl_satuan_produk.nama AS nama_satuan
FROM tbl_produk
LEFT JOIN tbl_satuan_produk ON tbl_produk.id_satuan_produk = tbl_satuan_produk.id_satuan_produk
WHERE tbl_produk.kode_produk = '$kode'");
$fa_q_search = mysqli_fetch_array($q_search);
$nama_produk = $fa_q_search['nama_produk'];
$nama_satuan = $fa_q_search['nama_satuan'];
?>
<input type="hidden" id="getnamasatuan" name="getnamasatuan" value="<?=$nama_satuan;?>">
<input type="hidden" id="getnamaproduk" name="getnamaproduk" value="<?=$nama_produk;?>">
