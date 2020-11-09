<?php
include("../../config.php");
include("lib/function_base.php");
$tanggal_harian = $_REQUEST['tanggal_harian'];
$q_penjualan = mysqli_query($con, "SELECT
penjualan.kode_penjualan,
penjualan.jenis_pelanggan,
tbl_produk.nama_produk,
penjualan.qty,
tbl_satuan_produk.nama AS satuan,
penjualan.hpj,
penjualan.discount,
penjualan.discount_rp,
penjualan.date_create,
penjualan.total_harga
FROM tbl_list_penjualan_hutang AS penjualan
LEFT JOIN tbl_penjualan_hutang AS master_hutang ON master_hutang.kode_penjualan = penjualan.kode_penjualan
LEFT JOIN tbl_produk ON tbl_produk.id_produk = penjualan.id_produk
LEFT JOIN tbl_satuan_produk ON tbl_produk.id_satuan_produk = tbl_satuan_produk.id_satuan_produk
WHERE DATE(penjualan.date_create) = '$tanggal_harian'
AND master_hutang.status = 'hutang'");

$q_sum_penjualan = mysqli_query($con, "SELECT SUM(penjualan.total_harga) AS sum_grand_total FROM tbl_list_penjualan_hutang AS penjualan
LEFT JOIN tbl_penjualan_hutang AS master_hutang ON master_hutang.kode_penjualan = penjualan.kode_penjualan
WHERE DATE(penjualan.date_create) = '$tanggal_harian' AND master_hutang.status = 'hutang'");
$data_sum_penjualan = mysqli_fetch_assoc($q_sum_penjualan);
$sum_grand_total = $data_sum_penjualan['sum_grand_total'];
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Application for Toko Ananda">
	<meta name="author" content="RIMSMEDIA">
    <title>UD Mandiri Cahaya Abadi - Laporan Penjualan Hutang <?=$tanggal_harian;?></title>
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
									<h4 class="header">Laporan Daftar Transaksi Penjualan Hutang</h4>
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
								<th style="text-align:left;">Nama Produk</th>
								<th style="text-align:right;">Qty</th>
								<th style="text-align:right;">Harga Jual</th>
								<th style="text-align:right;">Discount (%)</th>
								<th style="text-align:right;">Discount (Rp)</th>
								<th style="text-align:center;">Tanggal</th>
								<th style="text-align:right;">Total Penjualan</th>
							</tr>
						<?php
						$row_penjualan = mysqli_num_rows($q_penjualan);
						while($data_penjualan = mysqli_fetch_assoc($q_penjualan)){
						?>
							<tr>
								<td style="text-align:center;"><?=$data_penjualan['kode_penjualan'];?></td>
								<td style="text-align:center;"><?=strtoupper($data_penjualan['jenis_pelanggan']);?></td>
								<td style="text-align:left;"><?=$data_penjualan['nama_produk'];?></td>
								<td style="text-align:right;"><?=number_format($data_penjualan['qty'],2);?></td>
								<td style="text-align:right;"><?=number_format($data_penjualan['hpj'],2);?></td>
								<td style="text-align:right;"><?=number_format($data_penjualan['discount'],2);?></td>
								<td style="text-align:right;"><?=number_format($data_penjualan['discount_rp'],2);?></td>
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
								<th style="text-align:right;" colspan="6">Total Penjualan</th>
								<th style="text-align:right;"><?=number_format($sum_grand_total,2);?></th>
							</tr>
						</tfoot>
					</table>
			</div>
		</div>
</body>
</html>