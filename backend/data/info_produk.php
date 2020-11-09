<?php
include("../../config.php");

$barcode = $_REQUEST['barcode'];
$nama_produk_search = $_REQUEST['nama_produk_search'];
$q_search_barcode = mysqli_query($con, "SELECT tbl_produk.id_produk, tbl_produk.barcode, tbl_produk.kode_produk, tbl_produk.nama_produk, tbl_satuan_produk.nama AS nama_satuan, tbl_produk.hpp, tbl_produk.hpj, tbl_produk.hpg FROM tbl_produk LEFT JOIN tbl_satuan_produk ON tbl_produk.id_satuan_produk = tbl_satuan_produk.id_satuan_produk WHERE tbl_produk.barcode = '$barcode' OR tbl_produk.id_produk = '$nama_produk_search'");
$fa_q_search_barcode = mysqli_fetch_array($q_search_barcode);
$id_produk = $fa_q_search_barcode['id_produk'];
$barcode = $fa_q_search_barcode['barcode'];
$kode_produk = $fa_q_search_barcode['kode_produk'];
$nama_produk = $fa_q_search_barcode['nama_produk'];
$nama_satuan = $fa_q_search_barcode['nama_satuan'];
$hpp = $fa_q_search_barcode['hpp'];
$hpj = $fa_q_search_barcode['hpj'];
$hpg = $fa_q_search_barcode['hpg'];
?>

<input type="text" id="getid" name="getid" value="<?=$id_produk;?>">
<input type="hidden" id="getbarcode" name="getbarcode" value="<?=$kode_produk;?>">
<input type="hidden" id="getkode" name="getkode" value="<?=$kode_produk;?>">
<input type="hidden" id="getnama" name="getnama" value="<?=$nama_produk;?>">
<input type="hidden" id="getsatuan" name="getsatuan" value="<?=$nama_satuan;?>">
<input type="hidden" id="gethpp" name="gethpp" value="<?=$hpp;?>">
<input type="hidden" id="gethpj" name="gethpj" value="<?=$hpj;?>">
<input type="hidden" id="gethpg" name="gethpg" value="<?=$hpg;?>">