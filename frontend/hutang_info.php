<?php
include("../config.php");
$kode = $_REQUEST['kode'];

$q_check_hutang_info = mysqli_query($con, "SELECT jenis_pelanggan, kode_member, catatan, kembalian, discount_persen, discount_rp, ppn, harga_ppn, tanggal_pelunasan, tanggal_jatuh_tempo, pembayaran FROM tbl_penjualan_hutang WHERE kode_penjualan = '$kode'");

$data_hutang_info = mysqli_fetch_assoc($q_check_hutang_info);
?>
<input type="hidden" id="mask_hutang_jenis_pelanggan" name="mask_hutang_jenis_pelanggan" value="<?=$data_hutang_info['jenis_pelanggan'];?>">
<input type="hidden" id="mask_hutang_kode_member" name="mask_hutang_kode_member" value="<?=$data_hutang_info['kode_member'];?>">
<input type="hidden" id="mask_hutang_catatan" name="mask_hutang_catatan" value="<?=$data_hutang_info['catatan'];?>">
<input type="hidden" id="mask_hutang_kembalian" name="mask_hutang_kembalian" value="<?=$data_hutang_info['kembalian'];?>">
<input type="hidden" id="mask_hutang_discount_persen" name="mask_hutang_discount_persen" value="<?=$data_hutang_info['discount_persen'];?>">
<input type="hidden" id="mask_hutang_discount_rp" name="mask_hutang_discount_rp" value="<?=$data_hutang_info['discount_rp'];?>">
<input type="hidden" id="mask_hutang_ppn" name="mask_hutang_ppn" value="<?=$data_hutang_info['ppn'];?>">
<input type="hidden" id="mask_hutang_harga_ppn" name="mask_hutang_harga_ppn" value="<?=$data_hutang_info['harga_ppn'];?>">
<input type="hidden" id="mask_hutang_tanggal_pelunasan" name="mask_hutang_tanggal_pelunasan" value="<?=$data_hutang_info['tanggal_pelunasan'];?>">
<input type="hidden" id="mask_hutang_tanggal_jatuh_tempo" name="mask_hutang_tanggal_jatuh_tempo" value="<?=$data_hutang_info['tanggal_jatuh_tempo'];?>">
<input type="hidden" id="mask_hutang_pembayaran" name="mask_hutang_pembayaran" value="<?=$data_hutang_info['pembayaran'];?>">