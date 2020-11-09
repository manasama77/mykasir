<?php
include("../../config.php");

$kode = $_REQUEST['kode'];
$q_penjualan = mysqli_query($con, "(SELECT
t1.kode_penjualan,
t1.status,
t1.tanggal_pelunasan,
t1.tanggal_jatuh_tempo,
t1.catatan,
t1.sub_total,
t1.grand_total,
t1.discount_persen,
t1.discount_rp,
t1.ppn,
t1.harga_ppn,
t1.pembayaran,
t1.kembalian
FROM
tbl_penjualan AS t1
WHERE t1.kode_penjualan = '$kode')
UNION
(SELECT
t2.kode_penjualan,
t2.status,
t2.tanggal_pelunasan,
t2.tanggal_jatuh_tempo,
t2.catatan,
t2.sub_total,
t2.grand_total,
t2.discount_persen,
t2.discount_rp,
t2.ppn,
t2.harga_ppn,
t2.pembayaran,
t2.kembalian
FROM
tbl_penjualan_hutang AS t2
WHERE t2.kode_penjualan = '$kode')");

$fa_penjualan = mysqli_fetch_array($q_penjualan);
$kode_penjualan = $fa_penjualan['kode_penjualan'];
$status = $fa_penjualan['status'];
$tanggal_pelunasan = $fa_penjualan['tanggal_pelunasan'];
$tanggal_jatuh_tempo = $fa_penjualan['tanggal_jatuh_tempo'];
$catatan = $fa_penjualan['catatan'];
$sub_total = $fa_penjualan['sub_total'];
$grand_total = $fa_penjualan['grand_total'];
$discount_persen = $fa_penjualan['discount_persen'];
$discount_rp = $fa_penjualan['discount_rp'];
$ppn = $fa_penjualan['ppn'];
$harga_ppn = $fa_penjualan['harga_ppn'];
$pembayaran = $fa_penjualan['pembayaran'];
$kembalian = $fa_penjualan['kembalian'];
?>
<table class="table table-borderless table-condensed small">
	<tbody>
		<tr>
			<th style="width:150px">Kode Penjualan</th>
			<td style="width:10px">:</td>
			<td><?=$kode_penjualan;?></td>
		</tr>
		<tr>
			<th style="width:150px">Status</th>
			<td style="width:10px">:</td>
			<td><?=strtoupper($status);?></td>
		</tr>
		<tr>
			<th style="width:150px">Tanggal Pelunasan</th>
			<td style="width:10px">:</td>
			<td><?=$tanggal_pelunasan;?></td>
		</tr>
		<tr>
			<th style="width:150px">Tanggal Jatuh Tempo</th>
			<td style="width:10px">:</td>
			<td><?=$tanggal_jatuh_tempo;?></td>
		</tr>
		<tr>
			<th style="width:150px">Catatan</th>
			<td style="width:10px">:</td>
			<td><?=$catatan;?></td>
		</tr>
		<tr>
			<td colspan="3"><hr style="margin-top:0px; margin-bottom:0px;"></td>
		</tr>
	</tbody>
</table>
<table class="table table-bordered table-condensed small">
<thead>
	<tr>
		<th style="text-align:center;">#</th>
		<th style="text-align:center;">Nama Produk</th>
		<th style="text-align:center;">Qty</th>
		<th style="text-align:center;">Harga Jual</th>
		<th style="text-align:center;">Discount (%)</th>
		<th style="text-align:center;">Discount (Rp)</th>
		<th style="text-align:center;">Total Harga</th>
	</tr>
</thead>
<tbody>
<?php
$no = 0;
$q_list = mysqli_query($con, "(SELECT
lp.*
FROM tbl_list_penjualan AS lp
WHERE lp.kode_penjualan = '$kode_penjualan')
UNION
(SELECT
lp2.*
FROM tbl_list_penjualan_hutang AS lp2
WHERE lp2.kode_penjualan = '$kode_penjualan')");
while($data_list = mysqli_fetch_assoc($q_list)){
	$no++;
	$nama_produk = $data_list['nama_produk'];
	$qty = $data_list['qty'];
	$satuan = $data_list['satuan'];
	$hpj = $data_list['hpj'];
	$total_harga = $data_list['total_harga'];
	$discount = $data_list['discount'];
	$discount_rp = $data_list['discount_rp'];
?>
	<tr>
		<td style="text-align:center;"><?=$no;?></td>
		<td style="text-align:center;"><?=$nama_produk;?></td>
		<td style="text-align:center;"><?=number_format($qty,2);?> <?=$satuan;?></td>
		<td style="text-align:right;"><?=number_format($hpj,2);?></td>
		<td style="text-align:right;"><?=number_format($discount,2);?></td>
		<td style="text-align:right;"><?=number_format($discount_rp,2);?></td>
		<td style="text-align:right;"><?=number_format($total_harga,2);?></td>
	</tr>
<?php
}

$q_list_event = mysqli_query($con, "SELECT
*
FROM tbl_list_penjualan_event AS lpe
WHERE lpe.kode_penjualan = '$kode_penjualan'
AND lpe.tipe = '4'");
while($data_list_event = mysqli_fetch_assoc($q_list_event)){
	$no++;
	$nama_produk_event = $data_list_event['nama_produk'];
	$qty_event = $data_list_event['qty'];
	$satuan_event = $data_list_event['satuan'];
	$hpj_event = $data_list_event['hpj'];
	$total_harga_event = $data_list_event['total_harga'];
	$discount_event = $data_list_event['discount'];
	$discount_rp_event = $data_list_event['discount_rp'];
?>
	<tr>
		<td style="text-align:center;"><?=$no;?></td>
		<td style="text-align:center;"><?=$nama_produk_event;?></td>
		<td style="text-align:center;"><?=number_format($qty_event,2);?> <?=$satuan_event;?></td>
		<td style="text-align:right;"><?=number_format($hpj_event,2);?></td>
		<td style="text-align:right;"></td>
		<td style="text-align:right;"></td>
		<td style="text-align:right;"><?=number_format($total_harga_event,2);?></td>
	</tr>
<?php
}
?>
</tbody>
<tfoot>
	<tr>
		<th colspan="6" style="text-align:right;">Sub Total</th>
		<th style="text-align:right;"><?=number_format($sub_total,2);?></th>
	</tr>
<?php
if($discount_persen != 0){
?>
	<tr>
		<th colspan="6" style="text-align:right;">Discount <?=$discount_persen;?>%</th>
		<th style="text-align:right;"><?=number_format($discount_rp,2);?></th>
	</tr>
<?php
}
?>
<?php
if($ppn != 0){
?>
	<tr>
		<th colspan="6" style="text-align:right;">PPN 10%</th>
		<th style="text-align:right;"><?=number_format($harga_ppn,2);?></th>
	</tr>
<?php
}
?>
	<tr>
		<th colspan="6" style="text-align:right;">Pembayaran</th>
		<th style="text-align:right;"><?=number_format($pembayaran,2);?></th>
	</tr>
	<tr>
		<th colspan="6" style="text-align:right;">Kembalian</th>
		<th style="text-align:right;"><?=number_format($kembalian,2);?></th>
	</tr>
	<tr>
		<th colspan="6" style="text-align:right;">Grand Total</th>
		<th style="text-align:right;"><?=number_format($grand_total,2);?></th>
	</tr>
</tfoot>
</table>