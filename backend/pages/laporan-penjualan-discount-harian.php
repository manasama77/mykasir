<?php
include("../../config.php");
include("lib/function_base.php");
$tanggal_harian = $_REQUEST['tanggal_harian'];
$q_penjualan = mysqli_query($con, "SELECT
tbl_list_penjualan_event.id_list_penjualan_event,
tbl_list_penjualan_event.id_list_penjualan,
tbl_list_penjualan_event.id_event,
tbl_list_penjualan_event.nama_event,
tbl_list_penjualan_event.tipe,
tbl_list_penjualan_event.kode_penjualan,
tbl_list_penjualan_event.id_produk,
tbl_list_penjualan_event.nama_produk,
tbl_list_penjualan_event.satuan,
tbl_list_penjualan_event.qty,
tbl_list_penjualan_event.hpj,
tbl_list_penjualan_event.discount,
tbl_list_penjualan_event.discount_rp,
tbl_list_penjualan_event.harga_jual_nett,
tbl_list_penjualan_event.total_harga,
tbl_list_penjualan_event.`status`,
tbl_list_penjualan_event.id_create,
tbl_list_penjualan_event.date_create,
tbl_list_penjualan_event.jenis_pelanggan,
tbl_list_penjualan_event.kode_member,
tbl_list_penjualan_event.nama_member,
tbl_list_penjualan_event.qty_minimal_pembelian,
tbl_list_penjualan_event.id_produk_gratis,
tbl_list_penjualan_event.qty_gratis,
tbl_list_penjualan_event.akumulasi
FROM
tbl_list_penjualan_event
WHERE DATE(tbl_list_penjualan_event.date_create) = '$tanggal_harian'");

$q_sum_penjualan = mysqli_query($con, "SELECT SUM(lpe.total_harga) AS sum_grand_total FROM tbl_list_penjualan_event AS lpe WHERE DATE(lpe.date_create) = '$tanggal_harian'");
$data_sum_penjualan = mysqli_fetch_assoc($q_sum_penjualan);
$sum_grand_total = $data_sum_penjualan['sum_grand_total'];
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Application for UD Mandiri Cahaya Abadi">
	<meta name="author" content="RIMSMEDIA">
    <title>UD Mandiri Cahaya Abadi - Laporan Penjualan Discount <?=$tanggal_harian;?></title>
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
<!--body onLoad="window.print(); window.close();"-->
<body>
		<div class="row">
			<div class="col-lg-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th colspan="9">
									<h4 class="header">Laporan Daftar Transaksi Penjualan Discount</h4>
									<?= $head_alamat; ?>
								</th>
							</tr>
							<tr>
								<th style="text-align:center;" colspan="9">
									<font size="3">Periode Transaksi <?=$tanggal_harian;?></font>
								</th>
							</tr>
						</thead>
						<tbody>
						<font size="2">
							<tr>
								<th style="text-align:center;">Kode Transaksi</th>
								<th style="text-align:center;">Jenis Pelanggan</th>
								<th style="text-align:center;">Nama Produk</th>
								<th style="text-align:center;">Qty</th>
								<th style="text-align:center;">Harga Jual</th>
								<th style="text-align:center;">Discount (%)</th>
								<th style="text-align:center;">Discount (Rp)</th>
								<th style="text-align:center;">Tanggal</th>
								<th style="text-align:right;">Total Penjualan</th>
							</tr>
						<?php
						$row_penjualan = mysqli_num_rows($q_penjualan);
						while($data_penjualan = mysqli_fetch_assoc($q_penjualan)){
							$tipe = $data_penjualan['tipe'];
							if($tipe == 1){
								$nama_tipe = "Discount";
							}elseif($tipe == 2){
								$nama_tipe = "Potongan Harga";
							}elseif($tipe == 3){
								$nama_tipe = "Free Product";
							}elseif($tipe == 4){
								$nama_tipe = "Special Price";
							}
						?>
							<tr>
								<td style="text-align:center;"><?=$data_penjualan['kode_penjualan'];?></td>
								<td style="text-align:center;"><?=strtoupper($data_penjualan['jenis_pelanggan']);?></td>
								<td style="text-align:center;"><?=$data_penjualan['nama_produk'];?> (<?=$nama_tipe;?>)</td>
								<td style="text-align:center;"><?=number_format($data_penjualan['qty'],2);?> <?=$data_penjualan['satuan'];?></td>
								<td style="text-align:center;"><?=number_format($data_penjualan['hpj'],2);?></td>
								<td style="text-align:center;"><?=number_format($data_penjualan['discount'],2);?></td>
								<td style="text-align:center;"><?=number_format($data_penjualan['discount_rp'],2);?></td>
								<td style="text-align:center;"><?=$data_penjualan['date_create'];?></td>
								<td style="text-align:right;"><?=number_format($data_penjualan['total_harga'],2);?></td>
							</tr>
						<?php
						}
						?>
						</font>
						</tbody>
						<tfoot style="font-size:12px;">
							<tr>
								<th style="text-align:left;" colspan="2">Jumlah Transaksi <?=$row_penjualan;?></th>
								<th colspan="6" style="text-align:right;">Total Penjualan</th>
								<th style="text-align:right;"><?=number_format($sum_grand_total,2);?></th>
							</tr>
						</tfoot>
					</table>
			</div>
		</div>
</body>
</html>