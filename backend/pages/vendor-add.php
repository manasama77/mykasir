<?php
$q_provinsi = mysqli_query($con, "SELECT id_provinsi, nama_provinsi FROM tbl_provinsi");
$q_bank = mysqli_query($con, "SELECT id_bank, nama_bank FROM tbl_bank");
?>
<div class="widget">
	<div class="widget-content">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="header">Tambah Supplier Baru</h1>
			</div>
			<?php
			include("alert.php");
			?>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-body">
					<form class="form-horizontal small" action="vendor-entry.php" method="POST" autocomplete="on">
						<div class="form-group">
							<label class="col-lg-3 control-label">Nama Perusahaan :</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Nama Perusahaan" maxlength="50" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Alamat :</label>
							<div class="col-lg-9">
								<textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat Perusahaan" required></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Provinsi :</label>
							<div class="col-lg-9">
								<select id="id_provinsi" name="id_provinsi" class="form-control" placeholder="Pilih Provinsi" onChange="loadKota();" required>
									<option value="">-</option>
								<?php
								while($fa_q_provinsi = mysqli_fetch_array($q_provinsi)){
									$id_provinsi = $fa_q_provinsi['id_provinsi'];
									$nama_provinsi = $fa_q_provinsi['nama_provinsi'];
								?>
									<option value="<?=$id_provinsi;?>"><?=$nama_provinsi;?></option>
								<?php
								}
								?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Kota :</label>
							<div class="col-lg-9">
								<select id="id_kota" name="id_kota" class="form-control" placeholder="Pilih Kota" disabled required>
									<option value="">-</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Kodepos :</label>
							<div class="col-lg-9">
								<input type="number" class="form-control" id="kodepos" name="kodepos" placeholder="Kodepos" min="0" max="99999">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">No Telepon :</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="No Telepon" maxlength="15">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">No Fax :</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="no_fax" name="no_fax" placeholder="No Fax" maxlength="15">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Email :</label>
							<div class="col-lg-9">
								<input type="email" class="form-control" id="email" name="email" placeholder="Email" maxlength="50">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">PIC :</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="pic" name="pic" placeholder="PIC" maxlength="50">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">No Handphone :</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="no_handphone" name="no_handphone" placeholder="No Handphone" maxlength="15">
							</div>
						</div>
						<hr>
						<div class="form-group">
							<label class="col-lg-3 control-label">No Rekening :</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="no_rekening" name="no_rekening" placeholder="No Rekening" maxlength="25">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Bank :</label>
							<div class="col-lg-9">
								<select id="id_bank" name="id_bank" class="form-control" placeholder="Pilih Bank">
									<option value="">-</option>
								<?php
								while($fa_q_bank = mysqli_fetch_array($q_bank)){
									$id_bank = $fa_q_bank['id_bank'];
									$nama_bank = $fa_q_bank['nama_bank'];
								?>
									<option value="<?=$id_bank;?>"><?=$nama_bank;?></option>
								<?php
								}
								?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Atas Nama :</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="atas_nama" name="atas_nama" placeholder="Atas Nama" maxlength="50">
							</div>
						</div>
						<hr>
						<div class="form-group">
							<label class="col-lg-3 control-label">Catatan :</label>
							<div class="col-lg-9">
								<textarea class="form-control" id="catatan" name="catatan" placeholder="Catatan"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-9">
								<input type="hidden" id="date_create" name="date_create" value="<?=date("Y-m-d");?>">
								<input type="hidden" id="id_create" name="id_create" value="<?=$_SESSION["id_user"];?>">
								<button type="submit" class="btn btn-primary" onclick="return confirm('Tambah Supplier Baru?')"><i class="fa fa-save"></i> Tambah Supplier</button>
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>