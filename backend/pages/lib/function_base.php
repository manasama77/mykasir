<?php
function count_produk(){
	include("../../config.php");
	$q_count_produk = mysqli_query($con, "SELECT Count(tbl_produk.id_produk) AS jumlah_produk FROM tbl_produk");
	$fa_q_count_produk = mysqli_fetch_array($q_count_produk);
	$jumlah_produk = $fa_q_count_produk['jumlah_produk'];
	return $jumlah_produk;
}

function count_penjualan(){
	include("../../config.php");
	$current_date = date('Y-m-d');
	$q_count_penjualan = mysqli_query($con, "SELECT Count(tbl_penjualan.id_penjualan) AS jumlah_penjualan FROM tbl_penjualan WHERE DATE(create_date) = '$current_date'");
	$data_count_penjualan = mysqli_fetch_array($q_count_penjualan);
	$jumlah_penjualan = $data_count_penjualan['jumlah_penjualan'];
	return $jumlah_penjualan;
}

function count_member(){
	include("../../config.php");
	$current_date = date("Y-m-d");
	$q_count_member = mysqli_query($con, "SELECT Count(tbl_member.id_member) AS jumlah_member FROM tbl_member WHERE tbl_member.date_expired <= '$current_date'");
	$fa_q_count_member = mysqli_fetch_array($q_count_member);
	$jumlah_member = $fa_q_count_member['jumlah_member'];
	return $jumlah_member;
}

function count_vendor(){
	include("../../config.php");
	$q_count_vendor = mysqli_query($con, "SELECT Count(tbl_vendor.id_vendor) AS jumlah_vendor FROM tbl_vendor");
	$fa_q_count_vendor = mysqli_fetch_array($q_count_vendor);
	$jumlah_vendor = $fa_q_count_vendor['jumlah_vendor'];
	return $jumlah_vendor;
}

function bulan_indo($bulan){
	if($bulan == 1){
		$nama_bulan = "Januari";
	}elseif($bulan == 2){
		$nama_bulan = "Febuari";
	}elseif($bulan == 3){
		$nama_bulan = "Maret";
	}elseif($bulan == 4){
		$nama_bulan = "April";
	}elseif($bulan == 5){
		$nama_bulan = "Mei";
	}elseif($bulan == 6){
		$nama_bulan = "Juni";
	}elseif($bulan == 7){
		$nama_bulan = "Juli";
	}elseif($bulan == 8){
		$nama_bulan = "Agustus";
	}elseif($bulan == 9){
		$nama_bulan = "September";
	}elseif($bulan == 10){
		$nama_bulan = "Oktober";
	}elseif($bulan == 11){
		$nama_bulan = "November";
	}elseif($bulan == 12){
		$nama_bulan = "Desember";
	}
	return $nama_bulan;
}
?>