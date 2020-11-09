<?php
include("../../config.php");

$id = $_REQUEST['id'];
$q_member = mysqli_query($con, "SELECT
*
FROM
tbl_member
WHERE tbl_member.id_member = '$id'");

$fa_member = mysqli_fetch_array($q_member);
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
<table class="table table-hover small">
	<tbody>
		<tr>
			<th style="width:150px">Kode Member</th>
			<td style="width:10px">:</td>
			<td><?=$kode_member;?></td>
		</tr>
		<tr>
			<th style="width:150px">Nama Member</th>
			<td style="width:10px">:</td>
			<td><?=$nama_member;?></td>
		</tr>
		<tr>
			<th style="width:150px">Tanggal Lahir</th>
			<td style="width:10px">:</td>
			<td><?=$nama_member;?></td>
		</tr>
		<tr>
			<th style="width:150px">Alamat</th>
			<td style="width:10px">:</td>
			<td><?=$alamat;?></td>
		</tr>
		<tr>
			<th style="width:150px">Kode Pos</th>
			<td style="width:10px">:</td>
			<td><?=$kodepos;?></td>
		</tr>
		<tr>
			<th style="width:150px">No Telepon</th>
			<td style="width:10px">:</td>
			<td><?=$no_telepon;?></td>
		</tr>
		<tr>
			<th style="width:150px">No Handphone</th>
			<td style="width:10px">:</td>
			<td><?=$no_handphone;?></td>
		</tr>
		<tr>
			<th style="width:150px">Email</th>
			<td style="width:10px">:</td>
			<td><?=$email;?></td>
		</tr>
		<tr>
			<td colspan="3"><hr style="margin-top:0px; margin-bottom:0px;"></td>
		</tr>
		<tr>
			<th style="width:150px">Nama Usaha</th>
			<td style="width:10px">:</td>
			<td><?=$nama_usaha;?></td>
		</tr>
		<tr>
			<th style="width:150px">Jenis Usaha</th>
			<td style="width:10px">:</td>
			<td><?=$jenis_usaha;?></td>
		</tr>
		<tr>
			<th style="width:150px">Alamat Usaha</th>
			<td style="width:10px">:</td>
			<td><?=$alamat_usaha;?></td>
		</tr>
		<tr>
			<th style="width:150px">No Telepon Usaha</th>
			<td style="width:10px">:</td>
			<td><?=$no_telepon_usaha;?></td>
		</tr>
		<tr>
			<th style="width:150px">NPWP</th>
			<td style="width:10px">:</td>
			<td><?=$npwp;?></td>
		</tr>
		<tr>
			<th style="width:150px">Catatan</th>
			<td style="width:10px">:</td>
			<td><?=$catatan;?></td>
		</tr>
		<tr>
			<td colspan="3"><hr style="margin-top:0px; margin-bottom:0px;"></td>
		</tr>
		<tr>
			<th style="width:150px">Date Expired</th>
			<td style="width:10px">:</td>
			<td><?=$date_expired;?></td>
		</tr>
	</tbody>
</table>