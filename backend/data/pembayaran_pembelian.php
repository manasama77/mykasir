<?php
session_start();
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
$grand_total = $fa_pembelian['grand_total'];
$hutang = $fa_pembelian['hutang'];
$pembayaran = $fa_pembelian['pembayaran'];
$grand_total = $fa_pembelian['grand_total'];
?>
<link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
<style>
#ui-datepicker-div{
	z-index:5000 !important;
}
</style>
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
			<th style="width:150px">Terbayarkan</th>
			<td style="width:10px">:</td>
			<td><?=number_format($pembayaran,2);?></td>
		</tr>
		<tr>
			<th style="width:150px">Hutang</th>
			<td style="width:10px">:</td>
			<td><?=number_format($hutang,2);?></td>
		</tr>
		<tr>
			<th style="width:150px">Grand Total</th>
			<td style="width:10px">:</td>
			<td><?=number_format($grand_total,2);?></td>
		</tr>
		<tr>
			<td colspan="3"><hr style="margin-top:0px; margin-bottom:0px;"></td>
		</tr>
		<?php
		$explode_hutang = explode(".", $hutang);
		$hutang1 = $explode_hutang[0];
		$hutang2 = $explode_hutang[1];
		?>
		<tr>
			<th style="width:150px">
				Tanggal Pembayaran<br><br><br>
				Nominal Pembayaran
			</th>
			<td style="width:10px">
				:<br><br><br>
				:
			</td>
			<td>
			<form action="pembayaran_pembelian-entry.php" method="POST">
				<input type="text" id="tanggal_pelunasan" name="tanggal_pelunasan" class="form-control" required>
				<div class="input-group">
					<span class="input-group-addon">Rp.</span>
					<input type="number" min="0" max="<?=$hutang1;?>" class="form-control input-sm" id="pembayaran" name="pembayaran" placeholder="Pembayaran" required>
					<span class="input-group-addon">.</span>
					<input type="number" min="0" max="<?=$hutang2;?>" class="form-control input-sm" id="pembayaran_decimal" name="pembayaran_decimal" placeholder="Decimal">
				</div>
				<br>
				<input type="hidden" id="id" name="id" value="<?=$id;?>">
				<input type="hidden" id="kode_pembelian" name="kode_pembelian" value="<?=$kode_pembelian;?>">
				<input type="hidden" id="grand_total" name="grand_total" value="<?=$grand_total;?>">
				<input type="hidden" id="hutang" name="hutang" value="<?=$hutang;?>">
				<input type="hidden" id="id_create" name="id_create" value="<?=$_SESSION['id_user'];?>">
				<button type="submit" class="btn btn-primary"><i class="fa fa-money"></i> Bayar</button>
			</form>
			</td>
		</tr>
	</tbody>
</table>
<!-- Bootstrap Core JavaScript -->
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script>
$(function() {
	$( "#tanggal_pelunasan" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
});
</script>