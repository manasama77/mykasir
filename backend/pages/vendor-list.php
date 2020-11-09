<?php
$q_vendor = mysqli_query($con, "SELECT *
FROM tbl_vendor
LEFT JOIN tbl_provinsi ON tbl_vendor.id_provinsi = tbl_provinsi.id_provinsi
LEFT JOIN tbl_kota ON tbl_vendor.id_kota = tbl_kota.id_kota");
$nm_vendor = mysqli_num_rows($q_vendor);
//$nm_member = 0;
?>
<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h2 class="header">List Supplier</h2>
	</div>
	<?php
	include("alert.php");
	?>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive small">
			<table id="vendorList" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Kode Supplier</th>
						<th>Nama Perusahaan</th>
						<th>Alamat</th>
						<th>Provinsi</th>
						<th>Kota</th>
						<th>No Telpon</th>
						<th style="width:50px;"><i class="fa fa-gear"></i></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Kode Supplier</th>
						<th>Nama Perusahaan</th>
						<th>Alamat</th>
						<th>Provinsi</th>
						<th>Kota</th>
						<th>No Telpon</th>
						<th>Config</th>
					</tr>
				</tfoot>
				<tbody>
				<?php
				if($nm_vendor == 0){
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
					</tr>
				<?php
				}else{
					while($fa_vendor = mysqli_fetch_array($q_vendor)){
						$id_vendor = $fa_vendor['id_vendor'];
						$kode_vendor = $fa_vendor['kode_vendor'];
						$nama_perusahaan = $fa_vendor['nama_perusahaan'];
						$alamat = $fa_vendor['alamat'];
						$nama_provinsi = $fa_vendor['nama_provinsi'];
						$nama_kota = $fa_vendor['nama_kota'];
						$kodepos = $fa_vendor['kodepos'];
						$no_telepon = $fa_vendor['no_telepon'];
						$no_fax = $fa_vendor['no_fax'];
						$email = $fa_vendor['email'];
						$pic = $fa_vendor['pic'];
						$no_handphone = $fa_vendor['no_handphone'];
						$no_rekening = $fa_vendor['no_rekening'];
						$id_bank = $fa_vendor['id_bank'];
						$atas_nama = $fa_vendor['atas_nama'];
						$catatan = $fa_vendor['catatan'];
				?>
					<tr>
						<td><?=$id_vendor;?></td>
						<td>
							<button class="btn btn-xs btn-primary btn-block" onClick="openModalVendor(<?=$id_vendor;?>);">
								<?=$kode_vendor;?>
							</button>
						</td>
						<td><?=$nama_perusahaan;?></td>
						<td><?=$alamat;?></td>
						<td><?=$nama_provinsi;?></td>
						<td><?=$nama_kota;?></td>
						<td><?=$no_telepon;?></td>
						<td>
							<a href="delete.php?table=vendor&id=<?=$id_vendor;?>&page=vendor-list" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Supplier <?=$nama_perusahaan;?>?')">
								<i class="fa fa-trash"></i>
							</a>
							<a href="index.php?page=vendor-edit&id=<?=$id_vendor;?>" class="btn btn-primary btn-xs">
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

<!-- Modal -->
<div id="vendorModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">Supplier Info</h4>
			</div>
			<div class="modal-body" id="vVendor">
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