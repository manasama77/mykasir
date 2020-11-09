<?php
include("../../config.php");
include("lib/function_base.php");
$tanggal_awal = $_REQUEST['tanggal_awal'];
$tanggal_akhir = $_REQUEST['tanggal_akhir'];

// normal
$q_penjualan = mysqli_query($con, "SELECT
	p.kode_produk,
	lp.nama_produk,
	lp.satuan,
	SUM(lp.qty) AS qty,
	SUM(lp.total_harga) / SUM(lp.qty) AS harga_satuan,
	SUM(lp.total_harga) AS total_jual,
	(p.hpp * SUM(lp.qty)) AS total_pokok,
	(SUM(lp.total_harga) - (p.hpp * SUM(lp.qty))) AS keuntungan
	FROM

	tbl_list_penjualan lp
	LEFT JOIN tbl_produk p ON p.id_produk = lp.id_produk
	WHERE DATE(lp.date_create) >= '$tanggal_awal' AND DATE(lp.date_create) <= '$tanggal_akhir'
	GROUP BY lp.nama_produk");

$q_sum_penjualan_discount = mysqli_query($con, "SELECT SUM(discount_rp) AS sum_discount FROM tbl_penjualan WHERE DATE(tbl_penjualan.create_date) >= '$tanggal_awal' AND DATE(tbl_penjualan.create_date) <= '$tanggal_akhir'");

$q_sum_penjualan_discount = mysqli_fetch_assoc($q_sum_penjualan_discount);
$sum_discount = $q_sum_penjualan_discount['sum_discount'];

// hutang
$q_penjualan_h = mysqli_query($con, "SELECT
	p.kode_produk,
	lp.nama_produk,
	lp.satuan,
	SUM(lp.qty) AS qty,
	SUM(lp.total_harga) / SUM(lp.qty) AS harga_satuan,
	SUM(lp.total_harga) AS total_jual,
	(p.hpp * SUM(lp.qty)) AS total_pokok,
	(SUM(lp.total_harga) - (p.hpp * SUM(lp.qty))) AS keuntungan
	FROM

	tbl_list_penjualan_hutang lp
	LEFT JOIN tbl_produk p ON p.id_produk = lp.id_produk
	WHERE DATE(lp.date_create) >= '$tanggal_awal' AND DATE(lp.date_create) <= '$tanggal_akhir'
	GROUP BY lp.nama_produk");

$q_sum_penjualan_discount_h = mysqli_query($con, "SELECT SUM(discount_rp) AS sum_discount FROM tbl_penjualan WHERE DATE(tbl_penjualan.create_date) >= '$tanggal_awal' AND DATE(tbl_penjualan.create_date) <= '$tanggal_akhir'");

$q_sum_penjualan_discount_h = mysqli_fetch_assoc($q_sum_penjualan_discount_h);
$sum_discount_h = $q_sum_penjualan_discount_h['sum_discount'];
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Application for UD Mandiri Cahaya Abadi">
	<meta name="author" content="RIMSMEDIA">
	<title>UD Mandiri Cahaya Abadi - Laporan Laba Rugi Penjualan <?=$tanggal_awal;?> s/d <?=$tanggal_akhir;?></title>
	<script src="../vendor/jquery/jquery.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../vendor/jqueryui/jquery-ui.min.js"></script>
	<link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<style>
	/*.table { border: 1px solid #2980B9; }
	.table thead > tr > th, .table tbody > tr > th, .table tfoot > tr > th, .table thead > tr > td, .table tbody > tr > td, .table tfoot > tr > td { border: 1px solid #2980B9; }
	.table thead > tr > th { border-top: none; }*/
	/*.table tbody > tr > th, .table tbody > tr > td { border: 1px solid #ccc; font-size: 12px; }
	.table thead > tr > th { border-top: none; }*/
	
	table tbody > tr > th, table tbody > tr > td { font-size:10px; }
	
	@media print {
		thead {display: table-header-group;}
		tfoot {display: table-footer-group;}
		table tbody > tr > th, table tbody > tr > td { font-size:10px; }
	}
	
	@page {
		size: A4;
		margin: 10mm 10mm 10mm 10mm;
	}
</style>
</head>
<body>
	<div class="row">
		<div class="col-lg-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th colspan="8">
							<h4 class="header">Laporan Laba Rugi Penjualan</h4>
							<h5 class="header">
								UD Mandiri Cahaya Abadi<br>Jl. <br>
								<b>Telp:</b> 0857  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Fax:</b> -
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<b>Tanggal Cetak:</b> <?=date('Y-m-d');?>
							</h5>
						</th>
					</tr>
					<tr>
						<th style="text-align:center;" colspan="8">
							<font size="3">Periode Transaksi <?=$tanggal_awal;?> s/d <?=$tanggal_akhir;?></font>
						</th>
					</tr>
				</thead>
				<tbody>
					<font size="2">
						<tr>
							<th style="text-align:center;">Kode</th>
							<th style="text-align:left;">Produk</th>
							<th style="text-align:right;">Qty</th>
							<th style="text-align:center;">Satuan</th>
							<th style="text-align:center;">Harga Satuan</th>
							<th style="text-align:right;">Total Jual</th>
							<th style="text-align:right; color:green;">Total Pokok</th>
							<th style="text-align:right; color:blue;">Keuntungan</th>
						</tr>
						<?php
						$sum_total_jual = 0;
						$sum_total_pokok = 0;
						$sum_keuntungan = 0;
						$sum_total_jual_h = 0;
						$sum_total_pokok_h = 0;
						$sum_keuntungan_h = 0;
						$row_penjualan = mysqli_num_rows($q_penjualan);
						//normal
						while($data_penjualan = mysqli_fetch_assoc($q_penjualan)){
							?>
							<tr>
								<td style="text-align:center;"><?=$data_penjualan['kode_produk'];?></td>
								<td style="text-align:left;"><?=$data_penjualan['nama_produk'];?></td>
								<td style="text-align:right;"><?=$data_penjualan['qty'];?></td>
								<td style="text-align:center;"><?=strtoupper($data_penjualan['satuan']);?></td>
								<td style="text-align:right;"><?=number_format($data_penjualan['harga_satuan'],2);?></td>
								<td style="text-align:right;"><?=number_format($data_penjualan['total_jual'],2);?></td>
								<td style="text-align:right; color:green;"><?=number_format($data_penjualan['total_pokok'],2);?></td>
								<td style="text-align:right; color:blue;"><?=number_format($data_penjualan['keuntungan'],2);?></td>
							</tr>
							<?php
							$sum_total_jual += $data_penjualan['total_jual'];
							$sum_total_pokok += $data_penjualan['total_pokok'];
							$sum_keuntungan += $data_penjualan['keuntungan'];
						}


						//normal
						while($data_penjualan_h = mysqli_fetch_assoc($q_penjualan_h)){
							?>
							<tr>
								<td style="text-align:center;"><?=$data_penjualan_h['kode_produk'];?></td>
								<td style="text-align:left;"><?=$data_penjualan_h['nama_produk'];?></td>
								<td style="text-align:right;"><?=$data_penjualan_h['qty'];?></td>
								<td style="text-align:center;"><?=strtoupper($data_penjualan_h['satuan']);?></td>
								<td style="text-align:right;"><?=number_format($data_penjualan_h['harga_satuan'],2);?></td>
								<td style="text-align:right;"><?=number_format($data_penjualan_h['total_jual'],2);?></td>
								<td style="text-align:right; color:green;"><?=number_format($data_penjualan_h['total_pokok'],2);?></td>
								<td style="text-align:right; color:blue;"><?=number_format($data_penjualan_h['keuntungan'],2);?></td>
							</tr>
							<?php
							$sum_total_jual_h += $data_penjualan_h['total_jual'];
							$sum_total_pokok_h += $data_penjualan_h['total_pokok'];
							$sum_keuntungan_h += $data_penjualan_h['keuntungan'];
						}

						$laru=$sum_keuntungan-$sum_discount; //laba/rugi
						?>
					</font>
				</tbody>
				<tfoot style="font-size:12px;">
					<tr>
						<th style="text-align:left;" colspan="5">Jumlah Transaksi <?=$row_penjualan;?></th>
						<th style="text-align:right;"><?=number_format($sum_total_jual,2);?></th>
						<th style="text-align:right; color:green;"><?=number_format($sum_total_pokok,2);?></th>
						<th style="text-align:right; color:blue;"><?=number_format($sum_keuntungan,2);?></th>
					</tr>
					<tr>
						<th style="text-align:right;" colspan="7"><h4>Total Margin</h4></th>
						<th style="text-align:right;"><h4><?=number_format($sum_keuntungan,2);?></h4></th>
					</tr>
					<tr>
						<th style="text-align:right;" colspan="7"><h4>Total Discont</h4></th>
						<th style="text-align:right;"><h4><?=number_format($sum_discount,2);?></h4></th>
					</tr>
					<tr>
						<th style="text-align:right;" colspan="7"><h4>Laba/Rugi</h4></th>
						<th style="text-align:right;"><h4><?=number_format($laru,2);?></h4></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</body>
</html>