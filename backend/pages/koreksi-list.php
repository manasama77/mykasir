<?php
$q_koreksi = mysqli_query($con, "SELECT
k.kode_transaksi,
k.tanggal_transaksi,
k.id_koreksi,
k.chain_koreksi
FROM
tbl_koreksi AS k");
$nm_koreksi = mysqli_num_rows($q_koreksi);
?>
<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h2 class="header">List Koreksi Stock</h2>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table id="koreksiList" class="table table-bordered table-striped small">
				<thead>
					<tr>
						<th>ID</th>
						<th>Kode Transaksi</th>
						<th>Tanggal Transaksi</th>
						<th><i class="fa fa-gear"></i></th>
					</tr>
				</thead>
				<tbody>
				<?php
				if($nm_koreksi == 0){
				?>
					<tr>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
				<?php
				}else{
					while($fa_koreksi = mysqli_fetch_array($q_koreksi)){
						$id_koreksi = $fa_koreksi['id_koreksi'];
						$kode_transaksi = $fa_koreksi['kode_transaksi'];
						$tanggal_transaksi = $fa_koreksi['tanggal_transaksi'];
						$chain_koreksi = $fa_koreksi['chain_koreksi'];
				?>
					<tr>
						<td><?=$id_koreksi;?></td>
						<td>
							<button class="btn btn-xs btn-primary btn-block" onClick="openModalKoreksi('<?=$chain_koreksi;?>', '<?=$kode_transaksi;?>', '<?=$tanggal_transaksi;?>');">
								<?=$kode_transaksi;?>
							</button>
						</td>
						<td><?=$tanggal_transaksi;?></td>
						<td>
							<a href="delete.php?table=koreksi&id=<?=$id_koreksi;?>&page=koreksi-list&chain_koreksi=<?=$chain_koreksi;?>">
								<button type="button" id="hapus" name="hapus" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Transaksi Koreksi <?=$kode_transaksi;?>?')">
									<i class="fa fa-trash"></i>
								</button>
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
<div id="koreksiModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">List Produk Koreksi</h4>
			</div>
			<div class="modal-body" id="vKoreksi">
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