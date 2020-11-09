<?php
$q_satuan_produk = mysqli_query($con, "SELECT * FROM tbl_satuan_produk");
$nm_satuan_produk = mysqli_num_rows($q_satuan_produk);
?>
<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h2 class="header">List Satuan Produk</h2>
	</div>
	<?php
	include("alert.php");
	?>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table id="satuanList" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th style="width:50px;">ID</th>
						<th>Nama Satuan Produk</th>
						<th style="width:50px;text-align:center"><i class="fa fa-gear"></i></th>
					</tr>
				</thead>
				<tbody>
				<?php
				if($nm_satuan_produk == 0){
				?>
					<tr>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
				<?php
				}else{
					while($fa_satuan_produk = mysqli_fetch_array($q_satuan_produk)){
						$id_satuan_produk = $fa_satuan_produk['id_satuan_produk'];
						$nama = $fa_satuan_produk['nama'];
				?>
					<tr>
						<td><?=$id_satuan_produk;?></td>
						<td><?=$nama;?></td>
						<td>
							<a href="delete.php?table=satuan_produk&id=<?=$id_satuan_produk;?>&page=satuan_produk-list" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Satuan Produk <?=$nama;?>?')">
								<i class="fa fa-trash"></i>
							</a>
							<a href="index.php?page=satuan_produk-edit&id=<?=$id_satuan_produk;?>" class="btn btn-primary btn-xs">
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