<?php
$q_lead = mysqli_query($con, "SELECT * FROM trx ORDER BY id DESC LIMIT 500 ");
$nm_lead = mysqli_num_rows($q_lead);
$nm_lead;
?>
<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h2 class="header">DATA OPERASIONAL</h2>
	</div>
	<?php
	include("alert.php");
	?>
</div>
<div class="form-group">
	<div class="col-lg-9">
	<a href="?page=opr-add">
		<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> TAMBAH LAPORAN</button></a>
		</div>
		
					</div>
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table id="penjualanList" class="table table-bordered table-striped display small" width="100%">
				<thead>
					<tr>
						<th style="text-align:center; width:10px;">ID</th>
						<th style="text-align:center;">Nama Leadger</th>
						<th style="text-align:center;">REK DEBIT </th>
						<th style="text-align:center;">Keteranga Pengeluaran</th>
						<th style="text-align:center;">Nominal</th>
						<th style="text-align:center;">Tgl Pengeluaran</th>
						<th style="text-align:center;"><i class="fa fa-gear"></i></th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no=1;
				if($nm_lead == 0){
				?>
					<tr>
						<td style="text-align:center;">-</td>
						<td style="text-align:center;">-</td>
						<td style="text-align:center;">-</td>
						<td style="text-align:center;">-</td>
						<td style="text-align:center;">-</td>
						<td style="text-align:center;">-</td>
						<td style="text-align:center;">-</td>
					</tr>
				<?php
				}else{
					while($fa_lead = mysqli_fetch_array($q_lead)){
						$id_lead = $fa_lead['id'];
						$jenis_kas = $fa_lead['jenis_kas'];
						$keterangan = $fa_lead['ket'];
						$led = $fa_lead['led'];
						$nominal = $fa_lead['nominal'];
						$status = $fa_lead['status'];
						$tgl_reg = $fa_lead['tgl_reg'];
						
																							
						
				?>
					<tr>
						<td style="text-align:center;"><?=$no++;?></td>
						<td style="text-align:left;"><?=$led;?>  <?php
						$q_nama = mysqli_query($con, "SELECT * FROM leadger WHERE lib_id = $led ");
						$nm_nama = mysqli_num_rows($q_lead);
						if ($led > 0){
						while($nama_lead = mysqli_fetch_array($q_nama)){
						$nn_lead = $nama_lead['leadger'];									
						echo $nn_lead;?>
						<?php }} else {
						echo "Tidak ada Leadger Terkait"; }
							?>
						</td>
						<td style="text-align:center;"><?php
						
						if ($jenis_kas == "1") {echo "KAS TOKO";}
						elseif ($jenis_kas == "2"){echo "KAS BESAR";}
						elseif ($jenis_kas == "3"){echo "BANK BNI";}
						
						?></td>
						<td style="text-align:center;"><?=$keterangan;?></td>
						<td style="text-align:center;">
						<?php

$nominal_format = number_format($nominal,2,",",".");
echo $nominal_format;
?>
						</td>
						<td style="text-align:left;"><?=$tgl_reg;?></td>
						<td style="text-align:center; width:30px;">
							<a href="delete.php?del_id=<?=$id_lead;?>&page=opr-list">
								<button type="button" id="hapus" name="hapus" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Event <?=$nama;?>?')">
									<i class="fa fa-trash"></i>
								</button>
							</a>
						</td>
					</tr>
				<?php
					}
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
</div>