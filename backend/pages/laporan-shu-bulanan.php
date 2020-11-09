<?php
include("../../config.php");
include("lib/function_base.php");
//$bulan = $_REQUEST['bulan'];
//$tgl_awal = "2020-04-01";
//$tgl_akhir = "2020-04-17";
$tgl_awal = $_REQUEST['tgl_awal'];
$tgl_akhir = $_REQUEST['tgl_akhir'];
?>
<?php
// Fungsi header dengan mengirimkan raw data excel
//header("Content-type: application/vnd-ms-excel"); 
// Mendefinisikan nama file ekspor "hasil-export.xls"
//header("Content-Disposition: attachment; filename=operasional-export.xls");
?>

<?php


//pendapatan margin UMUM
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
WHERE DATE(lp.date_create) >= '$tgl_awal' AND DATE(lp.date_create) <= '$tgl_akhir' AND jenis_pelanggan='umum'
GROUP BY lp.nama_produk");

$sum_total_jual = 0;
$sum_total_pokok = 0;
$sum_keuntungan = 0;
$row_penjualan = mysqli_num_rows($q_penjualan);
while($data_penjualan = mysqli_fetch_assoc($q_penjualan)){
							$sum_total_jual += $data_penjualan['total_jual'];
							$sum_total_pokok += $data_penjualan['total_pokok'];
							$sum_keuntungan += $data_penjualan['keuntungan'];
						};

//SUM margin PENDAPATAN
$q_sum_penjualan_discount = mysqli_query($con, "SELECT SUM(discount_rp) AS sum_discount FROM tbl_penjualan WHERE DATE(tbl_penjualan.create_date) >= '$tgl_awal' AND DATE(tbl_penjualan.create_date) <= '$tgl_akhir'");

$q_sum_penjualan_discount = mysqli_fetch_assoc($q_sum_penjualan_discount);
$sum_discount = $q_sum_penjualan_discount['sum_discount'];

