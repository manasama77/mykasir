<?php
$q_vendor = mysqli_query($con, "SELECT * FROM tbl_vendor");
?>
<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h1 class="header">Pembelian Produk</h1>
	</div>
	<?php
	include("alert.php");
	?>
</div>
<div class="row small">
	<div class="col-lg-12">
		<form id="pembelian_barang" class="form-horizontal" action="pembelian-entry.php" method="POST" autocomplete="on">
			<fieldset><legend>Informasi Pembelian</legend>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div class="form-group">
							<label class="col-lg-3 control-label">Tanggal Order:</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="tanggal_order" name="tanggal_order" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Supplier:</label>
							<div class="col-lg-9">
								<div class="input-group">
									<select id="id_vendor" name="id_vendor" class="form-control" required>
									<?php
									while($fa_q_vendor = mysqli_fetch_array($q_vendor)){
										$id_vendor = $fa_q_vendor['id_vendor'];
										$kode_vendor = $fa_q_vendor['kode_vendor'];
										$nama_perusahaan = $fa_q_vendor['nama_perusahaan'];
									?>
										<option value="<?=$id_vendor;?>"><?=$kode_vendor;?> - <?=$nama_perusahaan;?></option>
									<?php
									}
									?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">No Faktur Supplier / Vendor :</label>
							<div class="col-lg-9">
								<input type="text" class="form-control input-sm" id="no_faktur_vendor" name="no_faktur_vendor" required placeholder="No Faktur Supplier / Vendor">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Tanggal Jatuh Tempo :</label>
							<div class="col-lg-9">
								<input type="text" class="form-control input-sm" id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo" placeholder="Tanggal Jatuh Tempo">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Catatan :</label>
							<div class="col-lg-9">
								<textarea id="catatan" name="catatan" class="form-control" placeholder="Catatan"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">PPN 10%:</label>
							<div class="col-lg-9">
								<select id="ppn" name="ppn" class="form-control" onChange="checkPPN();">
									<option value="0">Tidak Menggunakan PPN</option>
									<option value="1">Menggunakan PPN 10%</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-3 col-lg-9">
								<input type="hidden" id="id_create" name="id_create" value="<?=$_SESSION['id_user'];?>">
								<button id="simpan_pembelian"  type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
		</form>
		
		<div class="row">
			<div class="col-lg-12">
				<button type="button" class="btn btn-primary" onClick="openModalTambahProduk();"><i class="fa fa-plus"></i> Tambah Daftar Pembelian Produk </button>
				<hr>
			</div>
		</div>
		<div id="listPembelian"></div>
	</div>
</div>

<!-- Modal -->
<div id="tambahProdukModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">Tambah Pembelian Produk</h4>
			</div>
			<div class="modal-body" id="vTambahProduk">
				<p>Loading... Please Wait...</p>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<!-- End Modal -->