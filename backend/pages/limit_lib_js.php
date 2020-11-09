<?php
if(isset($_REQUEST['page'])){
	if($_REQUEST['page'] == "produk-add"){
		echo "<script src=\"lib/produk.js\"></script>";
	}elseif($_REQUEST['page'] == "kategori_produk-add"){
		echo "<script src=\"lib/kategori_produk.js\"></script>";
	}elseif($_REQUEST['page'] == "satuan_produk-add"){
		echo "<script src=\"lib/satuan_produk.js\"></script>";
	}
}
?>