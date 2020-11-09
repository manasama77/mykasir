<?php
include("../../config.php");
$tanggal_awal = $_REQUEST['tanggal_awal'];
$tanggal_akhir = $_REQUEST['tanggal_akhir'];

//PENJUALAN
$q_penjualan = mysqli_query($con, "SELECT
	penjualan.kode_penjualan,
	penjualan.jenis_pelanggan,
	penjualan.create_date,
	penjualan.grand_total
	FROM tbl_penjualan AS penjualan
	WHERE DATE(penjualan.create_date) >= '$tanggal_awal' AND DATE(penjualan.create_date) <= '$tanggal_akhir'
	AND penjualan.status = 'lunas'");

$q_sum_penjualan = mysqli_query($con, "SELECT SUM(grand_total) AS sum_grand_total FROM tbl_penjualan WHERE DATE(tbl_penjualan.create_date) >= '$tanggal_awal' AND DATE(tbl_penjualan.create_date) <= '$tanggal_akhir'");

$data_sum_penjualan = mysqli_fetch_assoc($q_sum_penjualan);
$sum_grand_total = $data_sum_penjualan['sum_grand_total'];

//PENJUALAN POSTING
$q_sum_penjualan_posting = mysqli_query($con, "SELECT SUM(grand_total) AS sum_grand_total FROM tbl_penjualan WHERE DATE(tbl_penjualan.create_date) >= '$tanggal_awal' AND DATE(tbl_penjualan.create_date) <= '$tanggal_akhir' AND post=0");

$data_sum_penjualan_posting = mysqli_fetch_assoc($q_sum_penjualan_posting);
$sum_grand_total_posting = $data_sum_penjualan_posting['sum_grand_total'];

//pembayaran piutang
$q_piutang = mysqli_query($con, "SELECT tpp.kode_penjualan, tpp.tgl_pembayaran, tpp.post, tm.nama_member,
	SUM(bayar) as total_bayar
	FROM tbl_pembayaran_penjualan tpp
	LEFT JOIN tbl_member tm ON tm.kode_member=tpp.kode_member
	WHERE DATE(tpp.tgl_pembayaran) >= '$tanggal_awal' AND DATE(tpp.tgl_pembayaran) <= '$tanggal_akhir'
	GROUP BY tpp.kode_penjualan ");
$row_piutang = mysqli_num_rows($q_piutang);

$q_sum_piutang=mysqli_query($con, "SELECT SUM(bayar) AS bayar 
	FROM tbl_pembayaran_penjualan tpp 
	WHERE DATE(tpp.tgl_pembayaran) >= '$tanggal_awal' AND DATE(tpp.tgl_pembayaran) <= '$tanggal_akhir'");
$data_sum_piutang=mysqli_fetch_assoc($q_sum_piutang);
$sum_piutang=$data_sum_piutang['bayar'];

//SUM POSTING
$q_sum_piutang_posting=mysqli_query($con, "SELECT SUM(bayar) AS bayar 
	FROM tbl_pembayaran_penjualan tpp 
	WHERE DATE(tpp.tgl_pembayaran) >= '$tanggal_awal' AND DATE(tpp.tgl_pembayaran) <= '$tanggal_akhir'
	AND tpp.post = 0");
$data_sum_piutang_posting=mysqli_fetch_assoc($q_sum_piutang_posting);
$sum_piutang_posting=$data_sum_piutang_posting['bayar'];
?>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Application for UD Mandiri Cahaya Abadi">
	<meta name="author" content="RIMSMEDIA">
	<title>UD Mandiri Cahaya Abadi - Laporan Penjualan <?=$tanggal_awal;?> s/d <?=$tanggal_akhir;?></title>
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
						<th style="text-align:left;" colspan="2">Jumlah Transaksi : <?php echo $trx=$row_penjualan+$row_piutang; ?></th>
						<th style="text-align:right;">Total. </th>
						<th style="text-align:right;"><?php $ttl = $sum_grand_total+$sum_piutang; echo number_format($ttl,2); ?></th>
					</tr>
				</tfoot>



				<tr>
					<th style="text-align:left;">Jumlah Transaksi Penjualan : <?=$row_penjualan;?></th>
					<th style="text-align:right;" colspan="2">Total Penjualan.</th>
					<th style="text-align:left;">Rp.<?=number_format($sum_grand_total,2);?></th>
				</tr>
				<?php
				if($row_piutang>0){
				while($data_piutang = mysqli_fetch_assoc($q_piutang)){
					?>
					<tr>
						<td style="text-align:center;"><?=$data_piutang['kode_penjualan'];?></td>
						<td style="text-align:center;">Member | <?=$data_piutang['nama_member'];?></td>
						<td style="text-align:center;"><?=$data_piutang['tgl_pembayaran'];?></td>
						<td style="text-align:right;"><?=number_format($data_piutang['total_bayar'],2);?></td>
					</tr>
					<?php
				}}
				?>

				<tr>
					<th style="text-align:left;">Jumlah Transaksi Piutang : <?=$row_piutang;?></th>
					<th style="text-align:right;" colspan="2">Total Pembayaran Piutang</th>
					<th style="text-align:left;">Rp.<?=number_format($sum_piutang,2);?></th>
				</tr>
			</tbody>
			<thead>
				<tr>
					<th colspan="3">
						<h4 class="header">Laporan Daftar Transaksi Penjualan</h4>
						<?= $head_alamat; ?>
					</th>

					<th>
						<h4 class="header">POSTING LAPORAN PENJUALAN</h4>
						<h5 class="header">Jumlah Transaksi Belum Posting:<b><?php $ttl_p = $sum_grand_total_posting+$sum_piutang_posting; 
						echo number_format($ttl_p,2); ?></b></h5>
						<form name="penjualan" method="post" action="all_posting.php">
							<input name="posting" type="submit" value="posting" onclick="myFunction()">
							<input type="hidden" name="nominal" value="<?php echo $ttl_p; ?>">
							<input type="hidden" name="kredit" value="10001">
							<input type="hidden" name="ket" value="POSTING DARI KAS">
							<input type="hidden" name="tgl_posting" value="<?=date('Y-m-d');?>">
							<input type="hidden" name="param" value="1">

							<input type="hidden" name="tanggal_awal" value="<?=$tanggal_awal;?>">
							<input type="hidden" name="tanggal_akhir" value="<?=$tanggal_akhir;?>">
						</form>

					</th>
				</tr>
				<tr>
					<th style="text-align:center;" colspan="4">
						<font size="3">Periode Transaksi <?=$tanggal_awal;?> s/d <?=$tanggal_akhir;?></font>
					</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
</body>
</html>

<script type="text/javascript">

</script>