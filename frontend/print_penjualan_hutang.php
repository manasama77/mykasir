<?php
include("../config.php");
date_default_timezone_set('Asia/Jakarta');
$kode_penjualan = $_REQUEST['kode_penjualan'];
$status = $_REQUEST['status'];
if($status == 1){
	$status = "lunas";
}else{
	$status = "hutang";
}

$q_penjualan = mysqli_query($con, "SELECT
tbl_penjualan_hutang.id_penjualan_hutang,
tbl_penjualan_hutang.kode_penjualan,
tbl_penjualan_hutang.running_number,
tbl_penjualan_hutang.sub_total,
tbl_penjualan_hutang.grand_total,
tbl_penjualan_hutang.discount_persen,
tbl_penjualan_hutang.discount_rp,
tbl_penjualan_hutang.ppn,
tbl_penjualan_hutang.harga_ppn,
tbl_penjualan_hutang.pembayaran,
tbl_penjualan_hutang.kembalian,
tbl_penjualan_hutang.tanggal_pelunasan,
tbl_penjualan_hutang.tanggal_jatuh_tempo,
tbl_penjualan_hutang.catatan,
tbl_penjualan_hutang.`status`,
DATE_FORMAT(tbl_penjualan_hutang.create_date, '%e-%b-%Y %T') AS create_date,
tbl_user.nama
FROM
tbl_penjualan_hutang
LEFT JOIN tbl_user ON tbl_user.id_user = tbl_penjualan_hutang.id_create
WHERE tbl_penjualan_hutang.kode_penjualan = '$kode_penjualan'");
$data_penjualan = mysqli_fetch_assoc($q_penjualan);
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Application for Toko Ananda">
	<meta name="author" content="RIMSMEDIA">
    <title>Toko Ananda - Print Struk Penjualan</title>
	<script src="../vendor/jquery/jquery.min.js"></script>
	<link href="../backend/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../backend/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="../backend/vendor/jqueryui/jquery-ui.min.css" rel="stylesheet" >
	<!-- jQuery -->
	<script src="../backend/vendor/jquery/jquery.min.js"></script>
	<script src="../backend/vendor/jquery/jquery.number.js"></script>
	<script src="../backend/vendor/jqueryui/jquery-ui.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="../backend/vendor/bootstrap/js/bootstrap.min.js"></script>
	<style>
	table tbody > tr > th, table tbody > tr > td { font-size:12px; }
	.table {
		border-top:0px !important;
		border-bottom:0px !important;
	}
	.table th, .table td {
		border: 1px !important;
	}
	
	.fixed-table-container {
		border:0px !important;
	}
	
	@media print {
		@page {
			size: auto;
			margin: 1mm;
		}
		
		thead {display: table-header-group;}
		tfoot {display: table-footer-group;}
		table tbody > tr > th, table tbody > tr > td { font-size:10px; }
	}
	
	@page {
		size: auto;
		margin: 1mm;
	}
	</style>
</head>
<!--body onLoad="window.print(); window.close();"-->
<body>
		<div class="row">
			<div class="col-lg-12">
					<table class="table table-condensed">
						<thead>
							<tr>
								<th colspan="2">
									<h5 class="header">
										<b>UD Mandiri Cahaya Abadi</b><br>
										Jl. Raya Cibeber Leuwisadeng KM.03 Desa Leuwisadeng Kecamatan Leuwisadeng - Bogor<br>										
										<b>Telp:</b> 0251 8591 345 | <b>HP.</b> 0838 7307 5238 | <b>WA.</b> 0821 2525 9537</b><br><br>
										<b>No. Transaksi : <?=$data_penjualan['kode_penjualan'];?><br>
										Jatuh Tempo : <?=$data_penjualan['tanggal_jatuh_tempo'];?>
										</b>
									</h5>
								</th>
							</tr>
							<tr>
								<td colspan="3"><hr style="border:1px dashed #000; margin: 0px;"></td>
							</tr>
						</thead>
						<tbody>
						<?php
						$q_list_penjualan = mysqli_query($con, "SELECT
						tbl_list_penjualan_hutang.id_list_penjualan_hutang,
						tbl_list_penjualan_hutang.kode_penjualan,
						tbl_list_penjualan_hutang.nama_produk,
						tbl_list_penjualan_hutang.satuan,
						tbl_list_penjualan_hutang.qty,
						tbl_list_penjualan_hutang.hpj,
						tbl_list_penjualan_hutang.total_harga,
						(tbl_list_penjualan_hutang.qty * tbl_list_penjualan_hutang.hpj) AS totalnya,
						tbl_list_penjualan_hutang.status,
						tbl_list_penjualan_hutang.id_create,
						tbl_list_penjualan_hutang.date_create,
						tbl_list_penjualan_hutang.id_event,
						tbl_list_penjualan_hutang.discount,
						tbl_produk.alias
						FROM
						tbl_list_penjualan_hutang
						Left Join tbl_produk ON tbl_list_penjualan_hutang.id_produk = tbl_produk.id_produk
						WHERE tbl_list_penjualan_hutang.kode_penjualan = '$kode_penjualan'");
						while($data_list = mysqli_fetch_assoc($q_list_penjualan)){
						?>
							<tr>
								<td style="text-align:left;"><?=$data_list['alias'];?></td>
								<td style="text-align:right;"><?=number_format($data_list['qty'],2);?> X <?=number_format($data_list['hpj'],2);?></td>
								<td style="text-align:right;"><?=number_format($data_list['totalnya'],2);?></td>
							</tr>
						<?php
						}
						?>
						</tbody>
						<tfoot style="font-size:12px;">
							<tr>
								<td colspan="3"><hr style="border:1px dashed #000; margin: 0px;"></td>
							</tr>
							<tr>
								<th colspan="2" style="text-align:right;">
									Sub Total<br>
									Disc. Nota <?=$data_penjualan['discount_persen'];?> %<br>
									PPN 10%<br>
									Grand Total<br>
									Tunai<br>
									Hutang
								</th>
								<th style="text-align:right;">
									<?=number_format($data_penjualan['sub_total'],2);?><br>
									<?=number_format($data_penjualan['discount_rp'],2);?><br>
									<?=number_format($data_penjualan['harga_ppn'],2);?><br>
									<?=number_format($data_penjualan['grand_total'],2);?><br>
									<?=number_format($data_penjualan['pembayaran'],2);?><br>
									<?=number_format($data_penjualan['kembalian'],2);?>
								</th>
							</tr>
							<tr>
								<th style="text-align:center;" colspan="3">Terima Kasih, Datang Kembali</th>
							</tr>
							<tr>
								<th style="text-align:center;" colspan="3"><?=$data_penjualan['create_date'];?> | Kasir: <?=$data_penjualan['nama'];?></th>
							</tr>
						</tfoot>
					</table>
			</div>
		</div>
</body>
</html>