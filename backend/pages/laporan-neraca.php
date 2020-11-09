<?php
include("../../config.php");
include("lib/function_base.php");
//$tanggal_awal = $_REQUEST['tanggal_awal'];
//$tanggal_akhir = $_REQUEST['tanggal_akhir'];

$q=mysqli_query($con, "SELECT saldo, alias FROM lead WHERE kode='10001'");
$qs = mysqli_fetch_assoc($q);
$kas_toko=$qs['saldo'];
$qk=mysqli_query($con, "SELECT SUM(kredit) as kredit, SUM(debit) as debit FROM tbl_neraca_posting WHERE id_leadger='10001'");
$qs = mysqli_fetch_assoc($qk);
$k_kas=$qs['kredit'];
$d_kas=$qs['debit'];


$q=mysqli_query($con, "SELECT saldo, alias FROM lead WHERE kode='10002'");
$qs = mysqli_fetch_assoc($q);
$kas_besar=$qs['saldo'];

$q=mysqli_query($con, "SELECT saldo, alias FROM lead WHERE kode='10003'");
$qs = mysqli_fetch_assoc($q);
$kas_bank=$qs['saldo'];

$piutang_dagang="0";
$persedian_barang="0";
$biaya_dp="0";
$asuransi_dp="0";
$jumlah_aktiva_lancar="0";


$tanah="0";
$bangunan="0";
$kendaraan="0";
$inventaris="0";
$akumulasi_penyusutan="0";
$nilai_buku="0";
$jumlah_aktiva="0";



$hutang_bank="0";
$hutang_kums="0";
$hutang_lain="0";
$biaya_ymhb="0";
$jumlah_pasiva="0";

$modal="0";
$simpanan_pokok="0";
$simpanan_wajib="0";
$shu="0";


$jumlah_ekuitas="0";
$jumlah_liabilitas_ekuitas="0";



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
							<h4 class="header">UD.MANDIRI CAHAYA ABADI</h4>
							<h4 class="header">LAPORAN NERACA</h4>
							<h5 class="header">
								Jl. <br>
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
							<font size="3">Periode <?php //echo $tanggal_awal;?> s/d <?php //echo $tanggal_akhir;?></font>
						</th>
					</tr>
				</thead>

<!----------AKTIVA TETAP-------------------------------------------------------------->

				<tbody>

						<tr>
							<th style="text-align:center; font-size:12px;"></th>
							<th style="text-align:left;font-size:12px;">AKTIVA LANCAR</th>
							<th style="text-align:center;font-size:12px;">SALDO LALU</th>
							<th width="10px"></th>			
							<th style="text-align:center;font-size:12px;">KREDIT</th>
							<th style="text-align:center;font-size:12px;">DEBIT</th>
							<th style="text-align:center;font-size:12px;">SALDO</th>
						</tr>
					
							<tr>
								<td style="text-align:center;">$1</td>
								<td style="text-align:left;">KAS TOKO</td>
								<td style="text-align:right;"><?=number_format($kas_toko,2);?></td>
								<td></td>
								<td style="text-align:right;"><?=number_format($k_kas,2);?></td>
								<td style="text-align:right;"><?=number_format($d_kas,2);?></td>
								<td style="text-align:right; color:green;">*00</td>
							</tr>
							<tr>
								<td style="text-align:center;">$1</td>
								<td style="text-align:left;">KAS BESAR</td>
								<td style="text-align:right;"><?=number_format($kas_besar,2);?></td>
								<td></td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right; color:green;">*00</td>
							</tr>
							<tr>
								<td style="text-align:center;">$1</td>
								<td style="text-align:left;">KAS BANK</td>
								<td style="text-align:right;"><?=number_format($kas_bank,2);?></td>
								<td></td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right; color:green;">*00</td>
							</tr>
							<tr>
								<td style="text-align:center;">$1</td>
								<td style="text-align:left;"> PIUTANG DAGANG</td>
								<td style="text-align:right;"><?=number_format($piutang_dagang,2);?></td>
								<td></td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right; color:green;">*00</td>
							</tr>
							<tr>
								<td style="text-align:center;">$1</td>
								<td style="text-align:left;"> PERSEDIAN BARANG</td>
								<td style="text-align:right;"><?=number_format($persedian_barang,2);?></td>
								<td></td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right; color:green;">*00</td>
							</tr>
							<tr>
								<td style="text-align:center;">$1</td>
								<td style="text-align:left;"> BIAYA DIBAYAR DIMUKA</td>
								<td style="text-align:right;"><?=number_format($biaya_dp,2);?></td>
								<td></td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right; color:green;">*00</td>
							</tr>
							<tr>
								<td style="text-align:center;">$1</td>
								<td style="text-align:left;"> ASURANSI DIBAYAR DIMUKA</td>
								<td style="text-align:right;"><?=number_format($asuransi_dp,2);?></td>
								<td></td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right; color:green;">*00</td>
							</tr>
					<tr>
						<th></th>
						<th style="text-align:left;">JUMLAH AKTIVA LANCAR </th>
						<th style="text-align:right;">
							<?=number_format($jumlah_aktiva_lancar,2);?>
						</th>
						<th></th>
						<th style="text-align:right;">0</th>
						<th style="text-align:right; color:green;">0</th>
						<th style="text-align:right; color:blue;">0</th>
					</tr>
							<tr>
								<td style="text-align:center;" colspan="7"></td>				
							</tr>
						


