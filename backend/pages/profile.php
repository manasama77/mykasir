<?php
$id_user = $_SESSION['id_user'];
$id_role = $_SESSION['id_role'];
$q_profile = mysqli_query($con, "SELECT * FROM tbl_user WHERE id_user = '$id_user'");
$data = mysqli_fetch_assoc($q_profile);

if($id_role == "1"){
	$nama_role = "Admin";
}elseif($id_role == "2"){
	$nama_role = "Kasir";
}elseif($id_role == "3"){
	$nama_role = "Kepala Toko";
}elseif($id_role == "4"){
	$nama_role = "Asistant Kepala Toko";
}
?>
<div class="row">
	<div class="col-lg-12">
		<form id="profileform" name="profileform" class="form-horizontal" method="post" autocomplete="off" onLoad="checkProfile();">
			<input type="hidden" id="id_user" value="<?=$id_user;?>">
			<input type="hidden" id="id_role" value="<?=$id_role;?>">
			<div class="panel panel-primary">
				<div class="panel-heading"><i class="fa fa-gear"></i> Profile Setting</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label col-lg-2">Username:</label>
						<div class="col-lg-10">
							<input type="text" id="username" class="form-control" value="<?=$data['username'];?>" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2">Nama:</label>
						<div class="col-lg-10">
							<input type="text" id="nama" class="form-control" value="<?=$data['nama'];?>" maxlength="50">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2">Posisi:</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="nama_role" value="<?=$nama_role;?>" readonly>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div id="profileok" class="alert alert-success hide">Ubah Profile Berhasil</div>
					<button type="button" id="submit" class="btn btn-primary" onClick="ubahProfile(<?=$id_user;?>);">
						<i class="fa fa-save"></i> Simpan Perubahan
					</button>
					<button type="button" id="ubah_password" class="btn btn-warning" onClick="ubahPassword(<?=$id_user;?>);">
						<i class="fa fa-key"></i> Ubah Password
					</button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- Modal -->
<div id="profileModal" tabindex="-1" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
				<h4 id="myModalLabel">Ubah Password</h4>
			</div>
			<div class="modal-body" id="vProduk">
				<form id="updatepass" class="form-horizontal" autocomplete="off">
					<div id="pass_lama" class="form-group">
						<label class="control-label col-lg-4">Password Lama:</label>
						<div class="col-lg-6">
							<input type="password" id="password_lama" class="form-control" maxlength="25" onKeyUp="checkPasswordLama();">
							<span id="pass_help" class="help-block hide">Password Tidak Cocok!</span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Password Baru:</label>
						<div class="col-lg-6">
							<input type="password" id="password_baru" class="form-control" maxlength="25" onKeyUp="checkPasswordBaru();">
						</div>
					</div>
					<div id="pass_kon" class="form-group">
						<label class="control-label col-lg-4">Ulangi Password Baru:</label>
						<div class="col-lg-6">
							<input type="password" id="password_konfirmasi" class="form-control" maxlength="25" onKeyUp="checkPasswordBaru();">
							<span id="pass_ver" class="help-block hide">Password Tidak Cocok!</span>
						</div>
					</div>
				</form>
			</div>
			
			<div class="modal-footer">
				<div id="passok" class="alert alert-success hide">Ganti Password Berhasil</div>
				<button type="button" id="update_password" class="btn btn-primary" onclick="gantiPassword(<?=$id_user;?>);"><i class="fa fa-save"></i> Ganti Password</button>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->