<?php
$bulan_sekarang = date('m');
?>
<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h2 class="header">Laporan Bon Penjualan Hutang</h2>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-lg-12">
		<h4>Laporan bon Penjualan Hutang Berjarak</h4>
		<hr>
		<form class="form-inline" action="laporan-bon-penjualan-hutang-berjarak.php" method="post" target="_blank">
			<div class="form-group">
				<label>Tanggal Awal</label>
				<input id="tanggal_awal" name="tanggal_awal" type="text" maxlength="10" class="form-control input-sm">
				<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
				<label>Tanggal Akhir</label>
				<input id="tanggal_akhir" name="tanggal_akhir" type="text" maxlength="10" class="form-control input-sm">
				<button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
			</div>
		</form>
	</div>
</div>
</div>
</div>