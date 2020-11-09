<?php
include("../../config.php");
$tanggal_harian = $_REQUEST['tanggal_harian'];
$id_supplier_harian = $_REQUEST['id_supplier_harian'];
$q_vendor = mysqli_query($con, "SELECT
vendor.nama_perusahaan,
pembelian.id_vendor
FROM tbl_vendor AS vendor
LEFT JOIN tbl_pembelian AS pembelian ON vendor.id_vendor = pembelian.id_vendor
WHERE pembelian.tanggal_order = '$tanggal_harian'
AND pembelian.status = '0'
AND pembelian.id_vendor = '$id_supplier_harian'
GROUP BY pembelian.id_vendor");
$row_vendor = mysqli_num_rows($q_vendor);
$sum_hutang = 0;
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Application for Toko Ananda">
	<meta name="author" content="RIMSMEDIA">
    <title>UD Mandiri Cahaya Abadi - Laporan Pembelian Hutang <?=$tanggal_harian;?></title>
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
<!--body-->
		<div class="row">
			<div class="col-lg-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th colspan="7">
									<h4 class="header">Laporan Daftar Transaksi Pembelian Hutang</h4>
									<?= $head_alamat; ?>
								</th>
							</tr>
							<tr>
								<th style="text-align:center;" colspan="7">
									<font size="3">Periode Transaksi <?=$tanggal_harian;?></font>
								</th>
							</tr>
						</thead>
						<tbody>
						<font size="2">
							<tr>
								<th style="text-align:center;">Kode Pembelian</th>
								<th style="text-align:center;">Supplier</th>
								<th style="text-align:center;">Tgl. Transaksi</th>
								<th style="text-align:center;">Tgl. Jatuh Tempo</th>
								<th style="text-align:right;">Total Pembelian</th>
								<th style="text-align:right;">Total Tunggakan</th>
								<th style="text-align:center;">Catatan</th>
							</tr>
						<?php
						if($row_vendor == 0){
							$row_pembelian = 0;
						?>
							<tr>
								<td style="text-align:center;">-</td>
								<td style="text-align:center;">-</td>
								<td style="text-align:center;">-</td>
								<td style="text-align:center;">-</td>
								<td style="text-align:center;">-</td>
								<td style="text-align:center;">-</td>
							</tr>
						<?php
						}else{
							while($data_vendor = mysqli_fetch_assoc($q_vendor)){
								$id_vendor = $data_vendor['id_vendor'];
								$q_pembelian = mysqli_query($con, "SELECT
								*
								FROM tbl_pembelian AS pembelian
								LEFT JOIN tbl_vendor AS vendor ON vendor.id_vendor = pembelian.id_vendor
								WHERE pembelian.id_vendor = '$id_vendor' AND pembelian.tanggal_order = '$tanggal_harian' AND pembelian.status = '0'");
								$row_pembelian = mysqli_num_rows($q_pembelian);
							?>
								<tr>
									<th colspan="7"><?=$data_vendor['nama_perusahaan'];?></th>
								</tr>
								<?php
								while($data_pembelian = mysqli_fetch_assoc($q_pembelian)){
									$sum_hutang += $data_pembelian['hutang'];
								?>
								<tr>
									<td style="text-align:center;"><?=$data_pembelian['kode_pembelian'];?></td>
									<td style="text-align:center;"><?=$data_pembelian['nama_perusahaan'];?></td>
									<td style="text-align:center;"><?=$data_pembelian['tanggal_order'];?></td>
									<td style="text-align:center;"><?=$data_pembelian['tanggal_jatuh_tempo'];?></td>
									<td style="text-align:right;"><?=number_format($data_pembelian['grand_total'],2);?></td>
									<td style="text-align:right;"><?=number_format($data_pembelian['hutang'],2);?></td>
									<td style="text-align:center;"><?=$data_pembelian['catatan'];?></td>
								</tr>
						<?php
								}
							}
						}
						?>
						</font>
						</tbody>
						<tfoot style="font-size:12px;">
							<tr>
								<th style="text-align:left;" colspan="4">Jumlah Transaksi <?=$row_pembelian;?></th>
								<th style="text-align:right;">Total Tunggakan</th>
								<th style="text-align:right;"><?=number_format($sum_hutang,2);?></th>
								<th></th>
							</tr>
						</tfoot>
					</table>
			</div>
		</div>
</body>
</html>