<?php
include("../../config.php");
include("check_login.php");
include("lib/function_base.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>UD Mandiri Cahaya Abadi - Administrator Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	 <meta name="description" content="Application for UD Mandiri Cahaya Abadi">
	<meta name="author" content="RIMSMEDIA">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
	<!--link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet"-->
	<link href="assets/css/google.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/style.css" rel="stylesheet">
	<link href="../vendor/jqueryui/jquery-ui.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../vendor/datatables/datatables.min.css"/>
	<link href="../vendor/select2/select2.min.css" rel="stylesheet">
	<link href="assets/css/ananda.css" rel="stylesheet">
</head>
<body>
<?php include("nav.php"); ?>
<div class="main">
	<div class="main-inner">
	    <div class="container" style="min-height:446px !important;">
			<div class="row">
				<div class="span12">
					<?php
					if(isset($_GET['page'])){
						$page = $_GET['page'];
					}else{
						$page = "dashboard";
					}
					
					include($page.".php");
					?>
				</div> <!-- /span12 -->
			</div> <!-- /row -->
	    </div> <!-- /container -->
	</div> <!-- /main-inner -->
</div> <!-- /main -->

<?php include("footer.php"); ?>
</body>
</html>
<!-- jQuery -->
<script src="../vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../vendor/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="../vendor/raphael/raphael.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../vendor/jqueryui/jquery-ui.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../vendor/datatables/datatables.js"></script>

<!-- Select2 JavaScript -->
<script src="../vendor/select2/select2.min.js"></script>

<script src="../data/webconfig.js"></script>
<script src="../data/datatablesconfig.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>
<?php include("limit_lib_js.php"); ?>
<script>
$(document).ready(function(){
	var url = window.location.search;
	var id = $('#id').val();
	var id_kota2 = $('#id_kota2').val();
	
	if(url == ""){
		$( "#pdashboard" ).addClass("active");
	}else if(url == "?page=produk-list" || url == "?page=produk-add" || url == "?page=pembelian-list" || url == "?page=pembelian-add" || url == "?page=history-pembayaran" || url == "?page=kadarluarsa-list"){
		$( "#pproduk" ).addClass("active");
	}else if(url == "?page=kategori_produk-list" || url == "?page=kategori_produk-add"){
		$( "#pkategori" ).addClass("active");
	}else if(url == "?page=satuan_produk-list" || url == "?page=satuan_produk-add"){
		$( "#psatuan" ).addClass("active");
	}else if(url == "?page=koreksi-list" || url == "?page=koreksi-add"){
		$( "#pkoreksi" ).addClass("active");
	}else if(url == "?page=member-list" || url == "?page=member-add"){
		$( "#pmember" ).addClass("active");
	}else if(url == "?page=vendor-list" || url == "?page=vendor-add"){
		$( "#pvendor" ).addClass("active");
	}else if(url == "?page=salesman-list" || url == "?page=salesman-add"){
		$( "#psalesman" ).addClass("active");
	}else if(url == "?page=laporan-pembelian" || url == "?page=laporan-pembelian-hutang" || url == "?page=laporan-pembelian-lunas" || url == "?page=laporan-penjualan" || url == "?page=laporan-pembelian-hutang-supplier" || url == "?page=laporan-penjualan-discount"  || url == "?page=laporan-laba-rugi"){
		$( "#plaporan" ).addClass("active");
	}else if(url == "?page=event-list" || url == "?page=event-add"){
		$( "#pevent" ).addClass("active");
	}else if(url == "?page=penjualan-list"){
		$( "#plistpenjualan" ).addClass("active");
	}else if(url == "?page=vendor-edit&id="+id){
		loadKota(id_kota2);
	}
	
	$( "#bckdb" ).click(function() {
		$.get( "backup.php" ).done(function( data ) {
			alert( "Backup Database " + data );
		});
	});
});
</script>