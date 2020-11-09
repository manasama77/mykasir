<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h1 class="header">Tambah User Baru</h1>
	</div>
	<?php
	include("alert.php");
	?>
</div>
<div class="row">
	<div class="col-lg-12">
		<form class="form-horizontal" action="user-entry.php" method="POST" autocomplete="off">
			<div class="panel panel-primary">
				<div class="panel-heading">User Info</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-3 control-label">Nama User :</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="Nama User" maxlength="50" required autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Username :</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="username" name="username" placeholder="Username" maxlength="25" value="" required autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Password :</label>
						<div class="col-lg-9">
							<input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="25" value="" required autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Role :</label>
						<div class="col-lg-9">
							<select id="role" name="role" class="form-control">
								<option value="2">Kasir</option>
								<option value="3">Admin</option>
							</select>
						</div>
					</div>
				</div>
				<div class="panel-footer"><button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button></div>
			</div>
		</form>
	</div>
</div>
</div>
</div>