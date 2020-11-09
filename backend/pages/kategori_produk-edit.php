<?php
$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "SELECT * FROM tbl_kategori_produk WHERE id_kategori_produk = '$id'");
$data = mysqli_fetch_assoc($kueri);
?>
<div class="widget">
	<div class="widget-content">
	<div class="row">
	<div class="col-lg-12">
		<h1 class="header">Edit Kategori Produk</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-body">
				 <form class="form-horizontal" action="kategori_produk-update.php" method="POST" autocomplete="on">
					<div id="group_nama_kategori" class="form-group">
						<label class="col-lg-3 control-label">Nama Kategori Produk :</label>
						<div class="col-lg-9">
							<input type="nama" class="form-control input-sm" id="nama" name="nama" maxlength="25" required autofocus autocomplete="off" value="<?=$data['nama'];?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-3"></div>
						<div class="col-lg-9">
							<input type="hidden" id="id" name="id" value="<?=$id;?>">
							<button id="simpan" type="submit" class="btn btn-primary" onclick="return confirm('Edit Kategori Produk?')"><i class="fa fa-save"></i> Edit Kategori Produk</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>