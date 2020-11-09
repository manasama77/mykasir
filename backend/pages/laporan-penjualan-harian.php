<?php
include("../../config.php");
$tanggal_harian = $_REQUEST['tanggal_harian'];
$q_penjualan = mysqli_query($con, "(SELECT
penjualan.kode_penjualan,
penjualan.jenis_pelanggan,
penjualan.create_date,
penjualan.grand_total
FROM tbl_penjualan AS penjualan
WHERE DATE(penjualan.create_date) = '$tanggal_harian')
UNION
(SELECT
penjualan2.kode_penjualan,
penjualan2.jenis_pelanggan,
penjualan2.create_date,
penjualan2.grand_total
FROM tbl_penjualan_hutang AS penjualan2
WHERE DATE(penjualan2.create_date) = '$tanggal_harian'
AND penjualan2.status = 'lunas')");

$q_sum_penjualan = mysqli_query($con, "SELECT SUM(sum_grand_total) AS sum_grand_total
FROM
(
(SELECT SUM(penjualan .grand_total) AS sum_grand_total FROM tbl_penjualan AS penjualan WHERE DATE(penjualan.create_date) = '$tanggal_harian')
UNION ALL
(SELECT SUM(penjualan2.grand_total) AS sum_grand_total FROM tbl_penjualan_hutang AS penjualan2 WHERE DATE(penjualan2.create_date) = '$tanggal_harian' AND penjualan2.status = 'lunas')
) AS t1
");
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
    <title>UD Mandiri Cahaya Abadi - Laporan Penjualan <?=$tanggal_harian;?></title>
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
<!--body onLoad="window.print();window.close();"-->
<body>
		<div class="row">
			<div class="col-lg-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th colspan="4">
									<h4 class="header">Laporan Daftar Transaksi Penjualan</h4>
									<?= $head_alamat; ?>
								</th>
							</tr>
							<tr>
								<th style="text-align:center;" colspan="4">
									<font size="3">Periode Transaksi <?=$tanggal_harian;?></font>
								</th>
							</tr>
						</thead>
						<tbody>
						<font size="2">
							<tr>
								<th style="text-align:center;">Kode Transaksi</th>
								<th style="text-align:center;">Jenis Pelanggan</th>
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
								<td style="text-align:center;"><?=$data_penjualan['create_date'];?></td>
								<td style="text-align:right;"><?=number_format($data_penjualan['grand_total'],2);?></td>
							</tr>
						<?php
						}
						?>
						</font>
						</tbody>
						<tfoot style="font-size:12px;">
							<tr>
								<th style="text-align:left;" colspan="2">Jumlah Transaksi <?=$row_penjualan;?></th>
								<th style="text-align:right;">Total Penjualan</th>
								<th style="text-align:right;"><?=number_format($sum_grand_total,2);?></th>
							</tr>
						</tfoot>
					</table>
			</div>
		</div>
</body>
</html>