//pendapatan margin member
$q_penjualan_g = mysqli_query($con, "SELECT
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
WHERE DATE(lp.date_create) >= '$tgl_awal' AND DATE(lp.date_create) <= '$tgl_akhir' AND jenis_pelanggan='member'
GROUP BY lp.nama_produk");

$sum_total_jual_g = 0;
$sum_total_pokok_g = 0;
$sum_keuntungan_g = 0;
$row_penjualan_g = mysqli_num_rows($q_penjualan_g);
while($data_penjualan_g = mysqli_fetch_assoc($q_penjualan_g)){
							$sum_total_jual_g += $data_penjualan_g['total_jual'];
							$sum_total_pokok_g += $data_penjualan_g['total_pokok'];
							$sum_keuntungan_g += $data_penjualan_g['keuntungan'];
						};

//PENDAPATAN MARGIN MEMBER HUTANG
$q_penjualan_gh = mysqli_query($con, "SELECT
p.kode_produk,
lph.nama_produk,
lph.satuan,
tph.status,lph.date_create,tph.jenis_pelanggan,
SUM(lph.qty) AS qty,
SUM(lph.total_harga) / SUM(lph.qty) AS harga_satuan,
SUM(lph.total_harga) AS total_jual,
(p.hpp * SUM(lph.qty)) AS total_pokok,
(SUM(lph.total_harga) - (p.hpp * SUM(lph.qty))) AS keuntungan
FROM
tbl_list_penjualan_hutang lph
LEFT JOIN tbl_produk p ON p.id_produk = lph.id_produk
LEFT JOIN tbl_penjualan_hutang tph ON tph.kode_penjualan = lph.kode_penjualan
WHERE DATE(lph.date_create) >= '$tgl_awal' AND DATE(lph.date_create) <= '$tgl_akhir' AND tph.jenis_pelanggan='member' AND tph.status='lunas'
GROUP BY lph.nama_produk");

$sum_total_jual_gh = 0;
$sum_total_pokok_gh = 0;
$sum_keuntungan_gh = 0;
$row_penjualan_gh = mysqli_num_rows($q_penjualan_gh);
while($data_penjualan_gh = mysqli_fetch_assoc($q_penjualan_gh)){
							$sum_total_jual_gh += $data_penjualan_gh['total_jual'];
							$sum_total_pokok_gh += $data_penjualan_gh['total_pokok'];
							$sum_keuntungan_gh += $data_penjualan_gh['keuntungan'];
						};

// ----------------------------------------------------------------------						

$sum_keuntungan2=$sum_keuntungan-$sum_discount;
$sum_pendapatan_operasional=$sum_keuntungan2+$sum_keuntungan_g+$sum_keuntungan_gh;


//pendapatan FEE
$sum_fee="0";
//pendapatan lain-lain 
$sum_lainlain="0";
$sum_pop=$sum_fee+$sum_lainlain;

//SUM PENDAPATAN ALL
$sum_total_opr=$sum_pop+$sum_pendapatan_operasional;




//SUM PENDAPATAN ALL
$sum_total_opr=$sum_pop+$sum_pendapatan_operasional;
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Application for UD Mandiri Cahaya Abadi">
	<meta name="author" content="RIMSMEDIA">
    <title>Mandiri Cahaya Abadi - Laporan Pembelian <?=bulan_indo($bulan);?></title>
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
<body >
		<div class="row">
			<div class="col-lg-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th colspan="4"><div align="center"><font size="2">
								    UD Mandiri Cahaya Abadi
							        <br>
								  </font></div>
								  <font size="2">
								  <h4 align="center">LAPORAN SISA HASIL USAHA</h4>
								  <div align="center">PRIODE <?php echo $tgl_awal;?> Sampai  <?php echo $tgl_akhir;?>
							      </div>
							  </font></th>
							</tr>
						</thead>	
						
						
							<tr>
								<th style="text-align:left;" colspan="4">
									<font size="2"> PENDAPATAN 
 									</font>
								</th>
							</tr>
						
						<tbody>
						<tr  bgcolor="#FCFCFC">
								<th width="2" style="text-align:center;">NO</th>
								<th style="text-align:center;">PENDAPATAN OPERASIONAL</th>
								<th style="text-align:center;">JUMLAH</th>
						</tr>
						</tbody>
						<tbody>
						<font size="2">
						<?php
						//script pendapatan
						?>
							<tr>
								<td style="text-align:left;"><?php echo "1"; ?></td>
								<td style="text-align:left;">PENDAPATAN MARGIN UMUM</td>
								<td style="text-align:center;">
								  <?=number_format($sum_keuntungan2,2);?>
								</td>
							</tr>
														<tr>
								<td style="text-align:left;"><?php echo "2"; ?></td>
								<td style="text-align:left;">PENDAPATAN MARGIN GROSIR/ MEMBER</td>
								<td style="text-align:center;"><?=number_format($sum_keuntungan_g,2);?></td>
							</tr>
							</tr>
														<tr>
								<td style="text-align:left;"><?php echo "3"; ?></td>
								<td style="text-align:left;">PENDAPATAN MARGIN PEMBAYARAN PIUTANG</td>
								<td style="text-align:center;"><?=number_format($sum_keuntungan_gh,2);?>
								</td>
							</tr>

						</font>
						</tbody>
							<tr>
								<th style="text-align:left;"> </th>
								<th style="text-align:right;"><b>TOTAL I </b></th>
								<th style="text-align:left;">Rp. <?=number_format($sum_pendapatan_operasional,2);?></th>
							</tr>
						
						
						<tbody>
						<tr  bgcolor="#FCFCFC">
								<th width="2" style="text-align:center;"></th>
								<th style="text-align:center;">PENDAPATAN NON OPERASIONAL</th>
								<th style="text-align:center;">JUMLAH</th>
						</tr>
						</tbody>
						<tbody>
						<font size="2">
						<?php
						//script pendapatan
						?>
							<tr>
								<td style="text-align:left;"><?php echo "4"; ?></td>
								<td style="text-align:left;"><?php echo "FEE/DISKON" ?></td>
								<td style="text-align:center;"><?=number_format($sum_fee,2);?></td>
							</tr>
														<tr>
								<td style="text-align:left;"><?php echo "5"; ?></td>
								<td style="text-align:left;"><?php echo "LAIN-LAIN" ?></td>
								<td style="text-align:center;"><?=number_format($sum_lainlain,2);?></td>
							</tr>

						</font>
						</tbody>
							<tr>
								<th style="text-align:left;"> </th>
								<th style="text-align:right;"><b>TOTAL II</b></th>
								<th style="text-align:left;">Rp. <?=number_format($sum_pop,2);?></th>
							</tr>
												<tr bgcolor="#FCFCFC">
								<th width="2" style="text-align:center;"></th>
								<th style="text-align:right;"><b>JUMLAH TOTAL PENDAPATAN </b></th>
								<th style="text-align:left;">Rp.<?=number_format($sum_total_opr,2);?></th>
						</tr>
						<?php // pendapatan ?>
						
						</thead>
						<?php // PENDAPATAN ?>
						
						
						
							<tr>
								<th style="text-align:left;" colspan="4">
									<font size="2"> BEBAN PENJUALAN 
													BEBAN UMUM & ADMINISTRASI : 
 									</font>
								</th>
							</tr>
						
						<tbody>
						<font size="2">
						<tr bgcolor="#FCFCFC">
								<th width="2" style="text-align:center;">NO</th>
								<th style="text-align:center;"><b>BEBAN PENJUALAN</b></th>
								<th style="text-align:center;">JUMLAH</th>
						</tr>
						<?php
						$q_operasional = mysqli_query($con, "SELECT * FROM leadger WHERE lib = 2");
						
						$no=0;
						$row_operasional = mysqli_num_rows($q_operasional);
						while($fa_operasional = mysqli_fetch_array($q_operasional)){
						//$id_operasional = $fa_operasional['id'];
						$lib_id = $fa_operasional['lib_id'];
						//menghitung jumlah per ledger
						   
						$res = mysqli_query($con,"SELECT sum(nominal)
						FROM trx
						WHERE
						DATE(trx.tgl_reg) >= '$tgl_awal' AND DATE(trx.tgl_reg) <= '$tgl_akhir'
						AND trx.led = '$lib_id'

						");
						if (FALSE === $res) die("Select sum failed: ".mysqli_error);
						$row = mysqli_fetch_row($res);
						$sum = $row[0];
						$nominal_format = number_format($sum,2,",",".");
						?>
							<tr <?php if ($sum<1){$show="none";} else {$show="show"; $no++;}?> style="display:<?php echo $show; ?>;">
								<td style="text-align:left;"><?php echo $no?></td>
								<td style="text-align:left;"><?=$fa_operasional['leadger'];?></td>
								<td style="text-align:center;"><?php //echo $lib_id; 
								echo $nominal_format;
								?></td>
							</tr>
						<?php
						}
						?>
						</font>
						</tbody>
						
							<tr>
								<th style="text-align:left;"> </th>
								<th style="text-align:right;"><b>TOTAL III </b></th>
								<th style="text-align:left;">Rp. <?php 
						//TOTAL Leadger BEBAN PENJUALAN
						$q_jumlah =  mysqli_query($con, "SELECT SUM(nominal)
    					FROM trx
    					WHERE
						DATE(trx.tgl_reg) >= '$tgl_awal' AND DATE(trx.tgl_reg) <= '$tgl_akhir'
						AND led LIKE '%51%'");
						
						if (FALSE === $q_jumlah) die("Select sum failed: ".mysqli_error);
						$r_jumlah = mysqli_fetch_row($q_jumlah);
						$fa_jumlah = $r_jumlah[0];
						$fa_jumlah_format = number_format($fa_jumlah,2,",",".");
						echo $fa_jumlah_format;
								?></th>
							</tr>
						
						
						<?php //Table 2 : BEBAN UMUM DAN ADMINISTRASI ?>
						
												</thead>
						<tbody>
						<font size="2">
							<tr bgcolor="#FCFCFC">
							  <th style="text-align:center;">&nbsp;</th>
							  <th style="text-align:center;">BEBAN UMUM &amp; ADMINISTRASI</th>
							  <th style="text-align:center;">&nbsp;</th>
					    </tr>
							</font><tr bgcolor="#FCFCFC">
								<th width="2" style="text-align:center;"><div align="left">1</div></th>
								<th style="text-align:left;">BIAYA PEGAWAI</th>
								<th style="text-align:center;">JUMLAH</th>
							</tr><font size="2">
						<?php
						$q_biayapegawai = mysqli_query($con, "SELECT * FROM leadger WHERE lib = 12");
						
						$no=0;
						$r_biayapegawai = mysqli_num_rows($q_biayapegawai);
						while($fa_biayapegawai = mysqli_fetch_array($q_biayapegawai)){
						//$id_operasional = $fa_operasional['id'];
						$lib_id_biayapegawai = $fa_biayapegawai['lib_id'];
						//menghitung jumlah per ledger Tab 2
												  
						$q_nominal = mysqli_query($con,"SELECT sum(nominal)
						FROM trx
						WHERE
						DATE(trx.tgl_reg) >= '$tgl_awal' AND DATE(trx.tgl_reg) <= '$tgl_akhir'
						AND trx.led = $lib_id_biayapegawai");
						if (FALSE === $q_nominal) die("Select sum failed: ".mysqli_error);
						$r_jumlah_biayapegawai = mysqli_fetch_row($q_nominal);
						$sum_biayapegawai = $r_jumlah_biayapegawai[0];
						$format_biayapegawai = number_format($sum_biayapegawai,2,",",".");
						?>
							<tr <?php if ($sum_biayapegawai<1){$show="none";} else {$show="show"; $no++;}?> style="display:<?php echo $show; ?>;">
								<td style="text-align:left;">1.<?php echo $no?></td>
								<td style="text-align:left;"><?=$fa_biayapegawai['leadger'];?></td>
								<td style="text-align:center;"><?php //echo $lib_id; 
								echo $format_biayapegawai; 
								?></td>
							</tr>
						<?php
						}
						?>
						</font>
						</tbody>
						
							<tr>
								<th style="text-align:left;"> </th>
								<th style="text-align:right;"><b>TOTAL IV </b></th>
								<th style="text-align:left;">Rp. <?php 
						//TOTAL Leadger BEBAN UMUM
						$q_jumlah =  mysqli_query($con, "SELECT SUM(nominal)
    					FROM trx
    					WHERE
						DATE(trx.tgl_reg) >= '$tgl_awal' AND DATE(trx.tgl_reg) <= '$tgl_akhir'
						AND led LIKE '%52%'");
						
						if (FALSE === $q_jumlah) die("Select sum failed: ".mysqli_error);
						$r_jumlah = mysqli_fetch_row($q_jumlah);
						$fa_jumlah = $r_jumlah[0];
						$fa_jumlah_format = number_format($fa_jumlah,2,",",".");
						echo $fa_jumlah_format;
								?></th>
							</tr>
							
						<?php //TABLE 3: ALAT TULIS KANTOR ?>
						
												
												</thead>
						<tbody>
						<font size="2">
							<tr bgcolor="#FCFCFC">
								<th width="2" style="text-align:left;">2</th>
								<th style="text-align:left;"><b>ALAT TULIS KANTOR</b></th>
								<th style="text-align:center;">JUMLAH</th>
							</tr>
						<?php
						$q_atk = mysqli_query($con, "SELECT * FROM leadger WHERE lib = 28");
						
						$no=0;
						$r_atk = mysqli_num_rows($q_atk);
						while($fa_atk = mysqli_fetch_array($q_atk)){
						//$id_operasional = $fa_operasional['id'];
						$lib_id_atk = $fa_atk['lib_id'];
						//menghitung jumlah per ledger Tab 2
												  
						$q_nominal_atk = mysqli_query($con,"SELECT sum(nominal)
						FROM trx
						WHERE
						DATE(trx.tgl_reg) >= '$tgl_awal' AND DATE(trx.tgl_reg) <= '$tgl_akhir'
						AND trx.led = $lib_id_atk");
						if (FALSE === $q_nominal_atk) die("Select sum failed: ".mysqli_error);
						$r_jumlah_atk = mysqli_fetch_row($q_nominal_atk);
						$sum_atk = $r_jumlah_atk[0];
						$format_atk = number_format($sum_atk,2,",",".");
						?>
							<tr <?php if ($sum_atk<1){$show="none";} else {$show="show"; $no++;}?> style="display:<?php echo $show; ?>;">
								<td style="text-align:left;">2.<?php echo $no?></td>
								<td style="text-align:left;"><?=$fa_atk['leadger'];?></td>
								<td style="text-align:center;"><?php //echo $lib_id; 
								echo $format_atk; 
								?></td>
							</tr>
						<?php
						}
						?>
						</font>
						</tbody>
						
							<tr>
								<th style="text-align:left;"> </th>
								<th style="text-align:right;"><b>TOTAL V </b></th>
								<th style="text-align:left;">Rp. <?php 
						//TOTAL Leadger 
						$q_jumlah =  mysqli_query($con, "SELECT SUM(nominal)
    					FROM trx
    					WHERE
						DATE(trx.tgl_reg) >= '$tgl_awal' AND DATE(trx.tgl_reg) <= '$tgl_akhir'
						AND led LIKE '%53%'");
						
						if (FALSE === $q_jumlah) die("Select sum failed: ".mysqli_error);
						$r_jumlah = mysqli_fetch_row($q_jumlah);
						$fa_jumlah = $r_jumlah[0];
						$fa_jumlah_format = number_format($fa_jumlah,2,",",".");
						echo $fa_jumlah_format;
								?></th>
							</tr>
							
						<?php //TABLE 4: LISTRIK DAN TLP ?>
						
												
												</thead>
						<tbody>
						<font size="2">
							<tr bgcolor="#FCFCFC">
								<th width="2" style="text-align:left;">3</th>
								<th style="text-align:left;"><b>LISTRIK DAN TLP </b></th>
								<th style="text-align:center;">JUMLAH</th>
							</tr>
						<?php
						$q_atk = mysqli_query($con, "SELECT * FROM leadger WHERE lib = 32");
						
						$no=0;
						$r_atk = mysqli_num_rows($q_atk);
						while($fa_atk = mysqli_fetch_array($q_atk)){
						//$id_operasional = $fa_operasional['id'];
						$lib_id_atk = $fa_atk['lib_id'];
						//menghitung jumlah per ledger Tab 2
												  
						$q_nominal_atk = mysqli_query($con,"SELECT sum(nominal)
						FROM trx
						WHERE
						DATE(trx.tgl_reg) >= '$tgl_awal' AND DATE(trx.tgl_reg) <= '$tgl_akhir'
						AND trx.led = $lib_id_atk");
						if (FALSE === $q_nominal_atk) die("Select sum failed: ".mysqli_error);
						$r_jumlah_atk = mysqli_fetch_row($q_nominal_atk);
						$sum_atk = $r_jumlah_atk[0];
						$format_atk = number_format($sum_atk,2,",",".");
						?>
							<tr <?php if ($sum_atk<1){$show="none";} else {$show="show"; $no++;}?> style="display:<?php echo $show; ?>;">
								<td style="text-align:left;">3.<?php echo $no?></td>
								<td style="text-align:left;"><?=$fa_atk['leadger'];?></td>
								<td style="text-align:center;"><?php //echo $lib_id; 
								echo $format_atk; 
								?></td>
							</tr>
						<?php
						}
						?>
						</font>
						</tbody>
						
							<tr>
								<th style="text-align:left;"> </th>
								<th style="text-align:right;"><b>TOTAL VI </b></th>
								<th style="text-align:left;">Rp. <?php 
						//TOTAL Leadger 
						$q_jumlah =  mysqli_query($con, "SELECT SUM(nominal)
    					FROM trx
    					WHERE 
						DATE(trx.tgl_reg) >= '$tgl_awal' AND DATE(trx.tgl_reg) <= '$tgl_akhir'
						AND led LIKE '%54%'");
						
						if (FALSE === $q_jumlah) die("Select sum failed: ".mysqli_error);
						$r_jumlah = mysqli_fetch_row($q_jumlah);
						$fa_jumlah = $r_jumlah[0];
						$fa_jumlah_format = number_format($fa_jumlah,2,",",".");
						echo $fa_jumlah_format;
								?></th>
							</tr>
						<?php //TABLE 5: TRANSPORT ?>
						
												
												</thead>
						<tbody>
						<font size="2">
							<tr bgcolor="#FCFCFC">
								<th width="2" style="text-align:left;">4</th>
								<th style="text-align:left;"><b>TRANSPORT </b></th>
								<th style="text-align:center;">JUMLAH</th>
							</tr>
						<?php
						$q_atk = mysqli_query($con, "SELECT * FROM leadger WHERE lib = 36");
						
						$no=0;
						$r_atk = mysqli_num_rows($q_atk);
						while($fa_atk = mysqli_fetch_array($q_atk)){
						//$id_operasional = $fa_operasional['id'];
						$lib_id_atk = $fa_atk['lib_id'];
						//menghitung jumlah per ledger Tab 2
												  
						$q_nominal_atk = mysqli_query($con,"SELECT sum(nominal)
						FROM trx
						WHERE
						DATE(trx.tgl_reg) >= '$tgl_awal' AND DATE(trx.tgl_reg) <= '$tgl_akhir'
						AND trx.led = $lib_id_atk");
						if (FALSE === $q_nominal_atk) die("Select sum failed: ".mysqli_error);
						$r_jumlah_atk = mysqli_fetch_row($q_nominal_atk);
						$sum_atk = $r_jumlah_atk[0];
						$format_atk = number_format($sum_atk,2,",",".");
						?>
							<tr <?php if ($sum_atk<1){$show="none";} else {$show="show"; $no++;}?> style="display:<?php echo $show; ?>;">
								<td style="text-align:left;">4.<?php echo $no?></td>
								<td style="text-align:left;"><?=$fa_atk['leadger'];?></td>
								<td style="text-align:center;"><?php //echo $lib_id; 
								echo $format_atk; 
								?></td>
							</tr>
						<?php
						}
						?>
						</font>
						</tbody>
						
							<tr>
								<th style="text-align:left;"> </th>
								<th style="text-align:right;"><b>TOTAL VII </b></th>
								<th style="text-align:left;">Rp. <?php 
						//TOTAL Leadger 
						$q_jumlah =  mysqli_query($con, "SELECT SUM(nominal)
    					FROM trx
    					WHERE
						DATE(trx.tgl_reg) >= '$tgl_awal' AND DATE(trx.tgl_reg) <= '$tgl_akhir'
						AND led LIKE '%55%'");
						
						if (FALSE === $q_jumlah) die("Select sum failed: ".mysqli_error);
						$r_jumlah = mysqli_fetch_row($q_jumlah);
						$fa_jumlah = $r_jumlah[0];
						$fa_jumlah_format = number_format($fa_jumlah,2,",",".");
						echo $fa_jumlah_format;
								?></th>
							</tr>
						<?php //TABLE 5: TRANSPORT ?>
						
												
												</thead>
						<tbody>
						<font size="2">
							<tr bgcolor="#FCFCFC">
								<th width="2" style="text-align:left;">5</th>
								<th style="text-align:left;"><b>BIAYA LAINYA </b></th>
								<th style="text-align:center;">JUMLAH</th>
							</tr>
						<?php
						$q_atk = mysqli_query($con, "SELECT * FROM leadger WHERE lib = 44");
						
						$no=0;
						$r_atk = mysqli_num_rows($q_atk);
						while($fa_atk = mysqli_fetch_array($q_atk)){
						//$id_operasional = $fa_operasional['id'];
						$lib_id_atk = $fa_atk['lib_id'];
						//menghitung jumlah per ledger Tab 2
												  
						$q_nominal_atk = mysqli_query($con,"SELECT sum(nominal)
						FROM trx
						WHERE
						DATE(trx.tgl_reg) >= '$tgl_awal' AND DATE(trx.tgl_reg) <= '$tgl_akhir'
						AND trx.led = $lib_id_atk");
						if (FALSE === $q_nominal_atk) die("Select sum failed: ".mysqli_error);
						$r_jumlah_atk = mysqli_fetch_row($q_nominal_atk);
						$sum_atk = $r_jumlah_atk[0];
						$format_atk = number_format($sum_atk,2,",",".");
						?>
							<tr <?php if ($sum_atk<1){$show="none";} else {$show="show"; $no++;}?> style="display:<?php echo $show; ?>;">
								<td style="text-align:left;">5.<?php echo $no?></td>
								<td style="text-align:left;"><?=$fa_atk['leadger'];?></td>
								<td style="text-align:center;"><?php //echo $lib_id; 
								echo $format_atk; 
								?></td>
							</tr>
						<?php
						}
						?>
						</font>
						</tbody>
						
							<tr>
								<th style="text-align:left;"> </th>
								<th style="text-align:right;"><b>TOTAL VIII </b></th>
								<th style="text-align:left;">Rp. <?php 
						//TOTAL Leadger 
						$q_jumlah =  mysqli_query($con, "SELECT SUM(nominal)
    					FROM trx
    					WHERE 
						DATE(trx.tgl_reg) >= '$tgl_awal' AND DATE(trx.tgl_reg) <= '$tgl_akhir'
						AND led LIKE '%56%'");
						
						if (FALSE === $q_jumlah) die("Select sum failed: ".mysqli_error);
						$r_jumlah = mysqli_fetch_row($q_jumlah);
						$fa_jumlah = $r_jumlah[0];
						$fa_jumlah_format = number_format($fa_jumlah,2,",",".");
						echo $fa_jumlah_format;
								?></th>
							</tr>
						<?php // TFOOT ?>
						<tr bgcolor="#FCFCFC">
								<th width="2" style="text-align:center;"></th>
								<th style="text-align:right;"><b>JUMLAH TOTAL BEBAN</b></th>
								<th style="text-align:left;">Rp. <?php 
						// JUMLAH TOTAL  
						$q_jumlah =  mysqli_query($con, "SELECT SUM(nominal)FROM trx
						WHERE
						DATE(trx.tgl_reg) >= '$tgl_awal' AND DATE(trx.tgl_reg) <= '$tgl_akhir'
						");
						
						if (FALSE === $q_jumlah) die("Select sum failed: ".mysqli_error);
						$r_jumlah = mysqli_fetch_row($q_jumlah);
						$fa_jumlah = $r_jumlah[0];
						$fa_jumlah_format = number_format($fa_jumlah,2,",",".");
						echo $fa_jumlah_format;
								?>
								
								</th>
						</tr>
						
						<tr bgcolor="#FCFCFC">
								<th width="2" style="text-align:center;"></th>
								<th style="text-align:left;"><b>SISA HASIL USAHA</b></th>
								<th style="text-align:left;">Rp. <?php $shu=$sum_total_opr-$fa_jumlah; echo number_format($shu,2,",",".");?>
								
								</th>
						</tr>
						
						
						<tr bgcolor="#FCFCFC">
						  <th style="text-align:center;"></th>
						  <th style="text-align:right;">&nbsp;</th>
						  <th style="text-align:left;">
						  <a href="export-laporan-opr-bulanan.php?tgl_awal=<?php echo $tgl_awal;?>&tgl_akhir=<?php echo $tgl_akhir; ?>"><button type="button" class="print" data-dismiss="modal"><i class="fa fa-download"> Export Excel</i></button></a>
						  </th>
					  </tr>
						
			  </table>
			</div>
		</div>
</body>
</html>