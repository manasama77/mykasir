<?php
session_start();
if($_SESSION['username'] == "" && $_SESSION['session_id'] == ""){
	header("location:../?error=3");
}else{
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="refresh" content="0;url=pages/index.html">
		<title>UD Mandiri Cahaya Abadi</title>
		<script language="javascript">
		window.location.href = "pages/"
		</script>
	</head>
	<body>
		Go to <a href="pages/">/pages/index.php</a>
	</body>
</html>
<?php
}
?>