<!----------AKTIVA TETAP-------------------------------------------------------------->


						<tr>
							<th style="text-align:center;"></th>
							<th style="text-align:left; font-size:12px;">AKTIVA TETAP</th>
							<th style="text-align:right;" colspan="6"></th>						
						</tr>

					
							<tr>
								<td style="text-align:center;">$1</td>
								<td style="text-align:left;">TANAH</td>
								<td style="text-align:right;"><?=number_format($tanah,2);?></td>
								<td></td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right; color:green;">*00</td>
							</tr>
							<tr>
								<td style="text-align:center;">$1</td>
								<td style="text-align:left;">BANGUNAN</td>
								<td style="text-align:right;"><?=number_format($bangunan,2);?></td>
								<td></td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right; color:green;">*00</td>
							</tr>
							<tr>
								<td style="text-align:center;">$1</td>
								<td style="text-align:left;">KENDARAAN</td>
								<td style="text-align:right;"><?=number_format($kendaraan,2);?></td>
								<td></td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right; color:green;">*00</td>
							</tr>
							<tr>
								<td style="text-align:center;">$1</td>
								<td style="text-align:left;"> INVENTARIS</td>
								<td style="text-align:right;"><?=number_format($inventaris,2);?></td>
								<td></td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right; color:green;">*00</td>
							</tr>
							<tr>
								<td style="text-align:center;"></td>
								<td style="text-align:left;"> </td>
								<td style="text-align:right;"></td>
								<td></td>
								<td style="text-align:right;"></td>
								<td style="text-align:right;"></td>
								<td style="text-align:right; color:green;"></td>
							</tr>
							<tr>
								<td style="text-align:center;">$1</td>
								<td style="text-align:left;"> AKUMULASI PENYUSUTAN</td>
								<td style="text-align:right;"><?=number_format($akumulasi_penyusutan,2);?></td>
								<td></td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right; color:green;">*00</td>
							</tr>
							<tr>
								<td style="text-align:center;">$1</td>
								<td style="text-align:left;"> NILAI BUKU</td>
								<td style="text-align:right;"><?=number_format($nilai_buku,2);?></td>
								<td></td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right;">0</td>
								<td style="text-align:right; color:green;">*00</td>
							</tr>

					</font>
				
					<tr>
						<th></th>
						<th style="text-align:left;" colspan="1">JUMLAH AKTIVA / ASSET </th>
						<th style="text-align:right;"><?=number_format($jumlah_aktiva,2);?></th>
						<th></th>
						<th style="text-align:right;">0</th>
						<th style="text-align:right; color:green;">0</th>
						<th style="text-align:right; color:blue;">0</th>
					</tr>
							<tr>
								<td style="text-align:center;" colspan="7"></td>	
							</tr>
				</tbody>

<!----------LIABILITAS-------------------------------------------------------------->
<tr>
	<th style="text-align:center;"></th>
	<th style="text-align:left; font-size:12px;">LIABILITAS DAN EKUITAS</th>
	<th style="text-align:right;" colspan="6"></th>						
</tr>
<tr>
	<th style="text-align:center;"></th>
	<th style="text-align:left; font-size:12px;">LIABILITAS LANCAR</th>
	<th style="text-align:right;" colspan="6"></th>						
</tr>

<tr>
	<td style="text-align:center;">$1</td>
	<td style="text-align:left;"> HUTANG BANK</td>
	<td style="text-align:right;"><?=number_format($hutang_bank,2);?></td>
	<td></td>
	<td style="text-align:right;">0</td>
	<td style="text-align:right;">0</td>
	<td style="text-align:right; color:green;">*00</td>
