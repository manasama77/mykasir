<?php
include("../../config.php");
include("lib/function_base.php");
$tanggal_awal = $_REQUEST['tanggal_awal'];
$tanggal_akhir = $_REQUEST['tanggal_akhir'];
$q_penjualan = mysqli_query($con, "
SELECT 
tbl_penjualan_hutang.kode_penjualan,
tbl_penjualan_hutang.grand_total,
tbl_penjualan_hutang.pembayaran,
tbl_penjualan_hutang.kembalian,
tbl_penjualan_hutang.catatan,
tbl_penjualan_hutang.status,
tbl_penjualan_hutang.jenis_pelanggan,
tbl_penjualan_hutang.kode_member,
tbl_penjualan_hutang.create_date,
tbl_member.nama_member

FROM tbl_penjualan_hutang 
LEFT JOIN tbl_member ON tbl_penjualan_hutang.kode_member=tbl_member.kode_member
WHERE DATE(create_date) >= '$tanggal_awal' AND DATE(create_date) <= '$tanggal_akhir'
AND status = 'hutang'");

/*$q_sum_hutang = mysqli_query($con, "SELECT SUM(grand_total) as total_hutang from tbl_penjualan_hutang 
WHERE DATE(tbl_penjualan_hutang.date_create) >= '$tanggal_awal' AND DATE(tbl_penjualan_hutang.date_create) <= '$tanggal_akhir' AND tbl_penjualan_hutang.status = 'hutang'");
$data_hutang = mysqli_fetch_assoc($q_sum_hutang);
$sum_grand_total = $data_hutang['total_hutang'];*/

?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Application for UD Mandiri Cahaya Abadi">
	<meta name="author" content="RIMSMEDIA">
    <title>UD Mandiri Cahaya Abadi - Laporan Bon Penjualan Hutang <?=$tanggal_awal;?> s/d <?=$tanggal_akhir;?></title>
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
<!--body-->
		<div class="row">
			<div class="col-lg-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th colspan="10">
									<h4 class="header">Laporan Bon Penjualan Hutang</h4>
									<h5 class="header">
										UD Mandiri Cahaya Abadi<br>-<br>
										<b>Telp:</b> - &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Fax:</b> -
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
								<th style="text-align:center;" colspan="10">
									<font size="3">Periode Transaksi <?=$tanggal_awal;?> s/d <?=$tanggal_akhir;?></font>
								</th>
							</tr>
						</thead>
						<tbody>
						<font size="2">
							<tr>
								<th style="text-align:center;">Kode Transaksi</th>
								<th style="text-align:center;">Tanggal</th>
								<th style="text-align:center;">Jenis & Kode Pelanggan</th>
								<th style="text-align:center;">Nama Pelanggan</th>
								<th style="text-align:left;">Jumlah Piutang</th>
								<th style="text-align:right;">Jumlah Pembayaran/DP</th>
								<th style="text-align:right;">Sisa Piutang</th>
								<th style="text-align:right;">Catatan</th>
								
								
							</tr>
						<?php
						$row_penjualan = mysqli_num_rows($q_penjualan);
						if($row_penjualan>0){
						while($data_penjualan = mysqli_fetch_array($q_penjualan)){

							$sisa_piutang=$data_penjualan['grand_total']-$data_penjualan['pembayaran'];
							
							$grand_total[] = $data_penjualan['grand_total'];
							$pembayaran[] = $data_penjualan['pembayaran'];
							//$sisa_piutang[] = $sisa_piutang;

						?>
						<tr>
								<td style="text-align:center;"><?php echo $data_penjualan['kode_penjualan']; ?></td>
								<td style="text-align:center;"><?php echo $data_penjualan['create_date']; ?></td>
								<td style="text-align:center;"><?=$data_penjualan['jenis_pelanggan']; ?> | <?=$data_penjualan['kode_member']; ?></td>
								<td style="text-align:left;"><?=$data_penjualan['nama_member']; ?></td>
								<td style="text-align:right;"><?=number_format($data_penjualan['grand_total'],2,",","."); ?></td>
								<td style="text-align:right;"><?=number_format($data_penjualan['pembayaran'],2,",","."); ?></td>
								<td style="text-align:right;"><?=number_format($sisa_piutang,2,",","."); ?></td>
								<td style="text-align:center;"><?php echo $data_penjualan['catatan']; ?></td>
							
							</tr>
						<?php
						}
						?>
						</font>
						</tbody>
						<tfoot style="font-size:12px;">
							<tr>
								<th style="text-align:left;" colspan="2">Jumlah Transaksi <?=$row_penjualan;?></th>
								<th style="text-align:right;" colspan="2">Total Penjualan</th>
								<th style="text-align:right;"><?php echo number_format(array_sum($grand_total),2,",","."); ?></th>
								<th style="text-align:right;"><?php echo number_format(array_sum($pembayaran),2,",","."); ?></th>
								<?php 
									$ay=array_sum($grand_total);
									$ax=array_sum($pembayaran);
									$total_sisa_piutang=$ay-$ax;

								?>
								<th style="text-align:right;"><?php echo number_format($total_sisa_piutang,2,",","."); ?></th>
								<th style="text-align:right;"></th>
							</tr>
						</tfoot>
					</table>
				<?php } ?>
			</div>
		</div>
</body>
</html>