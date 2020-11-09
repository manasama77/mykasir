<?php
$q_kategori_produk = mysqli_query($con, "SELECT * FROM tbl_kategori_produk");
$nm_kategori_produk = mysqli_num_rows($q_kategori_produk);
?>
<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h2 class="header">List Kategori Produk</h2>
	</div>
	<?php
	include("alert.php");
	?>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table id="kategoriList" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th style="width:50px;">ID</th>
						<th>Nama Kateogri Produk</th>
						<th style="width:50px;text-align:center;"><i class="fa fa-gear"></i></th>
					</tr>
				</thead>
				<tbody>
				<?php
				if($nm_kategori_produk == 0){
				?>
					<tr>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
				<?php
				}else{
					while($fa_kategori_produk = mysqli_fetch_array($q_kategori_produk)){
						$id_kategori_produk = $fa_kategori_produk['id_kategori_produk'];
						$nama = $fa_kategori_produk['nama'];
				?>
					<tr>
						<td><?=$id_kategori_produk;?></td>
						<td><?=$nama;?></td>
						<td>
							<a href="delete.php?table=kategori_produk&id=<?=$id_kategori_produk;?>&page=kategori_produk-list" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Kategori Produk <?=$nama;?>?')">
								<i class="fa fa-trash"></i>
							</a>
							<a href="index.php?page=kategori_produk-edit&id=<?=$id_kategori_produk;?>" class="btn btn-primary btn-xs">
								<i class="fa fa-pencil"></i>
							</a>
						</td>
					</tr>
				<?php
					}
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
</div>