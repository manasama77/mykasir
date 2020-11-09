<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h1 class="header">Tambah Member Baru</h1>
	</div>
	<?php
	include("alert.php");
	?>
</div>
<div class="row">
	<div class="col-lg-12">
		<form class="form-horizontal" action="member-entry.php" method="POST" autocomplete="on">
			<div class="panel panel-primary">
				<div class="panel-heading">Data Diri</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-3 control-label">Nama Member :</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="nama_member" name="nama_member" placeholder="Nama Member" maxlength="50" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Alamat :</label>
						<div class="col-lg-9">
							<textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat Member" required></textarea>
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
						<label class="col-lg-3 control-label">No Handphone :</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="no_handphone" name="no_handphone" required placeholder="No Handphone" maxlength="15">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Email :</label>
						<div class="col-lg-9">
							<input type="email" class="form-control" id="email" name="email" placeholder="Email" maxlength="50">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Tanggal Lahir :</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tangga Lahir" maxlength="10">
						</div>
					</div>
				</div>
			</div>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Data Usaha</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-3 control-label">Nama Usaha :</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="nama_usaha" name="nama_usaha" placeholder="Nama Usaha" maxlength="50">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Jenis Usaha :</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="jenis_usaha" name="jenis_usaha" placeholder="Jenis Usaha" maxlength="50">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Alamat Usaha :</label>
						<div class="col-lg-9">
							<textarea id="alamat_usaha" name="alamat_usaha" class="form-control" placeholder="Alamat Usaha"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">No Telepon Usaha :</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="no_telepon_usaha" name="no_telepon_usaha" placeholder="No Telepon Usaha" maxlength="15">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Catatan :</label>
						<div class="col-lg-9">
							<textarea class="form-control" id="catatan" name="catatan" placeholder="Catatan"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">NPWP :</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="npwp" name="npwp" placeholder="NPWP" maxlength="15">
						</div>
					</div>
				</div>
			</div>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Data Member</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-3 control-label">Date Expired :</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="date_expired" name="date_expired" placeholder="Date Expired Member" maxlength="10" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-3"></div>
						<div class="col-lg-9">
							<input type="hidden" id="date_create" name="date_create" value="<?=date("Y-m-d");?>">
							<input type="hidden" id="id_create" name="id_create" value="<?=$_SESSION["id_user"];?>">
							<button type="submit" class="btn btn-primary" onclick="return confirm('Tambah Member Baru?')"><i class="fa fa-save"></i> Tambah Member Baru</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
</div>