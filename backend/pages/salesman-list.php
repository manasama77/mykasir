<?php
$q_salesman = mysqli_query($con, "SELECT * FROM tbl_salesman");
$nm_salesman = mysqli_num_rows($q_salesman);
?>
<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h2 class="header">List Salesman</h2>
	</div>
	<?php
	include("alert.php");
	?>
</div>
<div class="row">
	<div class="col-md-12 col-lg-12">
		<div class="table-responsive">
			<table id="salesmanList" class="table table-bordered table-striped small" width="100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>Kode Salesman</th>
						<th>Nama Salesman</th>
						<th>No Telepon</th>
						<th>No Handphone</th>
						<th>Alamat</th>
						<th><i class="fa fa-gear"></i></th>
					</tr>
				</thead>
				<!--tfoot>
					<tr>
						<th>ID</th>
						<th>Kode Salesman</th>
						<th>Nama Salesman</th>
						<th>No Telepon</th>
						<th>No Handphone</th>
						<th>Alamat</th>
						<th>Config</th>
					</tr>
				</tfoot-->
				<tbody>
				<?php
				if($nm_salesman == 0){
				?>
					<tr>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
				<?php
				}else{
					while($fa_salesman = mysqli_fetch_array($q_salesman)){
						$id_salesman = $fa_salesman['id_salesman'];
						$kode_salesman = $fa_salesman['kode_salesman'];
						$nama_salesman = $fa_salesman['nama_salesman'];
						$no_telepon = $fa_salesman['no_telepon'];
						$no_handphone = $fa_salesman['no_handphone'];
						$alamat = $fa_salesman['alamat'];
				?>
					<tr>
						<td><?=$id_salesman;?></td>
						<td><?=$kode_salesman;?></td>
						<td><?=$nama_salesman;?></td>
						<td><?=$no_telepon;?></td>
						<td><?=$no_handphone;?></td>
						<td><?=$alamat;?></td>
						<td>
							<a href="delete.php?table=salesman&id=<?=$id_salesman;?>&page=salesman-list" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Salesman <?=$nama_salesman;?>?')">
								<i class="fa fa-trash"></i>
							</a>
							<a href="index.php?page=salesman-edit&id=<?=$id_salesman;?>" class="btn btn-warning btn-xs" disabled><i class="fa fa-pencil"></i></a>
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