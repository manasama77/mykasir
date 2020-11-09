<?php
$q_kategori = mysqli_query($con, "SELECT * FROM tbl_kategori_produk");
$q_satuan = mysqli_query($con, "SELECT * FROM tbl_satuan_produk");
?>
<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h1 class="header">Tambah Produk</h1>
	</div>
	<?php
	include("alert.php");
	?>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-body">
				 <form class="form-horizontal small" action="produk-entry.php" method="POST" autocomplete="on" oninput="resultMargin();" enctype="multipart/form-data">
					<div id="group_barcode" class="form-group">
						<label class="col-lg-2 control-label"><i class="fa fa-barcode fa-fw"></i> Barcode :</label>
						<div class="col-lg-10">
							<input type="text" class="form-control input-sm pass" id="barcode" name="barcode" maxlength="13" placeholder="Barcode Produk" onKeyUp="checkBarcode();" required autocomplete="off">
							<span id="helper_barcode" class="help-block" style="display:none;">Barcode Telah Digunakan</span>
						</div>
					</div>
					<hr>
					<div id="group_nama_produk" class="form-group">
						<label class="col-lg-2 control-label">Nama Produk :</label>
						<div class="col-lg-10">
							<input type="text" class="form-control input-sm pass" id="nama_produk" name="nama_produk" maxlength="50" placeholder="Nama Produk" onKeyUp="checkNamaProduk();" required autocomplete="off">
							<span id="helper_nama_produk" class="help-block" style="display:none;">Nama Produk Telah Digunakan</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Alias Produk :</label>
						<div class="col-lg-10">
							<input type="text" class="form-control input-sm" id="alias" name="alias" maxlength="15" placeholder="Alias Produk" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Kategori Produk :</label>
						<div class="col-lg-10">
							<select id="id_kategori_produk" name="id_kategori_produk" class="form-control" required>
								<option value="">-</option>
							<?php
							while($fa_kategori = mysqli_fetch_array($q_kategori)){
								$id_kategori = $fa_kategori['id_kategori_produk'];
								$nama_kategori = $fa_kategori['nama'];
							?>
								<option value="<?=$id_kategori;?>"><?=$nama_kategori;?></option>
							<?php
							}
							?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Satuan Produk :</label>
						<div class="col-lg-10">
							<select id="id_satuan_produk" name="id_satuan_produk" class="form-control" required>
								<option value="">-</option>
							<?php
							while($fa_satuan = mysqli_fetch_array($q_satuan)){
								$id_satuan = $fa_satuan['id_satuan_produk'];
								$nama_satuan = $fa_satuan['nama'];
							?>
								<option value="<?=$id_satuan;?>"><?=$nama_satuan;?></option>
							<?php
							}
							?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Harga Beli :</label>
						<div class="col-lg-10">
							<div class="input-group">
								<span class="input-group-addon">
									<strong>Rp.</strong>
								</span>
								<input type="number" class="form-control" id="hpp" name="hpp" min="0" max="999999999" placeholder="Harga Beli" required z-index="2">
								<span class="input-group-addon">
									<strong>.</strong>
								</span>
								<input type="number" class="form-control" id="decimal_hpp" name="decimal_hpp" min="0" max="99" placeholder="Decimal"style="width:150px">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Harga Jual :</label>
						<div class="col-lg-10">
							<div class="input-group">
								<span class="input-group-addon">
									<strong>Rp.</strong>
								</span>
								<input type="number" class="form-control" id="hpj" name="hpj" min="0" max="999999999" placeholder="Harga Jual" required>
								<span class="input-group-addon">
									<strong>.</strong>
								</span>
								<input type="number" class="form-control" id="decimal_hpj" name="decimal_hpj" min="0" max="99" placeholder="Decimal" style="width:150px">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Harga Grosir :</label>
						<div class="col-lg-10">
							<div class="input-group">
								<span class="input-group-addon">
									<strong>Rp.</strong>
								</span>
								<input type="number" class="form-control" id="hpg" name="hpg" min="0" max="999999999" placeholder="Harga Grosir" required>
								<span class="input-group-addon">
									<strong>.</strong>
								</span>
								<input type="number" class="form-control" id="decimal_hpg" name="decimal_hpg" min="0" max="99" placeholder="Decimal" style="width:150px">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Margin Jual :</label>
						<div class="col-lg-3">
							<p id="margin_show" name="margin_show" class="form-control-static">0.00 %</p>
						</div>
						<label class="col-lg-2 control-label">Margin Grosir :</label>
						<div class="col-lg-3">
							<p id="margin2_show" name="margin2_show" class="form-control-static">0.00 %</p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Foto Produk :</label>
						<div class="col-lg-10">
							<input type="file" class="" id="foto" name="foto" accept="image/*">
							<img id="thumbnail" src="#" alt="" />
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-2"></div>
						<div class="col-lg-10">
							<input type="hidden" id="margin" name="margin" value="">
							<input type="hidden" id="margin2" name="margin2" value="">
							<input type="hidden" id="date_create" name="date_create" value="<?=date("Y-m-d");?>">
							<input type="hidden" id="id_create" name="id_create" value="<?=$_SESSION["id_user"];?>">
							<button id="simpan" disabled type="submit" class="btn btn-primary" onclick="return confirm('Tambah Produk?')"><i class="fa fa-save"></i> Tambah Produk</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>