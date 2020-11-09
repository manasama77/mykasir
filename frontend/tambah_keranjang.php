<?php
include("../config.php");

$a = $_REQUEST['a']; // KODE PENJUALAN
$b = $_REQUEST['b']; // ID PRODUK
$c = $_REQUEST['c']; // NAMA PRODUK
$d = $_REQUEST['d']; // SATUAN PRODUK
$e = $_REQUEST['e']; // QTY INPUT
$f = $_REQUEST['f']; // HARGA JUAL
$g = $_REQUEST['g']; // TOTAL
$h = $_REQUEST['h']; // ID CREATE
$i = $_REQUEST['i']; // JENIS PELANGGAN
$j = $_REQUEST['j']; // KODE MEMBER
$k = $_REQUEST['k']; // NAMA MEMBER
$l = $_REQUEST['l']; // SPECIAL PRICE STATUS
$m = $_REQUEST['m']; // TIPE PEMBAYARAN
$status = 0;

if($i == "member" && $m == "hutang"){
	$q_insert = mysqli_query($con, "INSERT INTO tbl_list_penjualan_hutang (id_list_penjualan_hutang, kode_penjualan, id_produk, nama_produk, satuan, qty, hpj, total_harga, status, id_create, date_create, jenis_pelanggan, kode_member, nama_member, discount, discount_rp, id_event, hpj_nett) VALUES ('', '$a', '$b', '$c', '$d', '$e', '$f', '$g', '$status', '$h', now(), '$i', '$j', '$k', '', '', '', '$f')");
}else{
	$current_date = date('Y-m-d');
	$q_event_list = mysqli_query($con, "SELECT * FROM tbl_event WHERE `end_date` >= '$current_date' AND id_produk = '$b'");
	$row_event_list = mysqli_num_rows($q_event_list);

	if($row_event_list > 0){ // Event Start
		while($data_event = mysqli_fetch_assoc($q_event_list)){
			$tipe = $data_event['tipe'];
			
			if($tipe == 1){ // Proses event discount
				$id_event = $data_event['id_event'];
				$nama_event = $data_event['nama'];
				$discount = $data_event['discount'];
				
				if($e >= 1){
					$qty_terkena_event = floor($e / 1); // 1 adalah nilai minimal terkena discount
					if($qty_terkena_event >= 1){
						$satuan_discount = $f * $discount / 100;
						$discount_rp = $satuan_discount * $qty_terkena_event;
						$harga_jual_nett = $f - $satuan_discount;
						$total_harga = $e * $f - $discount_rp;
						
						$q_insert = mysqli_query($con, "INSERT INTO tbl_list_penjualan (id_list_penjualan, kode_penjualan, id_produk, nama_produk, satuan, qty, hpj, total_harga, status, id_create, date_create, jenis_pelanggan, kode_member, nama_member, discount, discount_rp, id_event, hpj_nett) VALUES ('', '$a', '$b', '$c', '$d', '$e', '$f', '$total_harga', '$status', '$h', now(), '$i', '$j', '$k', '$discount', '$discount_rp', '$id_event', '$harga_jual_nett')");
						
						$new_id = mysqli_insert_id($con);
						
						$total_harga_event = $discount_rp;
						
						$q_insert_event = mysqli_query($con, "INSERT INTO tbl_list_penjualan_event (id_list_penjualan_event, id_list_penjualan, id_event, nama_event, tipe, kode_penjualan, id_produk, nama_produk, satuan, qty, hpj, discount, discount_rp, harga_jual_nett, total_harga, status, id_create, date_create, jenis_pelanggan, kode_member, nama_member) VALUES ('', '$new_id', '$id_event', '$nama_event', '$tipe', '$a', '$b', '$c', '$d', '$qty_terkena_event', '$f', '$discount', '$discount_rp', '$harga_jual_nett', '$total_harga_event', '$status', '$h', now(), '$i', '$j', '$k')");
						
					}else{
						$discount = 0;
						$discount_rp = 0;
						$total_harga = $e * $f;
						
						$q_insert = mysqli_query($con, "INSERT INTO tbl_list_penjualan (id_list_penjualan, kode_penjualan, id_produk, nama_produk, satuan, qty, hpj, total_harga, status, id_create, date_create, jenis_pelanggan, kode_member, nama_member, discount, discount_rp, id_event, hpj_nett) VALUES ('', '$a', '$b', '$c', '$d', '$e', '$f', '$total_harga', '$status', '$h', now(), '$i', '$j', '$k', '$discount', '$discount_rp', '$id_event', '$f')");
					}
				}else{
					$discount = 0;
					$discount_rp = 0;
					$total_harga = $e * $f;
					
					$q_insert = mysqli_query($con, "INSERT INTO tbl_list_penjualan (id_list_penjualan, kode_penjualan, id_produk, nama_produk, satuan, qty, hpj, total_harga, status, id_create, date_create, jenis_pelanggan, kode_member, nama_member, discount, discount_rp, id_event, hpj_nett) VALUES ('', '$a', '$b', '$c', '$d', '$e', '$f', '$total_harga', '$status', '$h', now(), '$i', '$j', '$k', '$discount', '$discount_rp', '$id_event', '$f')");
				}
				
			}elseif($tipe == 2){
				$id_event = $data_event['id_event'];
				$nama_event = $data_event['nama'];
				$potongan_harga = $data_event['potongan_harga'];
				
				if($e >= 1){
					$qty_terkena_event = floor($e / 1); // 1 adalah nilai minimal terkena discount
					if($qty_terkena_event >= 1){
						$discount_rp = $qty_terkena_event * $potongan_harga;
						$harga_jual_nett = $f - $potongan_harga;
						$total_harga = $e * $f - $discount_rp;
						
						$q_insert = mysqli_query($con, "INSERT INTO tbl_list_penjualan (id_list_penjualan, kode_penjualan, id_produk, nama_produk, satuan, qty, hpj, total_harga, status, id_create, date_create, jenis_pelanggan, kode_member, nama_member, discount_rp, id_event, hpj_nett) VALUES ('', '$a', '$b', '$c', '$d', '$e', '$f', '$total_harga', '$status', '$h', now(), '$i', '$j', '$k', '$discount_rp', '$id_event', '$harga_jual_nett')");
						
						$new_id = mysqli_insert_id($con);
						
						$total_harga_event = $discount_rp;
						
						$q_insert_event = mysqli_query($con, "INSERT INTO tbl_list_penjualan_event (id_list_penjualan_event, id_list_penjualan, id_event, nama_event, tipe, kode_penjualan, id_produk, nama_produk, satuan, qty, hpj, discount_rp, harga_jual_nett, total_harga, status, id_create, date_create, jenis_pelanggan, kode_member, nama_member) VALUES ('', '$new_id', '$id_event', '$nama_event', '$tipe', '$a', '$b', '$c', '$d', '$qty_terkena_event', '$f', '$discount_rp', '$harga_jual_nett', '$total_harga_event', '$status', '$h', now(), '$i', '$j', '$k')");
						
					}else{
						$discount_rp = 0;
						$harga_jual_nett = $f;
						$total_harga = $e * $harga_jual_nett;
						
						$q_insert = mysqli_query($con, "INSERT INTO tbl_list_penjualan (id_list_penjualan, kode_penjualan, id_produk, nama_produk, satuan, qty, hpj, total_harga, status, id_create, date_create, jenis_pelanggan, kode_member, nama_member, discount_rp, id_event, hpj_nett) VALUES ('', '$a', '$b', '$c', '$d', '$e', '$f', '$total_harga', '$status', '$h', now(), '$i', '$j', '$k', '$discount_rp', '$id_event', '$harga_jual_nett')");
					}
					
				}else{
					$discount_rp = 0;
					$harga_jual_nett = $f;
					$total_harga = $e * $harga_jual_nett;
					
					$q_insert = mysqli_query($con, "INSERT INTO tbl_list_penjualan (id_list_penjualan, kode_penjualan, id_produk, nama_produk, satuan, qty, hpj, total_harga, status, id_create, date_create, jenis_pelanggan, kode_member, nama_member, discount_rp, id_event, hpj_nett) VALUES ('', '$a', '$b', '$c', '$d', '$e', '$f', '$total_harga', '$status', '$h', now(), '$i', '$j', '$k', '$discount_rp', '$id_event', '$harga_jual_nett')");
				}
				
			}elseif($tipe == 3){
				$id_event = $data_event['id_event'];
				$nama_event = $data_event['nama'];
				$qty_minimal_pembelian = $data_event['qty_minimal_pembelian'];
				$id_produk_gratis = $data_event['id_produk_gratis'];
				$qty_gratis = $data_event['qty_gratis'];
				$akumulasi = $data_event['akumulasi'];
				
				$q_produk_gratis = mysqli_query($con, "SELECT tbl_produk.nama_produk, tbl_produk.hpj, tbl_satuan_produk.nama AS satuan FROM tbl_produk LEFT JOIN tbl_satuan_produk ON tbl_satuan_produk.id_satuan_produk = tbl_produk.id_satuan_produk WHERE tbl_produk.id_produk = '$id_produk_gratis'");
				$data_produk_gratis = mysqli_fetch_assoc($q_produk_gratis);
				$nama_produk_gratis = $data_produk_gratis['nama_produk'];
				$satuan_gratis = $data_produk_gratis['satuan'];
				$hpj_gratis = $data_produk_gratis['hpj'];
				
				if($e >= $qty_minimal_pembelian){
					// penerapan bonus
					if($akumulasi == "yes"){
						$qty_tambahan = floor($e / $qty_minimal_pembelian * $qty_gratis);
						$total_harga_gratis = $hpj_gratis * $qty_tambahan;
					}elseif($akumulasi == "no"){
						$qty_tambahan = $qty_gratis;
						$total_harga_gratis = $hpj_gratis * $qty_tambahan;
					}
					
					$q_insert = mysqli_query($con, "INSERT INTO tbl_list_penjualan (id_list_penjualan, kode_penjualan, id_produk, nama_produk, satuan, qty, hpj, total_harga, status, id_create, date_create, jenis_pelanggan, kode_member, nama_member, hpj_nett) VALUES ('', '$a', '$b', '$c', '$d', '$e', '$f', '$g', '$status', '$h', now(), '$i', '$j', '$k', '$f')");
					
					$q_insert_2 = mysqli_query($con, "INSERT INTO tbl_list_penjualan (id_list_penjualan, kode_penjualan, id_produk, nama_produk, satuan, qty, hpj, total_harga, status, id_create, date_create, jenis_pelanggan, kode_member, nama_member, hpj_nett, id_event) VALUES ('', '$a', '$id_produk_gratis', '$nama_produk_gratis', '$satuan_gratis', '$qty_tambahan', '$hpj_gratis', '0', '$status', '$h', now(), '$i', '$j', '$k', '0', '$id_event')");
					
					$new_id = mysqli_insert_id($con);
					
					$q_insert_event = mysqli_query($con, "INSERT INTO tbl_list_penjualan_event (id_list_penjualan_event, id_list_penjualan, id_event, nama_event, tipe, kode_penjualan, id_produk, nama_produk, satuan, qty, hpj, harga_jual_nett, total_harga, status, id_create, date_create, jenis_pelanggan, kode_member, nama_member, qty_minimal_pembelian, id_produk_gratis, qty_gratis, akumulasi) VALUES ('', '$new_id', '$id_event', '$nama_event', '$tipe', '$a', '$id_produk_gratis', '$nama_produk_gratis', '$satuan_gratis', '$qty_tambahan', '$hpj_gratis', '$hpj_gratis', '$total_harga_gratis', '$status', '$h', now(), '$i', '$j', '$k', '$qty_minimal_pembelian', '$id_produk_gratis', '$qty_gratis', '$akumulasi')");
					
				}else{
					// input tanpa bonus
					$q_insert = mysqli_query($con, "INSERT INTO tbl_list_penjualan (id_list_penjualan, kode_penjualan, id_produk, nama_produk, satuan, qty, hpj, total_harga, status, id_create, date_create, jenis_pelanggan, kode_member, nama_member, hpj_nett) VALUES ('', '$a', '$b', '$c', '$d', '$e', '$f', '$g', '$status', '$h', now(), '$i', '$j', '$k', '$f')");
				}
				
			}
			
		}
	}else{
		
		if($l == "true"){
			$q_insert = mysqli_query($con, "INSERT INTO tbl_list_penjualan_event (id_list_penjualan_event, id_list_penjualan, id_event, nama_event, tipe, kode_penjualan, id_produk, nama_produk, satuan, qty, hpj, harga_jual_nett, total_harga, status, id_create, date_create, jenis_pelanggan, kode_member, nama_member, qty_minimal_pembelian, id_produk_gratis, qty_gratis, akumulasi) VALUES ('', '', '', '', '4', '$a', '$b', '$c', '$d', '$e', '$f', '$f', '$g', '$status', '$h', now(), '$i', '$j', '$k', '', '', '', '')");
		}else{
			$q_detect = mysqli_query($con, "SELECT id_list_penjualan, qty, hpj FROM tbl_list_penjualan WHERE id_produk = '$b' AND id_create = '$h' AND status = '0' AND kode_penjualan = '$a'");
			$row = mysqli_num_rows($q_detect);
			if($row > 0){
				$data = mysqli_fetch_assoc($q_detect);
				$id_list_penjualan = $data['id_list_penjualan'];
				$latest_qty = $data['qty'];
				$latest_hpj = $data['hpj'];
				$new_qty = $latest_qty + $e;
				$new_total_harga = $new_qty * $latest_hpj;
				$q_insert = mysqli_query($con, "UPDATE tbl_list_penjualan SET qty = '$new_qty', total_harga = '$new_total_harga' WHERE id_list_penjualan = '$id_list_penjualan'")OR DIE("error");
			}else{
				$sql = "INSERT INTO tbl_list_penjualan (kode_penjualan, id_produk, nama_produk, satuan, qty, hpj, total_harga, status, id_create, date_create, jenis_pelanggan, kode_member, nama_member) VALUES ('$a', '$b', '$c', '$d', '$e', '$f', '$g', '$status', '$h', now(), '$i', '$j', '$k')";
				$q_insert = mysqli_query($con, $sql);
			}
		}
		
	}
}


if($q_insert === TRUE){
	echo("berhasil");
}else{
	echo("Proses tambah data Gagal, Silahkan hubungi Kepala Toko / Pihak RimsMedia. Terima Kasih");
}
?>