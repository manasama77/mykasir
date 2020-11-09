<?php
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$id_user = $_SESSION['id_user'];

$q_clear = mysqli_query($con, "DELETE FROM tbl_list_koreksi WHERE status = '0' AND id_create = '$id_user'");

$q_produk = mysqli_query($con, "SELECT * FROM tbl_produk ORDER BY nama_produk ASC");
$chain_koreksi = generateRandomString(50);
?>
<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h1 class="header">Koreksi Stock Barang</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading" style="text-align:right;">
				<button id="simpan_koreksi" type="button" class="btn btn-success btn-outline" onClick="simpan_koreksi();">
					<i class="fa fa-save fa-fw"></i> Simpan Data Koreksi
				</button>
			</div>
			<div class="panel-body">
				 <form id="tambah-koreksi" class="form-horizontal" method="POST" autocomplete="off">
					<div class="form-group">
						<label class="control-label col-lg-2" for="pwd">Produk :</label>
						<div class="col-lg-10">
							<select id="id_produk" name="id_produk" class="form-control input-sm" style="width:100%" required>
								<option value="">-</option>
							<?php
							while($fa_produk = mysqli_fetch_array($q_produk)){
								$id_produk = $fa_produk['id_produk'];
								$kode_produk = $fa_produk['kode_produk'];
								$nama_produk = $fa_produk['nama_produk'];
							?>
								<option value="<?=$id_produk;?>"><?=$nama_produk;?> (<?=$kode_produk;?>)</option>
							<?php
							}
							?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" for="pwd">Purpose :</label>
						<div class="col-lg-10">
							<select id="purpose" name="purpose" class="form-control" required>
								<option value=""></option>
								<option value="hilang">Hilang</option>
								<option value="expired">Expired</option>
								<option value="retur">Retur</option>
								<option value="koreksimin">Koreksi Pengurangan</option>
								<option value="koreksiplus">Koreksi Penambahan</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" for="pwd">Qty :</label>
						<div class="col-lg-10">
							<input type="number" id="qty" name="qty" class="form-control" min="1" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" for="pwd">Keterangan :</label>
						<div class="col-lg-10">
							<textarea id="keterangan" name="keterangan" class="form-control" onClick="iseng();"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-9">
							<input type="hidden" id="tanggal_transaksi" name="tanggal_transaksi" value="<?=date('Y-m-d');?>">
							<input type="hidden" id="id_create" name="id_create" value="<?=$_SESSION['id_user'];?>">
							<input type="hidden" id="chain_koreksi" name="chain_koreksi" value="<?=$chain_koreksi;?>">
							<button id="simpan_koreksi_produk" type="button" class="btn btn-primary" onClick="simpan_list_koreksi();">
								<i class="fa fa-plus fa-fw"></i> Tambah Koreksi Produk Stock
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!--div class="panel panel-info">
			<div class="panel-body"-->
				<table id="listKoreksi" name="listKoreksi2" class="table table-bordered table-striped small">
				</table>
			<!--/div>
		</div-->
	</div>
</div>
</div>
</div>