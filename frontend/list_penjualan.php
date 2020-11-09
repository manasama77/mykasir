<?php
include("../config.php");

$id_create = $_REQUEST['id_create'];
$kode_penjualan = $_REQUEST['kode_penjualan'];
$status = $_REQUEST['status'];

$q_list = mysqli_query($con, "SELECT
tbl_list_penjualan.id_list_penjualan,
tbl_list_penjualan.kode_penjualan,
tbl_list_penjualan.nama_produk,
tbl_list_penjualan.satuan,
tbl_list_penjualan.qty,
tbl_list_penjualan.hpj,
tbl_list_penjualan.total_harga,
tbl_list_penjualan.discount,
tbl_list_penjualan.discount_rp,
tbl_list_penjualan.hpj_nett,
tbl_produk.kode_produk
FROM tbl_list_penjualan
LEFT JOIN tbl_produk ON tbl_produk.id_produk = tbl_list_penjualan.id_produk
WHERE tbl_list_penjualan.status = '$status' AND tbl_list_penjualan.id_create = '$id_create' AND tbl_list_penjualan.kode_penjualan = '$kode_penjualan'");
$row = mysqli_num_rows($q_list);

$q_list_special = mysqli_query($con, "SELECT
tbl_list_penjualan_event.id_list_penjualan_event,
tbl_list_penjualan_event.tipe,
tbl_list_penjualan_event.kode_penjualan,
tbl_list_penjualan_event.id_produk,
tbl_list_penjualan_event.nama_produk,
tbl_list_penjualan_event.satuan,
tbl_list_penjualan_event.qty,
tbl_list_penjualan_event.hpj,
tbl_list_penjualan_event.harga_jual_nett,
tbl_list_penjualan_event.total_harga,
tbl_list_penjualan_event.`status`,
tbl_list_penjualan_event.id_create,
tbl_list_penjualan_event.date_create,
tbl_list_penjualan_event.jenis_pelanggan,
tbl_list_penjualan_event.kode_member,
tbl_list_penjualan_event.nama_member,
tbl_produk.kode_produk
FROM
tbl_list_penjualan_event
LEFT JOIN tbl_produk ON tbl_produk.id_produk = tbl_list_penjualan_event.id_produk
WHERE tbl_list_penjualan_event.status = '$status'
AND tbl_list_penjualan_event.id_create = '$id_create'
AND tbl_list_penjualan_event.kode_penjualan = '$kode_penjualan'
AND tbl_list_penjualan_event.tipe = '4'");
$row_special = mysqli_num_rows($q_list_special);

$q_list_hutang = mysqli_query($con, "SELECT
tbl_list_penjualan_hutang.id_list_penjualan_hutang,
tbl_list_penjualan_hutang.kode_penjualan,
tbl_list_penjualan_hutang.nama_produk,
tbl_list_penjualan_hutang.satuan,
tbl_list_penjualan_hutang.qty,
tbl_list_penjualan_hutang.hpj,
tbl_list_penjualan_hutang.total_harga,
tbl_produk.kode_produk
FROM tbl_list_penjualan_hutang
LEFT JOIN tbl_produk ON tbl_produk.id_produk = tbl_list_penjualan_hutang.id_produk
WHERE tbl_list_penjualan_hutang.status = '$status' AND tbl_list_penjualan_hutang.id_create = '$id_create' AND tbl_list_penjualan_hutang.kode_penjualan = '$kode_penjualan'");
$row_hutang = mysqli_num_rows($q_list_hutang);
?>
<table class="table table-bordered table-hover table-condensed table-striped small">
<thead>
	<tr>
		<th style="text-align:center;" width="10px"><i class="fa fa-gear"></th>
		<th style="text-align:center;">Kode Produk</th>
		<th style="text-align:center;">Nama Produk</th>
		<th style="text-align:center;">Satuan</th>
		<th style="text-align:center;">Qty</th>
		<th style="text-align:right;">Harga Jual</th>
		<th style="text-align:center;">Disc (%)</th>
		<th style="text-align:right;">Disc (Rp)</th>
		<th style="text-align:right;">Harga Jual (Nett)</th>
		<th style="text-align:right;">Total Harga</th>
	</tr>
</thead>
<tbody>
<?php
if($row != 0){
	while($data = mysqli_fetch_assoc($q_list)){
		$id_list_penjualan = $data['id_list_penjualan'];
		$kode_penjualan = $data['kode_penjualan'];
		$kode_produk = $data['kode_produk'];
		$nama_produk = $data['nama_produk'];
		$satuan = $data['satuan'];
		$qty = $data['qty'];
		$hpj = $data['hpj'];
		$total_harga = $data['total_harga'];
		$discount = $data['discount'];
		$discount_rp = $data['discount_rp'];
		$hpj_nett = $data['hpj_nett'];
?>
	<tr>
		<td style="text-align:center;">
			<button type="button" class="btn btn-danger btn-xs" style="font-size:10px;" onClick="hapusList('<?=$id_list_penjualan;?>');">
				<i class="fa fa-minus"></i>
			</button>
		</td>
		<td style="text-align:center;"><?=$kode_produk;?></td>
		<td style="text-align:center;"><?=$nama_produk;?></td>
		<td style="text-align:center;"><?=$satuan;?></td>
		<td style="text-align:center;"><?=number_format($qty,2);?></td>
		<td style="text-align:right;"><?=number_format($hpj,2);?></td>
		<td style="text-align:right;"><?=number_format($discount,2);?></td>
		<td style="text-align:right;"><?=number_format($discount_rp,2);?></td>
		<td style="text-align:right;"><?=number_format($hpj_nett,2);?></td>
		<td style="text-align:right;"><?=number_format($total_harga,2);?></td>
	</tr>
<?php
	}
}

if($row_special != 0){
	while($data_special = mysqli_fetch_assoc($q_list_special)){
		$id_list_penjualan_event = $data_special['id_list_penjualan_event'];
		$kode_produk_event = $data_special['kode_produk'];
		$nama_produk_event = $data_special['nama_produk'];
		$satuan_event = $data_special['satuan'];
		$qty_event = $data_special['qty'];
		$hpj_event = $data_special['hpj'];
		$hpj_nett_event = $data_special['harga_jual_nett'];
		$total_harga_event = $data_special['total_harga'];
?>
	<tr>
		<td style="text-align:center;">
			<button type="button" class="btn btn-danger btn-xs" style="font-size:10px;" onClick="hapusListEvent('<?=$id_list_penjualan_event;?>');">
				<i class="fa fa-minus"></i>
			</button>
		</td>
		<td style="text-align:center;"><?=$kode_produk_event;?></td>
		<td style="text-align:center;"><?=$nama_produk_event;?></td>
		<td style="text-align:center;"><?=$satuan_event;?></td>
		<td style="text-align:center;"><?=number_format($qty_event,2);?></td>
		<td style="text-align:right;"><?=number_format($hpj_event,2);?></td>
		<td style="text-align:right;"></td>
		<td style="text-align:right;"></td>
		<td style="text-align:right;"><?=number_format($hpj_nett_event,2);?></td>
		<td style="text-align:right;"><?=number_format($total_harga_event,2);?></td>
	</tr>
<?php
	}
}

if($row_hutang != 0){
	while($data_hutang = mysqli_fetch_assoc($q_list_hutang)){
		$id_list_penjualan_hutang = $data_hutang['id_list_penjualan_hutang'];
		$kode_produk_hutang = $data_hutang['kode_produk'];
		$nama_produk_hutang = $data_hutang['nama_produk'];
		$satuan_hutang = $data_hutang['satuan'];
		$qty_hutang = $data_hutang['qty'];
		$hpj_hutang = $data_hutang['hpj'];
		$total_harga_hutang = $data_hutang['total_harga'];
?>
	<tr>
		<td style="text-align:center;">
			<?php
			if($status == 0){
			?>
			<button type="button" class="btn btn-danger btn-xs" style="font-size:10px;" onClick="hapusListHutang('<?=$id_list_penjualan_hutang;?>');">
				<i class="fa fa-minus"></i>
			</button>
			<?php
			}
			?>
		</td>
		<td style="text-align:center;"><?=$kode_produk_hutang;?></td>
		<td style="text-align:center;"><?=$nama_produk_hutang;?></td>
		<td style="text-align:center;"><?=$satuan_hutang;?></td>
		<td style="text-align:center;"><?=number_format($qty_hutang,2);?></td>
		<td style="text-align:right;"><?=number_format($hpj_hutang,2);?></td>
		<td style="text-align:right;"></td>
		<td style="text-align:right;"></td>
		<td style="text-align:right;"><?=number_format($hpj_hutang,2);?></td>
		<td style="text-align:right;"><?=number_format($total_harga_hutang,2);?></td>
	</tr>
<?php
	}
}
?>
</tbody>
</table>