</tr>
<tr>
	<td style="text-align:center;">$1</td>
	<td style="text-align:left;"> HUTANG KUMS</td>
	<td style="text-align:right;"><?=number_format($hutang_kums,2);?></td>
	<td></td>
	<td style="text-align:right;">0</td>
	<td style="text-align:right;">0</td>
	<td style="text-align:right; color:green;">*00</td>
</tr>
<tr>
	<td style="text-align:center;">$1</td>
	<td style="text-align:left;"> HUTANG LAIN</td>
	<td style="text-align:right;"><?=number_format($hutang_lain,2);?></td>
	<td></td>
	<td style="text-align:right;">0</td>
	<td style="text-align:right;">0</td>
	<td style="text-align:right; color:green;">*00</td>
</tr>
<tr>
	<td style="text-align:center;">$1</td>
	<td style="text-align:left;"> BIAYA YANG MASIH HARUS DIBAYAR</td>
	<td style="text-align:right;"><?=number_format($biaya_ymhb,2);?></td>
	<td></td>
	<td style="text-align:right;">0</td>
	<td style="text-align:right;">0</td>
	<td style="text-align:right; color:green;">*00</td>
</tr>
<th></th>
<tr>
	<td style="text-align:center;">$1</td>
	<td style="text-align:left;"> JUMLAH PASIVA</td>
	<td style="text-align:right;"><?=number_format($jumlah_pasiva,2);?></td>
	<td></td>
	<td style="text-align:right;">0</td>
	<td style="text-align:right;">0</td>
	<td style="text-align:right; color:green;">*00</td>
</tr>
<th></th>
<!----------EKUITAS-------------------------------------------------------------->
						<tr>
							<th style="text-align:center;"></th>
							<th style="text-align:left; font-size:12px;">EKUITAS</th>
							<th style="text-align:right;" colspan="6"></th>						
						</tr>

						<tr>
							<td style="text-align:center;">$1</td>
							<td style="text-align:left;"> MODAL</td>
							<td style="text-align:right;"><?=number_format($modal,2);?></td>
							<td></td>
							<td style="text-align:right;">0</td>
							<td style="text-align:right;">0</td>
							<td style="text-align:right; color:green;">*00</td>
						</tr>
						<tr>
							<td style="text-align:center;">$1</td>
							<td style="text-align:left;"> SIMPANAN POKOK</td>
							<td style="text-align:right;"><?=number_format($simpanan_pokok,2);?></td>
							<td></td>
							<td style="text-align:right;">0</td>
							<td style="text-align:right;">0</td>
							<td style="text-align:right; color:green;">*00</td>
						</tr>
						<tr>
							<td style="text-align:center;">$1</td>
							<td style="text-align:left;"> SIMPANAN WAJIB</td>
							<td style="text-align:right;"><?=number_format($simpanan_wajib,2);?></td>
							<td></td>
							<td style="text-align:right;">0</td>
							<td style="text-align:right;">0</td>
							<td style="text-align:right; color:green;">*00</td>
						</tr>
						<tr>
							<td style="text-align:center;">$1</td>
							<td style="text-align:left;"> SISA HASIL USAHA</td>
							<td style="text-align:right;"><?=number_format($shu,2);?></td>
							<td></td>
							<td style="text-align:right;">0</td>
							<td style="text-align:right;">0</td>
							<td style="text-align:right; color:green;">*00</td>
						</tr>



						<tr>
							<th></th>
							<th style="text-align:left;" colspan="2">JUMLAH EKUITAS </th>
							<td></td>
							<th style="text-align:right;">0</th>
							<th style="text-align:right; color:green;">0</th>
							<th style="text-align:right; color:blue;">0</th>
						</tr>
						<tr>
							<th></th>
							<th style="text-align:left;" colspan="2">JUMLAH LIABILITAS DAN EKUITAS</th>
							<td></td>
							<th style="text-align:right;">0</th>
							<th style="text-align:right; color:green;">0</th>
							<th style="text-align:right; color:blue;">0</th>
						</tr>





					<tr>
						<th style="text-align:right;" colspan="5"><h4>Total </h4></th>
						<th style="text-align:right;"><h4>0,00</h4></th>
					</tr>


				</tfoot>
			</table>
		</div>
	</div>
</body>
</html>