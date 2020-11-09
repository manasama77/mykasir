<?php
$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "SELECT * FROM tbl_satuan_produk WHERE id_satuan_produk = '$id'");
$data = mysqli_fetch_assoc($kueri);
?>
<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h1 class="header">Edit Satuan Produk</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-body">
				 <form class="form-horizontal" action="satuan_produk-update.php" method="POST" autocomplete="on">
					<div id="group_nama_satuan" class="form-group">
						<label class="col-lg-3 control-label">Nama Satuan Produk :</label>
						<div class="col-lg-9">
							<input type="nama" class="form-control input-sm" id="nama" name="nama" maxlength="25" required autofocus autocomplete="off" value="<?=$data['nama'];?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-3"></div>
						<div class="col-lg-9">
							<input type="hidden" id="id" name="id" value="<?=$id;?>">
							<button id="simpan" type="submit" class="btn btn-primary" onclick="return confirm('Edit Satuan Produk?')"><i class="fa fa-save"></i> Edit Satuan Produk</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>