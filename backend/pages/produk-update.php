<?php
include("../../config.php");

$id = $_POST['id'];
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
				header("location:index.php?page=produk-edit&error=failed_insert_db&id=$id");
			}else{
				$uploadOk = 1;
			}
			
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				header("location:index.php?page=produk-edit&error=failed_insert_db&id=$id");
			}else{
				$uploadOk = 1;
			}
			
		}else{
			//$uploadOk = 0;
			header("location:index.php?page=produk-edit&error=failed_insert_db&id=$id");
		}
	}

	$simpan_foto = $target_dir.$foto["name"];

	if($uploadOk == 1){
		if (move_uploaded_file($foto["tmp_name"], $target_file)) {
			$uploadDone = 1;
		} else {
			header("location:index.php?page=produk-edit&error=failed_insert_db");
		}
	}
}else{
	$uploadDone = 0;
}

if($uploadDone == 1){
	$kueri = mysqli_query($con, "UPDATE tbl_produk SET barcode = '$barcode', nama_produk = '$nama_produk', alias = '$alias', id_kategori_produk = '$id_kategori_produk', id_satuan_produk = '$id_satuan_produk', hpp = '$hpp', hpj = '$hpj', hpg = '$hpg', margin = '$margin', margin2 = '$margin2', foto = '$simpan_foto', date_update = '$date_create', id_update = '$id_create' WHERE id_produk = '$id'");

	if($kueri){
		header("location:index.php?page=produk-list&success=update");
	}else{
		header("location:index.php?page=produk-edit&error=failed_insert_db2&id=$id");
	}
	echo "a";
}else{
	$kueri = mysqli_query($con, "UPDATE tbl_produk SET barcode = '$barcode', nama_produk = '$nama_produk', alias = '$alias', id_kategori_produk = '$id_kategori_produk', id_satuan_produk = '$id_satuan_produk', hpp = '$hpp', hpj = '$hpj', hpg = '$hpg', margin = '$margin', margin2 = '$margin2', date_update = '$date_create', id_update = '$id_create' WHERE id_produk = '$id'");

	if($kueri){
		header("location:index.php?page=produk-list&success=update");
	}else{
		header("location:index.php?page=produk-edit&error=failed_insert_db3&id=$id");
	}
}
?>