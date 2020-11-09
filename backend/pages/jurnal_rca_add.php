<?php
$q_lead = mysqli_query($con, "SELECT * FROM lead WHERE status = 1");
$q_lead_kredit = mysqli_query($con, "SELECT * FROM lead WHERE status = 1");
?>
	<?php
	include("alert.php");
	?>
<div class="widget">
	<div class="widget-content">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="header">JURNAL SALDO</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-body">
						<form class="form-horizontal" action="jurnal_entry.php" method="POST" autocomplete="on">
							<div class="form-group">
								<label class="col-lg-3 control-label">Keterangan Keperluan :</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" id="keterangan" name="ket" required placeholder="Keterangan Pengeluaran" maxlength="50">
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-3 control-label">AKUN DEBET :</label>
								<div class="col-lg-9">
									<select name="debet" class="form-control" style="width:100%;" onchange="resultTipe();"  required>
										<option value="0">PILIH AKUN DEBET (akun yg akan di ambil saldonya)</option>
										<?php
										while($fa_lead = mysqli_fetch_array($q_lead)){
											$kode = $fa_lead['kode'];
											$alias = $fa_lead['alias'];							
											?>
											
											<option value="<?=$kode;?>"><?=$kode;?>&#8667; <?=$alias;?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-3 control-label">AKUN KREDIT:</label>
								<div class="col-lg-9">
									<select name="kredit" class="form-control" style="width:100%;" onchange="resultTipe();"  required>
											<option value="0">PILIH AKUN KREDIT (akun yg akan di tambahkan saldonya)</option>
										<?php
										while($fa_lead_kredit = mysqli_fetch_array($q_lead_kredit)){
											$kode = $fa_lead_kredit['kode'];
											$alias = $fa_lead_kredit['alias'];							
											?>
											<option value="<?=$kode;?>"><?=$kode;?>&#8667; <?=$alias;?></option>
											<?php
										}
										?>
									</select>
									<input name="param" type="hidden" value="1">
									
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-3 control-label">NOMINAL :</label>
								<div class="col-lg-9"><text class="small" style="color: green;">*isikan tanpa koma/ titik</text>
									<input type="number" class="form-control"  name="nominal" placeholder="jumlah transaksi" min="1" required>
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-3 control-label">Tgl Posting:</label>
								<div class="col-lg-3">
									<input type="text" class="form-control input-sm" id="end_date" name="tgl_posting" required placeholder="Tangal Akhir Event" value="<?=date("Y-m-d");?>" data-date-format="yyyy-mm-dd HH:mm:ss">
								</div>

							</div>
							<div class="form-group">
								<div class="col-lg-3"></div>
								<div class="col-lg-9">
									<button type="submit" class="btn btn-primary" onclick="return confirm('INPUT JURNAL <?php echo $debet; ?>')"><i class="fa fa-save"></i> INPUT LAPORAN</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>