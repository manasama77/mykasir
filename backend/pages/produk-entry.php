<?php
include("../../config.php");

$barcode = $_POST['barcode'];
$nama_produk = $_POST['nama_produk'];
$alias = $_POST['alias'];
$id_kategori_produk = $_POST['id_kategori_produk'];
$id_satuan_produk = $_POST['id_satuan_produk'];
$hpp = $_POST['hpp'].".".$_POST['decimal_hpp'];
$hpj = $_POST['hpj'].".".$_POST['decimal_hpj'];
$hpg = $_POST['hpg'].".".$_POST['decimal_hpg'];
$margin = $_POST['margin'];
$margin2 = $_POST['margin2'];
$qty = "0";
$date_create = $_POST['date_create'];
$id_create = $_POST['id_create'];

$q_get_latest_id = mysqli_query($con, "SELECT id_produk AS lates_id FROM tbl_produk ORDER BY id_produk DESC LIMIT 1");
$fa_q_get_latest_id = mysqli_fetch_array($q_get_latest_id);
$lates_id = $fa_q_get_latest_id['lates_id'];
$lates_id = $lates_id + 1;

if($lates_id < 10){
	$running_number = "000".$lates_id;
}elseif($lates_id < 100){
	$running_number = "00".$lates_id;
}elseif($lates_id < 1000){
	$running_number = "0".$lates_id;
}elseif($lates_id < 10000){
	$running_number = $lates_id;
}else{
	header("location:index.php?page=produk-add&error=failed_insert_db");
}

$kode_produk = "B".$running_number;

$foto = $_FILES['foto'];
$foto_nama = $_FILES['foto']['name'];
if($foto_nama != null){
	$target_dir = "../data/upload/produk/";
	$target_file = $target_dir . basename($foto["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	// Check if image file is a actual image or fake image
	if(isset($nama_produk)){
		$check = getimagesize($foto["tmp_name"]);
		if($check !== false) {
			
			// Check file size
			if ($foto["size"] > 500000) {
				header("location:index.php?page=produk-add&error=failed_insert_db");
			}else{
				$uploadOk = 1;
			}
			
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				header("location:index.php?page=produk-add&error=failed_insert_db");
			}else{
				$uploadOk = 1;
			}
			
		}else{
			//$uploadOk = 0;
			header("location:index.php?page=produk-add&error=failed_insert_db");
		}
	}

	$simpan_foto = $target_dir.$foto["name"];

	if($uploadOk == 1){
		if (move_uploaded_file($foto["tmp_name"], $target_file)) {
			$uploadDone = 1;
		} else {
			header("location:index.php?page=produk-add&error=failed_insert_db");
		}
	}
}else{
	$uploadDone = 0;
}

if($uploadDone == 1){
	$q_insert_tbl_produk = mysqli_query($con, "INSERT INTO tbl_produk (id_produk, barcode, kode_produk, nama_produk, alias, id_kategori_produk, id_satuan_produk, hpp, hpj, hpg, margin, margin2, qty, foto, date_create, id_create) VALUES ('', '$barcode', '$kode_produk', '$nama_produk', '$alias', '$id_kategori_produk', '$id_satuan_produk', '$hpp', '$hpj', '$hpg', '$margin', '$margin2', '$qty', '$simpan_foto', '$date_create', '$id_create')");

	if($q_insert_tbl_produk){
		header("location:index.php?page=produk-list&success=add");
	}else{
		header("location:index.php?page=produk-add&error=failed_insert_db");
	}
}else{
	$q_insert_tbl_produk = mysqli_query($con, "INSERT INTO tbl_produk (id_produk, barcode, kode_produk, nama_produk, alias, id_kategori_produk, id_satuan_produk, hpp, hpj, hpg, margin, margin2, qty, date_create, id_create) VALUES ('', '$barcode', '$kode_produk', '$nama_produk', '$alias', '$id_kategori_produk', '$id_satuan_produk', '$hpp', '$hpj', '$hpg', '$margin', '$margin2', '$qty', '$date_create', '$id_create')");

	if($q_insert_tbl_produk){
		header("location:index.php?page=produk-list&success=add");
	}else{
		header("location:index.php?page=produk-add&error=failed_insert_db");
	}
}
?>