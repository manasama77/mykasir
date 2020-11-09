<?php
include("../../config.php");

$id = $_REQUEST['id'];
$q_produk = mysqli_query($con, "SELECT
tbl_produk.id_produk,
tbl_produk.barcode,
tbl_produk.kode_produk,
tbl_produk.nama_produk,
tbl_produk.alias,
tbl_produk.hpp,
tbl_produk.hpj,
tbl_produk.hpg,
tbl_produk.margin,
tbl_produk.margin2,
tbl_produk.qty,
tbl_produk.foto,
tbl_kategori_produk.nama AS nama_kategori,
tbl_satuan_produk.nama AS nama_satuan
FROM
tbl_produk
Left Join tbl_kategori_produk ON tbl_produk.id_kategori_produk = tbl_kategori_produk.id_kategori_produk
Left Join tbl_satuan_produk ON tbl_produk.id_satuan_produk = tbl_satuan_produk.id_satuan_produk
WHERE tbl_produk.id_produk = '$id'");

$fa_produk = mysqli_fetch_array($q_produk);
$barcode = $fa_produk['barcode'];
$kode_produk = $fa_produk['kode_produk'];
$nama_produk = $fa_produk['nama_produk'];
$alias = $fa_produk['alias'];
$nama_kategori = $fa_produk['nama_kategori'];
$nama_satuan = $fa_produk['nama_satuan'];
$hpp = $fa_produk['hpp'];
$hpj = $fa_produk['hpj'];
$hpg = $fa_produk['hpg'];
$margin = $fa_produk['margin'];
$margin2 = $fa_produk['margin2'];
$qty = $fa_produk['qty'];
$foto = $fa_produk['foto'];
?>
<table class="table table-hover small">
	<tbody>
		<tr>
			<th style="width:150px">Barcode</th>
			<td style="width:10px">:</td>
			<td><?=$barcode;?></td>
		</tr>
		<tr>
			<th style="width:150px">Kode Produk</th>
			<td style="width:10px">:</td>
			<td><?=$kode_produk;?></td>
		</tr>
		<tr>
			<th style="width:150px">Nama Produk</th>
			<td style="width:10px">:</td>
			<td><?=$nama_produk;?></td>
		</tr>
		<tr>
			<th style="width:150px">Alias</th>
			<td style="width:10px">:</td>
			<td><?=$alias;?></td>
		</tr>
		<tr>
			<th style="width:150px">Kategori</th>
			<td style="width:10px">:</td>
			<td><?=$nama_kategori;?></td>
		</tr>
		<tr>
			<th style="width:150px">Harga Beli</th>
			<td style="width:10px">:</td>
			<td><?=number_format($hpp,2);?></td>
		</tr>
		<tr>
			<th style="width:150px">Harga Jual</th>
			<td style="width:10px">:</td>
			<td><?=number_format($hpj,2);?> - Margin (<?=$margin;?>)</td>
		</tr>
		<tr>
			<th style="width:150px">Harga Grosir</th>
			<td style="width:10px">:</td>
			<td><?=number_format($hpg,2);?> - Margin (<?=$margin2;?>)</td>
		</tr>
		<tr>
			<th style="width:150px">Qty</th>
			<td style="width:10px">:</td>
			<td><?=number_format($qty,0);?> <?=$nama_satuan;?></td>
		</tr>
		<tr>
			<td colspan="3"><hr style="margin-top:0px; margin-bottom:0px;"></td>
		</tr>
		<tr>
			<th style="width:150px">Foto Produk</th>
			<td style="width:10px">:</td>
			<td><img src="<?=$foto;?>" width="100px"></td>
		</tr>
	</tbody>
</table>