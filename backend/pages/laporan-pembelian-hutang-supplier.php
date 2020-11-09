<?php
$bulan_sekarang = date('m');
$kueri = "SELECT * FROM tbl_vendor ORDER BY nama_perusahaan ASC";
$q_list_supplier = mysqli_query($con, $kueri);
$q_list_supplier2 = mysqli_query($con, $kueri);
$q_list_supplier3 = mysqli_query($con, $kueri);
?>
<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h2 class="header">Laporan Pembelian Hutang Per Supplier</h2>
	</div>
</div>
<hr>
<div class="row">
	<!--div class="col-lg-11">
		<h4>Laporan Pembelian Hutang Harian</h4>
		<hr>
		<form class="form" action="laporan-pembelian-hutang-harian-supplier.php" method="post" target="_blank" autocomplete="off">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Supplier</span>
					<select class="form-control" id="id_supplier_harian" name="id_supplier_harian">
					<?php
					while($data_list = mysqli_fetch_assoc($q_list_supplier)){
						$id_vendor_harian = $data_list['id_vendor'];
						$nama_perusahaan = $data_list['nama_perusahaan'];
					?>
						<option value="<?=$id_vendor_harian;?>"><?=$nama_perusahaan;?></option>
					<?php
					}
					?>
					</select>
					<span class="input-group-addon">Tanggal</span>
					<input id="tanggal_harian" name="tanggal_harian" type="text" maxlength="10" class="form-control" placeholder="Tanggal">
					<div class="input-group-btn">
						<button type="submit" class="btn btn-primary">Tampilkan</button>
					</div>
				</div>
			</div>
		</form>
	</div-->
	<div class="col-lg-11">
		<h4>Laporan Pembelian Hutang Bulanan</h4>
		<hr>
		<form class="form-inline" action="laporan-pembelian-hutang-bulanan-supplier.php" method="post" target="_blank" autocomplete="off">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Supplier</span>
					<select class="form-control" id="id_supplier_bulanan" name="id_supplier_bulanan">
					<?php
					while($data_list = mysqli_fetch_assoc($q_list_supplier2)){
						$id_vendor_harian = $data_list['id_vendor'];
						$nama_perusahaan = $data_list['nama_perusahaan'];
					?>
						<option value="<?=$id_vendor_harian;?>"><?=$nama_perusahaan;?></option>
					<?php
					}
					?>
					</select>
					<span class="input-group-addon">Bulan</span>
					<select id="bulan" name="bulan" class="form-control">
						<option value="1">Januari</option>
						<option value="2">Febuari</option>
						<option value="3">Maret</option>
						<option value="4">April</option>
						<option value="5">Mei</option>
						<option value="6">Juni</option>
						<option value="7">Juli</option>
						<option value="8">Agustus</option>
						<option value="9">September</option>
						<option value="10">Oktober</option>
						<option value="11">November</option>
						<option value="12">Desember</option>
					</select>
					<div class="input-group-btn">
						<button type="submit" class="btn btn-primary">Tampilkan</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-lg-11">
		<h4>Laporan Pembelian Hutang Berjarak</h4>
		<hr>
		<form class="form-inline" action="laporan-pembelian-hutang-berjarak-supplier.php" method="post" target="_blank" autocomplete="off">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Supplier</span>
					<select class="form-control" id="id_supplier_berjarak" name="id_supplier_berjarak">
					<?php
					while($data_list = mysqli_fetch_assoc($q_list_supplier3)){
						$id_vendor_harian = $data_list['id_vendor'];
						$nama_perusahaan = $data_list['nama_perusahaan'];
					?>
						<option value="<?=$id_vendor_harian;?>"><?=$nama_perusahaan;?></option>
					<?php
					}
					?>
					</select>
					<span class="input-group-addon">Tanggal Awal</span>
					<input id="tanggal_awal" name="tanggal_awal" type="text" maxlength="10" class="form-control">
					<span class="input-group-addon">Tanggal Akhir</span>
					<input id="tanggal_akhir" name="tanggal_akhir" type="text" maxlength="10" class="form-control">
					<div class="input-group-btn">
						<button type="submit" class="btn btn-primary">Tampilkan</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
</div>