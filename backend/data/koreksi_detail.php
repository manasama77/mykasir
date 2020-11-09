<?php
include("../../config.php");

$chain = $_REQUEST['chain'];
$kode_transaksi = $_REQUEST['kode_transaksi'];
$tanggal_transaksi = $_REQUEST['tanggal_transaksi'];

$q_list_koreksi = mysqli_query($con, "SELECT
p.kode_produk,
p.nama_produk,
lk.qty,
lk.keterangan,
lk.purpose
FROM
tbl_list_koreksi AS lk
LEFT JOIN tbl_produk AS p ON p.id_produk = lk.id_produk
WHERE lk.chain_koreksi = '$chain'");
?>
<table class="table table-hover small">
	<tbody>
		<tr>
			<th style="width:150px">Kode Transaksi</th>
			<td style="width:10px">:</td>
			<td><?=$kode_transaksi;?></td>
		</tr>
		<tr>
			<th style="width:150px">Tanggal Transaksi</th>
			<td style="width:10px">:</td>
			<td><?=$tanggal_transaksi;?></td>
		</tr>
		<tr>
			<td colspan="3"><hr style="margin-top:0px; margin-bottom:0px;"></td>
		</tr>
	</tbody>
</table>
<table class="table table-bordered small">
	<thead>
		<tr>
			<th>Kode Produk</th>
			<th>Nama Produk</th>
			<th>Qty</th>
			<th>Purpose</th>
			<th>Keterangan</th>
		</tr>
	</thead>
		<?php
		while($data_koreksi = mysqli_fetch_array($q_list_koreksi)){
		?>
		<tr>
			<td><?=$data_koreksi['kode_produk'];?></td>
			<td><?=$data_koreksi['nama_produk'];?></td>
			<td><?=$data_koreksi['qty'];?></td>
			<td><?=$data_koreksi['purpose'];?></td>
			<td><?=$data_koreksi['keterangan'];?></td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>