<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Application for UD Mandiri Cahaya Abadi">
	<meta name="author" content="RIMSMEDIA">
	<title>UD Mandiri Cahaya Abadi</title>
	<link rel="stylesheet" href="dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="dist/css/font-awesome.min.css">
	<link rel="stylesheet" href="dist/css/signin.css">
	<style>
	html, body {
		height: 100%;
		overflow: hidden;
	}
	#background {
		position: fixed;
		top: 50%;
		left: 50%;
		min-width: 100%;
		min-height: 100%;
		width: auto;
		height: auto;
		z-index: -100;
		-webkit-transform: translateX(-50%) translateY(-50%);
		transform: translateX(-50%) translateY(-50%);
		background: url('dist/images/bg1.jpg') no-repeat;
		background-size: cover;
	}
	</style>
</head>
<body>
	<video autoplay loop muted poster="dist/images/bg1.jpg" id="background">
		<source src="dist/video/video_background_website.mp4" type="video/mp4">
	</video>
	<div class="container-fluid">
		<div class="row" style="margin-top:200px;">
			<div class="col-lg-12">
				<h2 align="center">
					<!-- Logo <img src="dist/images/logo matrial.PNG" width="100px" style="margin-top:-80px; margin-left: -55px; position:absolute;"> -->
				</h2>
				<form id="login" name="login" method="post" class="form-signin" action="cek_login.php">
					<h2 class="form-signin-heading" align="center" style="color:#fff;">UD Mandiri Cahaya Abadi</h2>
					<input type="text" id="username" name="username" class="form-control" placeholder="Username" maxlength="25" required>
					<input type="password" id="password" name="password" class="form-control" placeholder="Password" maxlength="25" required>
					<button class="btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-sign-in"></i> Login</button>
				</form>
			</div>
		</div>
		<?php
		if(isset($_GET['logout'])){
		?>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div id="errorlogin" class="alert alert-success" align="center">
					<strong><i class="fa fa-check"></i> Logout Berhasil</strong>.
				</div>
			</div>
			<div class="col-md-3"></div>
		</div>
		<?php
		}
		?>
		<?php
		if(isset($_GET['error'])){
			$error = $_GET['error'];
		?>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div id="errorlogin" class="alert alert-danger" align="center">
				<?php
				if($error == 1){
					$username = $_GET['username'];
				?>
					<strong><i class="fa fa-exclamation-circle"></i> Login Gagal</strong> Username <mark><strong><?=$username;?></strong></mark> tidak ditemukan.
				<?php
				}elseif($error == 2){
				?>
				<strong><i class="fa fa-exclamation-circle"></i> Login Gagal</strong> Password Salah.
				<?php
				}elseif($error == 3){
				?>
				<strong><i class="fa fa-exclamation-circle"></i> Silahkan login terlebih dahulu</strong>.
				<?php
				}
				?>
				</div>
			</div>
			<div class="col-md-3"></div>
		</div>
		<?php
		}
		?>
	</div>
</body>
</html>
<!-- jQuery -->
<script src="dist/js/jquery-3.2.1.js"></script>
<script src="dist/js/bootstrap.bundle.min.js"></script>
<script>
$("#errorlogin").fadeTo(2000, 500).slideUp(500, function(){
    $("#errorlogin").slideUp(500);
});
</script>