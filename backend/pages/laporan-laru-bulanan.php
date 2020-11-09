<?php
include("../../config.php");
include("lib/function_base.php");
$bulan = $_REQUEST['bulan'];
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
WHERE MONTH(lp.date_create) = '$bulan'
GROUP BY lp.nama_produk");
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Application for Toko Ananda">
	<meta name="author" content="RIMSMEDIA">
    <title>UD Mandiri Cahaya Abadi - Laporan Laba Rugi Penjualan <?=$bulan;?></title>
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
<!-- <!--body onLoad="window.print(); window.close();"-->
<body> -->
<body>
		<div class="row">
			<div class="col-lg-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th colspan="8">
									<h4 class="header">Laporan Laba Rugi Penjualan</h4>
									<?= $head_alamat; ?>
								</th>
							</tr>
							<tr>
								<th style="text-align:center;" colspan="8">
									<font size="3">Periode Transaksi <?=bulan_indo($bulan);?></font>
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
						$row_penjualan = mysqli_num_rows($q_penjualan);
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
								<th style="text-align:right;" colspan="7"><h4>Laba / Rugi</h4></th>
								<th style="text-align:right;"><h4><?=number_format($sum_keuntungan,2);?></h4></th>
							</tr>
						</tfoot>
					</table>
			</div>
		</div>
</body>
</html>