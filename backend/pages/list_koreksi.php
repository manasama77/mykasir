<thead>
	<tr>
		<th style="text-align:center;">Kode Produk</th>
		<th style="text-align:center;">Nama Produk</th>
		<th style="text-align:center;">Qty</th>
		<th style="text-align:center;">Purpose</th>
		<th style="text-align:center;">Keterangan</th>
		<th style="text-align:center; width:50px;"><i class="fa fa-gear"></i></th>
	</tr>
</thead>
<tbody>
<?php
include("../../config.php");
$q_koreksi_list = mysqli_query($con, "SELECT
p.kode_produk,
p.nama_produk,
lk.id_list_koreksi,
lk.qty,
lk.purpose,
lk.keterangan
FROM tbl_list_koreksi AS lk
LEFT JOIN tbl_produk AS p ON p.id_produk = lk.id_produk
WHERE lk.status = '0'");
$nm_koreksi_list = mysqli_num_rows($q_koreksi_list);
echo $nm_koreksi_list;
echo "a";

if($nm_koreksi_list > 0){
	while($data = mysqli_fetch_array($q_koreksi_list)){
?>
	<tr>
		<td style="text-align:center;"><?=$data['kode_produk'];?></td>
		<td style="text-align:center;"><?=$data['nama_produk'];?></td>
		<td style="text-align:center;"><?=$data['qty'];?></td>
		<td style="text-align:center;"><?=$data['purpose'];?></td>
		<td style="text-align:center;"><?=$data['keterangan'];?></td>
		<td style="text-align:center;">
			<button type="button" class="btn btn-danger btn-xs" onClick="hapus_koreksi_list(<?=$data['id_list_koreksi'];?>);">
				<i class="fa fa-trash"></i>
			</button>
		</td>
	</tr>
<?php
	}
}else{
?>
	<tr>
		<td style="text-align:center;">-</td>
		<td style="text-align:center;">-</td>
		<td style="text-align:center;">-</td>
		<td style="text-align:center;">-</td>
		<td style="text-align:center;">-</td>
		<td style="text-align:center;">-</td>
	</tr>
<?php
}
?>
</tbody>