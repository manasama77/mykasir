<?php
include("../../config.php");
include("lib/function_base.php");
//$bulan = $_REQUEST['bulan'];
//$tgl_awal = "2018-12-11";
//$tgl_akhir = "2018-12-11";
$tgl_awal = $_REQUEST['tgl_awal'];
$tgl_akhir = $_REQUEST['tgl_akhir'];
?>
<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel"); 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=operasional-export.xls");
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Application for UD Mandiri Cahaya Abadi">
	<meta name="author" content="RIMSMEDIA">
    <title>UD Mandiri Cahaya Abadi - Laporan Pembelian <?=bulan_indo($bulan);?></title>

    
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
								<th colspan="4"><font size="2">
									LAPORAN BEBAN OPERASIONAL 
									UD Mandiri Cahaya Abadi
									<br>
									Tanggal Cetak : <?php echo $tgl_awal;?> Sampai  <?php echo $tgl_akhir;?>
								</font></th>
							</tr>
							<tr>
								<th style="text-align:left;" colspan="4">
									<font size="2">KETERANGAN <?php //=bulan_indo($bulan);?></font>
								</th>
							</tr>
						</thead>
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
								<th style="text-align:right;"><b>TOTAL</b></th>
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
								<th style="text-align:right;"><b>TOTAL </b></th>
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
								<th style="text-align:right;"><b>TOTAL </b></th>
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
								<th style="text-align:right;"><b>TOTAL </b></th>
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
								<th style="text-align:right;"><b>TOTAL </b></th>
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
								<th style="text-align:right;"><b>TOTAL </b></th>
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
								<th style="text-align:right;"><b>JUMLAH TOTAL</b></th>
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
			  </table>
			</div>
		</div>
</body>
</html>