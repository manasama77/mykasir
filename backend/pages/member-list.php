<?php
$q_member = mysqli_query($con, "SELECT * FROM tbl_member");
$nm_member = mysqli_num_rows($q_member);
//$nm_member = 0;
?>
<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h2 class="header">List Member</h2>
	</div>
	<?php
	include("alert.php");
	?>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive small">
			<table id="memberList" class="table table-bordered table-striped display" width="100%">
				<thead>
					<tr>
						<th style="width:20px;">ID</th>
						<th>Kode Member</th>
						<th>Nama Member</th>
						<th>Alamat</th>
						<th>No Telepon</th>
						<th>No Handphone</th>
						<th style="width:50px;text-align:center;"><i class="fa fa-gear"></i></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Kode Member</th>
						<th>Nama Member</th>
						<th>Alamat</th>
						<th>No Telepon</th>
						<th>No Handphone</th>
						<th>Config</th>
					</tr>
				</tfoot>
				<tbody>
				<?php
				if($nm_member == 0){
				?>
					<tr>
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
					while($fa_member = mysqli_fetch_array($q_member)){
						$id_member = $fa_member['id_member'];
						$kode_member = $fa_member['kode_member'];
						$nama_member = $fa_member['nama_member'];
						$alamat = $fa_member['alamat'];
						$kodepos = $fa_member['kodepos'];
						$no_telepon = $fa_member['no_telepon'];
						$no_handphone = $fa_member['no_handphone'];
						$email = $fa_member['email'];
						$tanggal_lahir = $fa_member['tanggal_lahir'];
						$nama_usaha = $fa_member['nama_usaha'];
						$jenis_usaha = $fa_member['jenis_usaha'];
						$alamat_usaha = $fa_member['alamat_usaha'];
						$no_telepon_usaha = $fa_member['no_telepon_usaha'];
						$catatan = $fa_member['catatan'];
						$npwp = $fa_member['npwp'];
						$no_kartu_member = $fa_member['no_kartu_member'];
						$date_expired = $fa_member['date_expired'];
				?>
					<tr>
						<td><?=$id_member;?></td>
						<td>
							<button class="btn btn-xs btn-primary btn-block" onClick="openModalMember(<?=$id_member;?>);">
								<?=$kode_member;?>
							</button>
						</td>
						<td><?=$nama_member;?></td>
						<td><?=$alamat;?></td>
						<td><?=$no_telepon;?></td>
						<td><?=$no_handphone;?></td>
						<td>
							<a href="delete.php?table=member&id=<?=$id_member;?>&page=member-list">
								<button type="button" id="hapus" name="hapus" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Member <?=$nama_member;?>?')">
									<i class="fa fa-trash"></i>
								</button>
							</a>
							<a href="index.php?page=member-edit&id=<?=$id_member;?>">
								<button type="button" class="btn btn-primary btn-xs">
									<i class="fa fa-pencil"></i>
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
<div id="memberModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">Member Info</h4>
			</div>
			<div class="modal-body" id="vMember">
				<p>Loading... Please Wait...</p>
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