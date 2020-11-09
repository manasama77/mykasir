<?php
$q_produk = mysqli_query($con, "SELECT
tbl_produk.id_produk,
tbl_produk.kode_produk,
tbl_produk.nama_produk,
tbl_produk.alias,
tbl_produk.hpp,
tbl_produk.hpj,
tbl_produk.hpg,
tbl_produk.margin,
tbl_produk.margin2,
tbl_produk.qty,
tbl_produk.foto,
tbl_kategori_produk.nama AS nama_kategori,
tbl_satuan_produk.nama AS nama_satuan
FROM
tbl_produk
Left Join tbl_kategori_produk ON tbl_produk.id_kategori_produk = tbl_kategori_produk.id_kategori_produk
Left Join tbl_satuan_produk ON tbl_produk.id_satuan_produk = tbl_satuan_produk.id_satuan_produk");
$nm_produk = mysqli_num_rows($q_produk);
?>
<div class="widget">
	<div class="widget-content">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="header">List Produk</h2>
			</div>
			<?php
			include("alert.php");
			?>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id="produkList" class="table table-bordered table-striped small" style="width:100%;">
						<thead>
							<tr>
								<th>ID</th>
								<th>Kode Produk</th>
								<th>Nama Produk</th>
								<th>Harga Beli</th>
								<th>Harga Jual</th>
								<th>Harga Grosir</th>
								<th>Kategori</th>
								<th>Stock</th>
								<th>Total HGB</th>
								<th width="50px" style="text-align:center;"><i class="fa fa-gear"></i></th>
							</tr>
						</thead>
						<!--tfoot>
							<tr>
								<th>ID</th>
								<th>Kode Produk</th>
								<th>Nama Produk</th>
								<th>Harga Beli</th>
								<th>Harga Jual</th>
								<th>Harga Grosir</th>
								<th>Kategori</th>
								<th>Stock</th>
								<th>Config</th>
							</tr>
						</tfoot-->
						<tbody>
						<?php
						if($nm_produk == 0){
						?>
							<tr>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						<?php
						}else{
							while($fa_produk = mysqli_fetch_array($q_produk)){
								$id_produk = $fa_produk['id_produk'];
								$kode_produk = $fa_produk['kode_produk'];
								$nama_produk = $fa_produk['nama_produk'];
								$hpp = $fa_produk['hpp'];
								$hpj = $fa_produk['hpj'];
								$hpg = $fa_produk['hpg'];
								$nama_kategori = $fa_produk['nama_kategori'];
								$nama_satuan = $fa_produk['nama_satuan'];
								$qty = $fa_produk['qty'];
								$foto = $fa_produk['foto'];
								
								if($qty != 0){
									$hapus_restrict = "disabled";
								}else{
									$hapus_restrict = "";
								}
						?>
							<tr>
								<td><?=$id_produk;?></td>
								<td>
									<button class="btn btn-xs btn-primary btn-block" onClick="openModalProduk(<?=$id_produk;?>);">
										<?=$kode_produk;?>
									</button>
								</td>
								<td><?=$nama_produk;?></td>
								<td><?=number_format($hpp,2);?></td>
								<td><?=number_format($hpj,2);?></td>
								<td><?=number_format($hpg,2);?></td>
								<td><?=$nama_kategori;?></td>
								<td><?=number_format($qty,1);?> <?=$nama_satuan;?></td>
								<td><?php $hgb=$hpp*$qty; ?> <?=number_format($hgb); ?></td>
								<td>
									<a href="delete.php?table=produk&id=<?=$id_produk;?>&page=produk-list" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Produk <?=$nama_produk;?>?')" <?=$hapus_restrict;?>>
										<i class="fa fa-trash"></i>
									</a>
									<a href="index.php?page=produk-edit&id=<?=$id_produk;?>" class="btn btn-primary btn-xs">
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

<!-- Modal -->
<div id="produkModal" tabindex="-1" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
				<h4 id="myModalLabel">Produk Info</h4>
			</div>
			<div class="modal-body" id="vProduk">
				<p>Loading... Please Wait...</p>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->