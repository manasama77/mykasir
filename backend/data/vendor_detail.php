<?php
include("../../config.php");

$id = $_REQUEST['id'];
$q_vendor = mysqli_query($con, "SELECT
*
FROM
tbl_vendor
LEFT JOIN tbl_provinsi ON tbl_vendor.id_provinsi = tbl_provinsi.id_provinsi
LEFT JOIN tbl_kota ON tbl_vendor.id_kota = tbl_kota.id_kota
LEFT JOIN tbl_bank ON tbl_vendor.id_bank = tbl_bank.id_bank
WHERE tbl_vendor.id_vendor = '$id'");

$fa_vendor = mysqli_fetch_array($q_vendor);
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
$nama_bank = $fa_vendor['nama_bank'];
$atas_nama = $fa_vendor['atas_nama'];
$catatan = $fa_vendor['catatan'];
?>
<table class="table table-hover small">
	<tbody>
		<tr>
			<th style="width:150px">Kode Supplier</th>
			<td style="width:10px">:</td>
			<td><?=$kode_vendor;?></td>
		</tr>
		<tr>
			<th style="width:150px">Nama Perusahaan</th>
			<td style="width:10px">:</td>
			<td><?=$nama_perusahaan;?></td>
		</tr>
		<tr>
			<th style="width:150px">Alamat</th>
			<td style="width:10px">:</td>
			<td><?=$alamat;?></td>
		</tr>
		<tr>
			<th style="width:150px">Provinsi</th>
			<td style="width:10px">:</td>
			<td><?=$nama_provinsi;?></td>
		</tr>
		<tr>
			<th style="width:150px">Kota</th>
			<td style="width:10px">:</td>
			<td><?=$nama_kota;?></td>
		</tr>
		<tr>
			<th style="width:150px">Kodepos</th>
			<td style="width:10px">:</td>
			<td><?=$kodepos;?></td>
		</tr>
		<tr>
			<th style="width:150px">No Telepon</th>
			<td style="width:10px">:</td>
			<td><?=$no_telepon;?></td>
		</tr>
		<tr>
			<th style="width:150px">No Fax</th>
			<td style="width:10px">:</td>
			<td><?=$no_fax;?></td>
		</tr>
		<tr>
			<th style="width:150px">Email</th>
			<td style="width:10px">:</td>
			<td><?=$email;?></td>
		</tr>
		<tr>
			<th style="width:150px">PIC</th>
			<td style="width:10px">:</td>
			<td><?=$pic;?></td>
		</tr>
		<tr>
			<th style="width:150px">No Handphone</th>
			<td style="width:10px">:</td>
			<td><?=$no_handphone;?></td>
		</tr>
		<tr>
			<td colspan="3"><hr style="margin-top:0px; margin-bottom:0px;"></td>
		</tr>
		<tr>
			<th style="width:150px">No Rekening</th>
			<td style="width:10px">:</td>
			<td><?=$no_rekening;?></td>
		</tr>
		<tr>
			<th style="width:150px">Nama Bank</th>
			<td style="width:10px">:</td>
			<td><?=$nama_bank;?></td>
		</tr>
		<tr>
			<th style="width:150px">Atas Nama</th>
			<td style="width:10px">:</td>
			<td><?=$atas_nama;?></td>
		</tr>
		<tr>
			<td colspan="3"><hr style="margin-top:0px; margin-bottom:0px;"></td>
		</tr>
		<tr>
			<th style="width:150px">Catatan</th>
			<td style="width:10px">:</td>
			<td><?=$catatan;?></td>
		</tr>
	</tbody>
</table>