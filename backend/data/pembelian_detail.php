<?php
include("../../config.php");

$id = $_REQUEST['id'];
$q_pembelian = mysqli_query($con, "SELECT
*
FROM
tbl_pembelian
LEFT JOIN tbl_vendor ON tbl_vendor.id_vendor = tbl_pembelian.id_vendor
WHERE tbl_pembelian.id_pembelian = '$id'");

$fa_pembelian = mysqli_fetch_array($q_pembelian);
$kode_pembelian = $fa_pembelian['kode_pembelian'];
$tanggal_order = $fa_pembelian['tanggal_order'];
$sub_total = $fa_pembelian['sub_total'];
$harga_ppn = $fa_pembelian['harga_ppn'];
$grand_total = $fa_pembelian['grand_total'];

$q_list = mysqli_query($con, "SELECT
tbl_list_pembelian.id_pembelian,
tbl_list_pembelian.qty,
tbl_list_pembelian.hpp,
tbl_list_pembelian.hpj,
tbl_list_pembelian.hpg,
tbl_list_pembelian.discount_persen,
tbl_list_pembelian.discount_rp,
tbl_list_pembelian.harga_beli_nett,
tbl_list_pembelian.total_harga_beli,
tbl_produk.barcode,
tbl_produk.kode_produk,
tbl_produk.nama_produk
FROM tbl_list_pembelian
LEFT JOIN tbl_produk ON tbl_produk.id_produk = tbl_list_pembelian.id_produk
WHERE tbl_list_pembelian.id_pembelian = '$id'");
?>
<table class="table table-hover small">
	<tbody>
		<tr>
			<th style="width:150px">Tanggal Order</th>
			<td style="width:10px">:</td>
			<td><?=$tanggal_order;?></td>
		</tr>
		<tr>
			<th style="width:150px">Kode Pembelian</th>
			<td style="width:10px">:</td>
			<td><?=$kode_pembelian;?></td>
		</tr>
		<tr>
			<td colspan="3"><hr style="margin-top:0px; margin-bottom:0px;"></td>
		</tr>
	</tbody>
</table>

<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<th style="text-align:center;">Barcode - <?=$id;?></th>
			<th style="text-align:left;">Nama Produk</th>
			<th style="text-align:right;">Qty</th>
			<th style="text-align:right;">Harga Beli</th>
			<th style="text-align:right;">Harga Jual</th>
			<th style="text-align:right;">Harga Grosir</th>
			<th style="text-align:right;">Discount (%)</th>
			<th style="text-align:right;">Discount (Rp)</th>
			<th style="text-align:right;">Harga Beli Nett</th>
			<th style="text-align:right;">Total Harga Beli</th>
		</tr>
	</thead>
	<tbody>
	<?php
	while($data_list = mysqli_fetch_array($q_list)){
		$barcode = $data_list['barcode'];
		$kode_produk = $data_list['kode_produk'];
		$nama_produk = $data_list['nama_produk'];
		$qty = $data_list['qty'];
		$hpp = $data_list['hpp'];
		$hpj = $data_list['hpj'];
		$hpg = $data_list['hpg'];
		$discount_persen = $data_list['discount_persen'];
		$discount_rp = $data_list['discount_rp'];
		$harga_beli_nett = $data_list['harga_beli_nett'];
		$total_harga_beli = $data_list['total_harga_beli'];
	?>
		<tr>
			<td style="text-align:center;"><?=$barcode;?></td>
			<td style="text-align:left;"><?=$kode_produk;?> - <?=$nama_produk;?></td>
			<td style="text-align:right;"><?=number_format($qty,0);?></td>
			<td style="text-align:right;"><?=number_format($hpp,2);?></td>
			<td style="text-align:right;"><?=number_format($hpj,2);?></td>
			<td style="text-align:right;"><?=number_format($hpg,2);?></td>
			<td style="text-align:right;"><?=number_format($discount_persen,0);?></td>
			<td style="text-align:right;"><?=number_format($discount_rp,2);?></td>
			<td style="text-align:right;"><?=number_format($harga_beli_nett,2);?></td>
			<td style="text-align:right;"><?=number_format($total_harga_beli,2);?></td>
		</tr>
	<?php
	}
	?>
		<tr>
			<th style="text-align:right" colspan="9">Sub Total</th>
			<td style="text-align:right"><?=number_format($sub_total,2);?></td>
		</tr>
		<tr>
			<th style="text-align:right" colspan="9">PPN 10%</th>
			<td style="text-align:right"><?=number_format($harga_ppn,2);?></td>
		</tr>
		<tr>
			<th style="text-align:right" colspan="9">Grand Total</th>
			<td style="text-align:right"><?=number_format($grand_total,2);?></td>
		</tr>
	</tbody>
</table>