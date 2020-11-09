<?php
include("../config.php");
$kode_penjualan = $_REQUEST['kode_penjualan'];
$sub_total = $_REQUEST['sub_total'];
$grand_total = $_REQUEST['grand_total'];
$discount_persen = $_REQUEST['discount_persen'];
$discount_rp = $_REQUEST['discount_rp'];
$ppn = $_REQUEST['ppn'];
$harga_ppn = $_REQUEST['harga_ppn'];
$pembayaran = $_REQUEST['pembayaran'];
$kembalian = $_REQUEST['kembalian'];
$tanggal_pelunasan = $_REQUEST['tanggal_pelunasan'];
$tanggal_jatuh_tempo = $_REQUEST['tanggal_jatuh_tempo'];
$catatan = $_REQUEST['catatan'];
$id_create = $_REQUEST['id_create'];
$ppn = $_REQUEST['ppn'];
$status = $_REQUEST['status'];
$jenis_pelanggan = $_REQUEST['jenis_pelanggan'];
$kode_member = $_REQUEST['kode_member'];
$kode_salesman = $_REQUEST['kode_salesman'];
$tipe_pembayaran = $_REQUEST['tipe_pembayaran'];
$status2 = $_REQUEST['status2'];


if(isset($_REQUEST['mask_running_number'])){
	$mask_running_number = $_REQUEST['mask_running_number'];
}

if($tipe_pembayaran == "hutang"){
	$q_insert = mysqli_query($con, "INSERT INTO tbl_penjualan_hutang (id_penjualan_hutang, kode_penjualan, running_number, sub_total, grand_total, discount_persen, discount_rp, ppn, harga_ppn, pembayaran, kembalian, tanggal_pelunasan, tanggal_jatuh_tempo, catatan, status, create_date, id_create, jenis_pelanggan, kode_member, kode_salesman) VALUES ('', '$kode_penjualan', '$mask_running_number', '$sub_total', '$grand_total', '$discount_persen', '$discount_rp', '$ppn', '$harga_ppn', '$pembayaran', '$kembalian', '$tanggal_pelunasan', '$tanggal_jatuh_tempo', '$catatan', '$status', now(), '$id_create', '$jenis_pelanggan', '$kode_member', '$kode_salesman')");
	
	$q_update_2 = mysqli_query($con, "UPDATE tbl_list_penjualan_hutang SET status = '1' WHERE kode_penjualan = '$kode_penjualan'");
	
	$q_qty = mysqli_query($con, "SELECT id_produk, qty FROM tbl_list_penjualan_hutang WHERE kode_penjualan = '$kode_penjualan'");
	while($data_qty = mysqli_fetch_assoc($q_qty)){
		$id_produk = $data_qty['id_produk'];
		$qty_sell = $data_qty['qty'];
		
		$q_latest_qty = mysqli_query($con, "SELECT qty FROM tbl_produk WHERE id_produk = '$id_produk'");
		$data_latest_qty = mysqli_fetch_assoc($q_latest_qty);
		$latest_qty = $data_latest_qty['qty'];
		
		$new_qty = $latest_qty - $qty_sell;
		$q_update_produk = mysqli_query($con, "UPDATE tbl_produk SET qty = '$new_qty' WHERE id_produk = '$id_produk'");
	}
	
}else{
	if($status2 == 0){
		$q_insert = mysqli_query($con, "INSERT INTO tbl_penjualan (id_penjualan, kode_penjualan, running_number, sub_total, grand_total, discount_persen, discount_rp, ppn, harga_ppn, pembayaran, kembalian, tanggal_pelunasan, tanggal_jatuh_tempo, catatan, status, create_date, id_create, jenis_pelanggan, kode_member, kode_salesman) VALUES ('', '$kode_penjualan', '$mask_running_number', '$sub_total', '$grand_total', '$discount_persen', '$discount_rp', '$ppn', '$harga_ppn', '$pembayaran', '$kembalian', '$tanggal_pelunasan', '$tanggal_jatuh_tempo', '$catatan', '$status', now(), '$id_create', '$jenis_pelanggan', '$kode_member', '$kode_salesman')");

		$q_update = mysqli_query($con, "UPDATE tbl_list_penjualan SET status = '1' WHERE kode_penjualan = '$kode_penjualan'");
		$q_update_2 = mysqli_query($con, "UPDATE tbl_list_penjualan_event SET status = '1' WHERE kode_penjualan = '$kode_penjualan'");

		$q_qty = mysqli_query($con, "SELECT id_produk, qty FROM tbl_list_penjualan WHERE kode_penjualan = '$kode_penjualan'");
		while($data_qty = mysqli_fetch_assoc($q_qty)){
			$id_produk = $data_qty['id_produk'];
			$qty_sell = $data_qty['qty'];
			
			$q_latest_qty = mysqli_query($con, "SELECT qty FROM tbl_produk WHERE id_produk = '$id_produk'");
			$data_latest_qty = mysqli_fetch_assoc($q_latest_qty);
			$latest_qty = $data_latest_qty['qty'];
			
			$new_qty = $latest_qty - $qty_sell;
			$q_update_produk = mysqli_query($con, "UPDATE tbl_produk SET qty = '$new_qty' WHERE id_produk = '$id_produk'");
		}

		$q_qty_event = mysqli_query($con, "SELECT id_produk, qty FROM tbl_list_penjualan_event WHERE kode_penjualan = '$kode_penjualan'");
		while($data_qty_event = mysqli_fetch_assoc($q_qty_event)){
			$id_produk_event = $data_qty['id_produk'];
			$qty_sell_event = $data_qty['qty'];
			
			$q_latest_qty_event = mysqli_query($con, "SELECT qty FROM tbl_produk WHERE id_produk = '$id_produk_event'");
			$data_latest_qty_event = mysqli_fetch_assoc($q_latest_qty_event);
			$latest_qty_event = $data_latest_qty_event['qty'];
			
			$new_qty_event = $latest_qty_event - $qty_sell_event;
			$q_update_produk_event = mysqli_query($con, "UPDATE tbl_produk SET qty = '$new_qty_event' WHERE id_produk = '$id_produk_event'");
		}
	}elseif($status2 == 1){

$q_cp = mysqli_query($con, "SELECT SUM(bayar) AS bayar FROM tbl_pembayaran_penjualan WHERE kode_penjualan='$kode_penjualan'");
$q_row=mysqli_fetch_assoc($q_cp);
$s_bayar = $q_row['bayar']; //jumlah yg sudah di bayar
$pembayaran = $_REQUEST['pembayaran']; //pembayaran sekarang
$total_bayar = $s_bayar+$pembayaran;

$kembalian = $total_bayar-$grand_total;


	
	if($kembalian>=0){$y_shl='lunas';} else{$y_shl='hutang';}
	
		$q_pembayaran = mysqli_query($con, "INSERT INTO tbl_pembayaran_penjualan (id, kode_penjualan, kode_member, bayar, tgl_pembayaran, catatan) 
											VALUES (NULL, '$kode_penjualan', '$kode_member', $pembayaran, current_timestamp(), '$catatan')");


		$q_insert = mysqli_query($con, "UPDATE tbl_penjualan_hutang SET create_date = NOW(), status = '$y_shl', pembayaran = '$total_bayar', kembalian = '$kembalian', catatan = '$catatan' WHERE kode_penjualan = '$kode_penjualan'");
	}
}

if($q_insert){
	echo "berhasil";
}else{
	echo "gagal";
}
?>