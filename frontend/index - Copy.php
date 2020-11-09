<?php
include("../config.php");
include("check_login.php");
include("../backend/pages/lib/function_base.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Application for UD Mandiri Cahaya Abadi">
	<meta name="author" content="RIMSMEDIA">
    <title>UD Mandiri Cahaya Abadi - Kasir</title>
    <link href="../backend/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../backend/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="../backend/vendor/jqueryui/jquery-ui.min.css" rel="stylesheet" >
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet">
	<link href="assets/css/kasir.css" rel="stylesheet" >
</head>
<body>
	<div id="loading"><img src="assets/images/ajax-loader.gif" id="img-load" /></div>
	<div class="container-fluid">
		<form id="main" class="form-horizontal" autocomplete="off">
			<input type="hidden" id="id_create" name="id_create" value="<?=$_SESSION['id_user'];?>">
			<?php include('nav.php'); ?>
			<?php include('main.php'); ?>
		</form>
	</div>
</body>
</html>

<div id="vbaru"></div>
<div id="vjml_transaksi"></div>
<div id="vmember"></div>
<div id="vsalesman"></div>
<div id="vbarcode"></div>
<div id="vgrand"></div>
<div id="vspecial"></div>
<div id="vhutang"></div>
<input id="status" type="hidden">

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">Print Transaksi</h4>
			</div>
			<div class="modal-body">
				<p>Loading... Please Wait...</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="passwordModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">Ubah Password</h4>
			</div>
			<div id="updatepass" class="modal-body" autocomplete="off">
				<form id="updatepass" class="form-horizontal" method="post">
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
				<button type="button" id="update_password" class="btn btn-primary" onclick="gantiPassword(<?=$_SESSION['id_user'];?>);"><i class="fa fa-save"></i> Ganti Password</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="kodeModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">Pencarian No. Transaksi</h4>
			</div>
			<div class="modal-body">
				<form id="searchkode" class="form-horizontal" method="post">
					<div id="carikode" class="form-group">
						<label class="control-label col-lg-4">No Transaksi:</label>
						<div class="col-lg-6">
							<input type="text" id="kode" class="form-control" maxlength="13">
							<span id="kode_help" class="help-block hide">Kode Tidak Ditemukan!</span>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="submit_kode" class="btn btn-primary" onClick="checkKode();"><i class="fa fa-search"></i> Cari</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="kembalianModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<form class="form-horizontal" method="post">
					<div class="form-group">
						<label class="control-label col-lg-4">Kembalian:</label>
						<div class="col-lg-6"><input type="text" id="kembalian" name="kembalian" class="form-control input-lg pembayaran" style="text-align:right;color:#000;" placeholder="Kembalian" readonly>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button id="data_baru" type="button" class="btn btn-success" data-dismiss="modal" onclick="buatbaru()" accesskey="n" title="Gunakan Alt + N Membuat Transaksi Baru..." data-toggle="tooltip" data-placement="left">
					<i class="fa fa-add"></i> Buat Transaksi Baru
				</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- jQuery -->
<script src="../backend/vendor/jquery/jquery.min.js"></script>
<script src="../backend/vendor/jquery/jquery.number.js"></script>
<script src="../backend/vendor/jqueryui/jquery-ui.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../backend/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/config-datepicker.js"></script>
<script src="assets/js/dynamic_clock.js"></script>
<script src="assets/js/config_number.js"></script>
<script src="assets/js/config_audio.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script src="lib/function.js"></script>