<?php
$q_produk = mysqli_query($con, "SELECT * FROM tbl_produk");
$q_produk_2 = mysqli_query($con, "SELECT * FROM tbl_produk");
?>
<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h1 class="header">Add New Event</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-body">
				 <form class="form-horizontal" action="event-entry.php" method="POST" autocomplete="on">
					<div class="form-group">
						<label class="col-lg-3 control-label">Nama Event :</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="nama" name="nama" required placeholder="Nama Event" maxlength="50">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Nama Produk :</label>
						<div class="col-lg-9">
							<select id="id_produk" name="id_produk" class="form-control" style="width:100%;" onchange="resultTipe();" required>
							<?php
							while($fa_produk = mysqli_fetch_array($q_produk)){
								$id_produk = $fa_produk['id_produk'];
								$nama_produk = $fa_produk['nama_produk'];
							?>
								<option value="<?=$id_produk;?>"><?=$nama_produk;?></option>
							<?php
							}
							?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Tipe Event :</label>
						<div class="col-lg-9">
							<select id="tipe" name="tipe" class="form-control" required onchange="resultTipe();">
								<option value="">-</option>
								<option value="1">Discount</option>
								<option value="2">Potongan Harga</option>
								<option value="3">Free Produk</option>
							</select>
						</div>
					</div>
					<div id="qtyd" class="form-group hide">
						<label class="col-lg-3 control-label">Discount :</label>
						<div class="col-lg-9">
							<div class="input-group">
								<input type="number" class="form-control" id="discount" name="discount" placeholder="Discount Produk" min="1" max="99">
								<span class="input-group-addon">%</span>
							</div>
						</div>
					</div>
					<div id="qtyp" class="form-group hide">
						<label class="col-lg-3 control-label">Potongan Harga :</label>
						<div class="col-lg-9">
							<input type="number" class="form-control" id="potongan_harga" name="potongan_harga" placeholder="Potongan Harga Produk" min="1" max="99999">
						</div>
					</div>
					
					<div class="form-group hide freeproduct">
						<label class="col-lg-3 control-label">Minimal Pembelian :</label>
						<div class="col-lg-9">
							<div class="input-group">
								<input type="number" class="form-control" id="qty_minimal_pembelian" name="qty_minimal_pembelian" placeholder="Qty Minimal Pembelian" min="1" max="999">
								<span id="satuan_minimal" name="satuan_minimal" class="input-group-addon">Satuan</span>
							</div>
						</div>
					</div>
					<div class="form-group hide freeproduct">
						<label class="col-lg-3 control-label">Gratis Produk :</label>
						<div class="col-lg-9">
							<select id="id_produk_gratis" name="id_produk_gratis" class="form-control" style="width:100%;" onChange="satuanGratis();">
							<?php
							while($fa_produk_2 = mysqli_fetch_array($q_produk_2)){
								$id_produk_2 = $fa_produk_2['id_produk'];
								$nama_produk_2 = $fa_produk_2['nama_produk'];
							?>
								<option value="<?=$id_produk_2;?>"><?=$nama_produk_2;?></option>
							<?php
							}
							?>
							</select>
						</div>
					</div>
					<div class="form-group hide freeproduct">
						<label class="col-lg-3 control-label">Qty Gratis :</label>
						<div class="col-lg-9">
							<div class="input-group">
								<input type="number" class="form-control" id="qty_gratis" name="qty_gratis" placeholder="Qty Gratis" min="1" max="999">
								<span id="satuan_gratis" name="satuan_gratis" class="input-group-addon">Satuan</span>
							</div>
							<label class="checkbox-inline">
								<input id="akumulasi" name="akumulasi" type="hidden" value="no">
								<input id="akumulasi" name="akumulasi" type="checkbox" value="yes" checked>Berlaku Akumulasi
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Date Start Event:</label>
						<div class="col-lg-3">
							<input type="text" class="form-control input-sm" id="start_date" name="start_date" required placeholder="Tangal Awal Event" value="<?=date("Y-m-d");?>" data-date-format="yyyy-mm-dd">
						</div>
						<label class="col-lg-3 control-label">Date End Event:</label>
						<div class="col-lg-3">
							<input type="text" class="form-control input-sm" id="end_date" name="end_date" required placeholder="Tangal Akhir Event" value="<?=date("Y-m-d");?>" data-date-format="yyyy-mm-dd">
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-3"></div>
						<div class="col-lg-9">
							<button type="submit" class="btn btn-primary" onclick="return confirm('Tambah Event?')"><i class="fa fa-save"></i> Tambah Event</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>