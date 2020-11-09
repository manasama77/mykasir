<?php
include("../../config.php");

$id_produk = $_REQUEST['id_produk'];
$q_produk = mysqli_query($con, "SELECT
tbl_satuan_produk.nama AS nama_satuan
FROM
tbl_produk
Left Join tbl_satuan_produk ON tbl_produk.id_satuan_produk = tbl_satuan_produk.id_satuan_produk
WHERE tbl_produk.id_produk = '$id_produk'");

$nr_produk = mysqli_num_rows($q_produk);
$fa_produk = mysqli_fetch_array($q_produk);
$nama_satuan = $fa_produk['nama_satuan'];
?>
<link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
<?php
if($nr_produk == 0){
	echo "Unit";
}else{
	echo $nama_satuan;
}
?>
<!-- Bootstrap Core JavaScript -->
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>