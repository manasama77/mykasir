<?php
$q_lead = mysqli_query($con, "SELECT * FROM leadger WHERE status = 3");
?>
<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h1 class="header">Input Pengeluaran Operasional</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-body">
				 <form class="form-horizontal" action="opr_entry.php" method="POST" autocomplete="on">
					<div class="form-group">
						<label class="col-lg-3 control-label">Keterangan Pengeluaran :</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="keterangan" name="keterangan" required placeholder="Keterangan Pengeluaran" maxlength="50">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Jenis Pengeluaran  :</label>
						<div class="col-lg-9">
							<select placeholder="Nama Event" id="id_produk" name="leadger" class="form-control" style="width:100%;" onchange="resultTipe();"  required>
							<?php
							while($fa_lead = mysqli_fetch_array($q_lead)){
								$id_ = $fa_lead['id'];
								$id_lead = $fa_lead['lib_id'];
								$nama_lead = $fa_lead['leadger'];
								$nama_lib = $fa_lead['lib'];
							?>
								<option value="<?=$id_lead;?>"><?=$id_lead;?> &#8667;
								<?php
								$q_sub_lead = mysqli_query($con, "SELECT * FROM leadger WHERE id = $nama_lib");
								while($fa_sub_lead = mysqli_fetch_array($q_sub_lead)){
								$nama_sub_lead = $fa_sub_lead['leadger'];
								}
								?><?=$nama_sub_lead;?>
								&#8667; <?=$nama_lead;?>
								
								</option>
							<?php
							}
							?>
							</select>
						</div>
					</div>
					<div id="qtyp" class="form-group">
						<label class="col-lg-3 control-label">Jumlah Pengeluaran :</label>
						<div class="col-lg-9">
						  <input type="number" class="form-control" id="potongan_harga" name="nominal" placeholder="Jumlah Pengeluaran" min="1">
</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-3 control-label">Tgl Pengeluaran:</label>
						<div class="col-lg-3">
							<input type="text" class="form-control input-sm" id="end_date" name="tgl_register" required placeholder="Tangal Akhir Event" value="<?=date("Y-m-d");?>" data-date-format="yyyy-mm-dd">
						</div>
						<label class="col-lg-3 control-label">Debet Kas:</label>
						<div class="col-lg-3">
							<select name="jenis_kas"  class="form-control input-sm" id="jenis_kas">
							  <option value="1">KAS TOKO</option>
							  <option value="2">KAS BESAR</option>
							  <option value="3">BANK BNI</option>
							</select>
					        <input name="status" type="hidden" id="status" value="0">
					  </div>
					</div>
					<div class="form-group">
						<div class="col-lg-3"></div>
						<div class="col-lg-9">
							<button type="submit" class="btn btn-primary" onclick="return confirm('Tambah Event?')"><i class="fa fa-save"></i> INPUT LAPORAN</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>