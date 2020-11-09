<?php
$q_kadarluarsa = mysqli_query($con, "SELECT
tbl_produk.kode_produk,
tbl_produk.nama_produk,
tbl_kadarluarsa.id_kadarluarsa,
tbl_kadarluarsa.kadarluarsa
FROM
tbl_kadarluarsa
Left Join tbl_produk ON tbl_produk.id_produk = tbl_kadarluarsa.id_produk
ORDER BY tbl_kadarluarsa.kadarluarsa ASC");
$nm_kadarluarsa = mysqli_num_rows($q_kadarluarsa);
?>
<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h2 class="header">List Kadarluarsa Produk</h2>
	</div>
	<?php
	include("alert.php");
	?>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table id="kadarluarsaList" class="table table-bordered table-striped small" style="width:100%;">
				<thead>
					<tr>
						<th>ID</th>
						<th>Kode Produk</th>
						<th>Nama Produk</th>
						<th>Tanggal Kadarluarsa</th>
						<th><i class="fa fa-gear"></i></th>
					</tr>
				</thead>
				<tbody>
				<?php
				if($nm_kadarluarsa == 0){
				?>
					<tr>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
				<?php
				}else{
					while($fa_kadarluarsa = mysqli_fetch_array($q_kadarluarsa)){
						$id_kadarluarsa = $fa_kadarluarsa['id_kadarluarsa'];
						$kadarluarsa = $fa_kadarluarsa['kadarluarsa'];
						$kode_produk = $fa_kadarluarsa['kode_produk'];
						$nama_produk = $fa_kadarluarsa['nama_produk'];
						$current_date = date('Y-m-d');
						
						$date_a = date_create($kadarluarsa);
						$date_b = date_create($current_date);
						
						$diff = date_diff($date_a, $date_b);
						$jarak = $diff->format("%R%a");
						
						if($jarak >= -60){
							$warna = "style=\"background-color:red;\"";
						}else{
							$warna = "";
						}
				?>
					<tr <?=$warna;?>>
						<td><?=$id_kadarluarsa;?></td>
						<td><?=$kode_produk;?></td>
						<td><?=$nama_produk;?></td>
						<td><?=$kadarluarsa;?></td>
						<td>
							<a href="delete.php?table=kadarluarsa&id=<?=$id_kadarluarsa;?>&page=kadarluarsa-list" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Produk <?=$nama_produk;?> <?=$kadarluarsa;?>?')">
								<i class="fa fa-trash"></i>
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

<!-- Modal -->
<div id="produkModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">Produk Info</h4>
			</div>
			<div class="modal-body" id="vProduk">
				<p>Some text in the modal.</p>
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