<?php
include("../../config.php");

$tanggal_order = $_REQUEST['tanggal_order'];
$id_vendor = $_REQUEST['id_vendor'];
$no_faktur_vendor = $_REQUEST['no_faktur_vendor'];
$tanggal_jatuh_tempo = $_REQUEST['tanggal_jatuh_tempo'];
$catatan = $_REQUEST['catatan'];
$ppn = $_REQUEST['ppn'];
$id_create = $_REQUEST['id_create'];
$date_create = date('Y-m-d');
$status = "0";
$pembayaran = "0";

$q_get_latest_id = mysqli_query($con, "SELECT id_pembelian AS lates_id FROM tbl_pembelian ORDER BY id_pembelian DESC LIMIT 1");
$fa_q_get_latest_id = mysqli_fetch_array($q_get_latest_id);
$lates_id = $fa_q_get_latest_id['lates_id'];
$lates_id = $lates_id + 1;

if($lates_id < 10){
	$running_number = "000".$lates_id;
}elseif($lates_id < 100){
	$running_number = "00".$lates_id;
}elseif($lates_id < 1000){
	$running_number = "0".$lates_id;
}elseif($lates_id < 10000){
	$running_number = $lates_id;
}else{
	header("location:index.php?page=pembelian-add&error=failed_insert_db");
}

$kode_pembelian = "TB".$running_number;

$q_hutang = mysqli_query($con, "SELECT SUM(tbl_list_pembelian.total_harga_beli) AS sub_total FROM tbl_list_pembelian WHERE tbl_list_pembelian.status = '0' AND tbl_list_pembelian.id_pembelian = '0' AND tbl_list_pembelian.id_create = '$id_create'");
$fa_q_hutang = mysqli_fetch_array($q_hutang);
$sub_total = $fa_q_hutang['sub_total'];

if($ppn == 1){
	$harga_ppn = $sub_total * 10 / 100;
}else{
	$harga_ppn = "0";
}
$grand_total = $sub_total - $harga_ppn;
$hutang = $grand_total;

$q_insert = mysqli_query($con, "INSERT INTO tbl_pembelian (id_pembelian, kode_pembelian, tanggal_order, id_vendor, no_faktur, tanggal_jatuh_tempo, catatan, date_create, id_create, status, pembayaran, hutang, grand_total, ppn, harga_ppn, sub_total) VALUES ('', '$kode_pembelian', '$tanggal_order', '$id_vendor', '$no_faktur_vendor', '$tanggal_jatuh_tempo', '$catatan', '$date_create', '$id_create', '$status', '$pembayaran', '$hutang', '$grand_total', '$ppn', '$harga_ppn', '$sub_total')");

if($q_insert){
	$new_id = mysqli_insert_id($con);
	
	$q_update = mysqli_query($con, "UPDATE tbl_list_pembelian SET status = '1', id_pembelian = '$new_id' WHERE id_create = '$id_create' AND status = '0' AND id_pembelian = '0'");
	
	if($q_update){
		$q_detect_new = mysqli_query($con, "SELECT
		LP.id_produk,
		LP.qty,
		LP.hpp,
		LP.hpj,
		LP.hpg,
		LP.tanggal_kadarluarsa
		FROM tbl_list_pembelian AS LP
		WHERE LP.id_pembelian = '$new_id' AND LP.id_create = '$id_create' AND LP.status = '1'");
		while($data_ls = mysqli_fetch_array($q_detect_new)){
			$id_produk = $data_ls['id_produk'];
			$qty_add = $data_ls['qty'];
			$hpp_new = $data_ls['hpp'];
			$hpj_new = $data_ls['hpj'];
			$hpg_new = $data_ls['hpg'];
			$tanggal_kadarluarsa_new = $data_ls['tanggal_kadarluarsa'];
			
			$q_prev_stock = mysqli_query($con, "SELECT qty FROM tbl_produk WHERE id_produk = '$id_produk'");
			$data_prev_stock = mysqli_fetch_array($q_prev_stock);
			$prev_qty = $data_prev_stock['qty'];
			$new_qty = $prev_qty + $qty_add;
			
			$q_update_produk = mysqli_query($con, "UPDATE
			tbl_produk
			SET qty = '$new_qty', hpp = '$hpp_new', hpj = '$hpj_new', hpg = '$hpg_new'
			WHERE id_produk = '$id_produk'");
			
			if($q_update_produk){
				//untuk update kadarluarsa
				$q_insert_kadarluarsa = mysqli_query($con, "INSERT INTO tbl_kadarluarsa (id_kadarluarsa, id_produk, kadarluarsa) VALUES ('', '$id_produk', '$tanggal_kadarluarsa_new')");
			}else{
				header("location:index.php?page=pembelian-add&error=failed_insert_db2");
			}
		}
		
		header("location:index.php?page=pembelian-list&success=add");
		
	}else{
		header("location:index.php?page=pembelian-add&error=failed_insert_db");
	}
}else{
	header("location:index.php?page=pembelian-add&error=failed_insert_db");
}
?>