<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h1 class="header">Tambah Salesman Baru</h1>
	</div>
	<?php
	include("alert.php");
	?>
</div>
<div class="row">
	<div class="col-lg-12">
		<form class="form-horizontal" action="salesman-entry.php" method="POST" autocomplete="on">
			<div class="panel panel-primary">
				<div class="panel-heading">Data Salesman</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-3 control-label">Nama Salesman :</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="nama_salesman" name="nama_salesman" placeholder="Nama Salesman" maxlength="50" required>
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
							<input type="text" class="form-control" id="no_handphone" name="no_handphone" placeholder="No Handphone" maxlength="15">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Alamat :</label>
						<div class="col-lg-9">
							<textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat Salesman"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-3"></div>
						<div class="col-lg-9">
							<input type="hidden" id="date_create" name="date_create" value="<?=date("Y-m-d");?>">
							<input type="hidden" id="id_create" name="id_create" value="<?=$_SESSION["id_user"];?>">
							<button type="submit" class="btn btn-primary" onclick="return confirm('Tambah Salesman Baru?')"><i class="fa fa-save"></i> Tambah Salesman Baru</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
</div>