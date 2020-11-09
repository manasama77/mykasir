<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h1 class="header">Tambah Satuan Produk</h1>
	</div>
	<?php
	include("alert.php");
	?>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-body">
				 <form class="form-horizontal" action="satuan_produk-entry.php" method="POST" autocomplete="on">
					<div id="group_nama_satuan" class="form-group">
						<label class="col-lg-3 control-label">Nama Satuan Produk :</label>
						<div class="col-lg-9">
							<input type="nama" class="form-control input-sm" id="nama" name="nama" maxlength="25" onKeyUp="checkNamaKategori()" required autofocus autocomplete="off">
							<span id="helper_satuan" class="help-block" style="display:none;">Satuan Telah Digunakan</span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-3"></div>
						<div class="col-lg-9">
							<button id="simpan" type="submit" class="btn btn-primary" onclick="return confirm('Tambah Satuan Produk?')"><i class="fa fa-save"></i> Tambah Satuan Produk</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>