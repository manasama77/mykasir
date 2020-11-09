<?php
include("../../config.php");
include("lib/function_base.php");
$bulan = $_REQUEST['bulan'];
$q_pembelian = mysqli_query($con, "SELECT
*
FROM tbl_pembelian AS pembelian
LEFT JOIN tbl_vendor AS vendor ON vendor.id_vendor = pembelian.id_vendor
WHERE MONTH(pembelian.tanggal_order) = '$bulan'
GROUP BY pembelian.id_vendor");
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Application for Toko Ananda">
	<meta name="author" content="RIMSMEDIA">
    <title>UD Mandiri Cahaya Abadi - Laporan Pembelian <?=bulan_indo($bulan);?></title>
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
								<th colspan="7">
									<h4 class="header">Laporan Daftar Transaksi Pembelian</h4>
									<?= $head_alamat; ?>
								</th>
							</tr>
							<tr>
								<th style="text-align:center;" colspan="7">
									<font size="3">Periode Transaksi <?=bulan_indo($bulan);?></font>
								</th>
							</tr>
						</thead>
						<tbody>
						<font size="2">
							<tr>
								<th style="text-align:center;">Kode Pembelian</th>
								<th style="text-align:center;">Kode Supplier</th>
								<th style="text-align:center;">Supplier</th>
								<th style="text-align:center;">Tgl. Transaksi</th>
								<th style="text-align:center;">Status</th>
								<th style="text-align:right;">Total Pembelian</th>
							</tr>
						<?php
						$row_pembelian = mysqli_num_rows($q_pembelian);
						$sum_grand_total = "0";
						while($data_pembelian = mysqli_fetch_assoc($q_pembelian)){
							$sum_grand_total += $data_pembelian['grand_total'];
						?>
							<tr>
								<td style="text-align:center;"><?=$data_pembelian['kode_pembelian'];?></td>
								<td style="text-align:center;"><?=$data_pembelian['kode_vendor'];?></td>
								<td style="text-align:center;"><?=$data_pembelian['nama_perusahaan'];?></td>
								<td style="text-align:center;"><?=$data_pembelian['tanggal_order'];?></td>
								<td style="text-align:center;">Pembelian</td>
								<td style="text-align:right;"><?=number_format($data_pembelian['grand_total'],2);?></td>
							</tr>
						<?php
						}
						?>
						</font>
						</tbody>
						<tfoot style="font-size:12px;">
							<tr>
								<th style="text-align:left;" colspan="4">Jumlah Transaksi <?=$row_pembelian;?></th>
								<th style="text-align:right;">Total Pembelian</th>
								<th style="text-align:right;"><?=number_format($sum_grand_total,2);?></th>
							</tr>
						</tfoot>
					</table>
			</div>
		</div>
</body>
</html>