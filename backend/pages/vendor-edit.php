<?php
$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "SELECT * FROM tbl_vendor WHERE id_vendor = '$id'");
$data = mysqli_fetch_assoc($kueri);

$q_provinsi = mysqli_query($con, "SELECT id_provinsi, nama_provinsi FROM tbl_provinsi");
$q_bank = mysqli_query($con, "SELECT id_bank, nama_bank FROM tbl_bank");
?>
<div class="widget">
	<div class="widget-content">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="header">Edit Supplier Baru</h1>
			</div>
			<?php
			include("alert.php");
			?>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-body">
					<form class="form-horizontal small" action="vendor-update.php" method="POST" autocomplete="on">
						<div class="form-group">
							<label class="col-lg-3 control-label">Nama Perusahaan :</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Nama Perusahaan" maxlength="50" required value="<?=$data['nama_perusahaan'];?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Alamat :</label>
							<div class="col-lg-9">
								<textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat Perusahaan" required><?=$data['alamat'];?></textarea>
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
									if($data['id_provinsi'] == $id_provinsi){
										$pro_act = "selected='selected'";
									}else{
										$pro_act = "";
									}
								?>
									<option <?=$pro_act;?> value="<?=$id_provinsi;?>"><?=$nama_provinsi;?></option>
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
								<input type="number" class="form-control" id="kodepos" name="kodepos" placeholder="Kodepos" min="0" max="99999" value="<?=$data['kodepos'];?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">No Telepon :</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="No Telepon" maxlength="15" value="<?=$data['no_telepon'];?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">No Fax :</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="no_fax" name="no_fax" placeholder="No Fax" maxlength="15" value="<?=$data['no_fax'];?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Email :</label>
							<div class="col-lg-9">
								<input type="email" class="form-control" id="email" name="email" placeholder="Email" maxlength="50" value="<?=$data['email'];?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">PIC :</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="pic" name="pic" placeholder="PIC" maxlength="50" value="<?=$data['pic'];?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">No Handphone :</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="no_handphone" name="no_handphone" placeholder="No Handphone" maxlength="15" value="<?=$data['no_handphone'];?>">
							</div>
						</div>
						<hr>
						<div class="form-group">
							<label class="col-lg-3 control-label">No Rekening :</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="no_rekening" name="no_rekening" placeholder="No Rekening" maxlength="25" value="<?=$data['no_rekening'];?>">
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
									
									if($data['id_bank'] == $id_bank){
										$bank_act = "selected='selected'";
									}else{
										$bank_act = "";
									}
								?>
									<option <?=$bank_act;?> value="<?=$id_bank;?>"><?=$nama_bank;?></option>
								<?php
								}
								?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Atas Nama :</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="atas_nama" name="atas_nama" placeholder="Atas Nama" maxlength="50" value="<?=$data['atas_nama'];?>">
							</div>
						</div>
						<hr>
						<div class="form-group">
							<label class="col-lg-3 control-label">Catatan :</label>
							<div class="col-lg-9">
								<textarea class="form-control" id="catatan" name="catatan" placeholder="Catatan"><?=$data['catatan'];?></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-9">
								<input type="hidden" id="date_create" name="date_create" value="<?=date("Y-m-d");?>">
								<input type="hidden" id="id_create" name="id_create" value="<?=$_SESSION["id_user"];?>">
								<input type="hidden" id="id" name="id" value="<?=$id;?>">
								<input type="hidden" id="id_kota2" name="id_kota2" value="<?=$data['id_kota'];?>">
								<button type="submit" class="btn btn-primary" onclick="return confirm('Edit Supplier Baru?')"><i class="fa fa-save"></i> Edit Supplier</button>
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>