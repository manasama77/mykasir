<?php
$q_event = mysqli_query($con, "SELECT
tbl_event.id_event,
tbl_event.nama,
tbl_produk.nama_produk,
tbl_satuan_produk.nama AS satuan,
tbl_event.tipe,
tbl_event.start_date,
tbl_event.end_date,
tbl_event.discount,
tbl_event.potongan_harga,
tbl_event.qty_minimal_pembelian,
tbl_event.id_produk_gratis,
tbl_event.qty_gratis,
tbl_event.akumulasi
FROM tbl_event
LEFT JOIN tbl_produk ON tbl_produk.id_produk = tbl_event.id_produk
LEFT JOIN tbl_satuan_produk ON tbl_satuan_produk.id_satuan_produk = tbl_produk.id_satuan_produk");
$nm_event = mysqli_num_rows($q_event);
?>
<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h2 class="header">List Event</h2>
	</div>
	<?php
	include("alert.php");
	?>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table id="EventList" class="table table-bordered table-striped display small" width="100%">
				<thead>
					<tr>
						<th style="text-align:center; width:10px;">ID</th>
						<th style="text-align:center;">Nama Event</th>
						<th style="text-align:center;">Nama Produk</th>
						<th style="text-align:center;">Tipe</th>
						<th style="text-align:center; width:40px;">Discount</th>
						<th style="text-align:right;">Potongan Harga</th>
						<th style="text-align:right;">Qty Minimal</th>
						<th style="text-align:center;">Gratis Produk</th>
						<th style="text-align:right;">Qty Gratis</th>
						<th style="text-align:center;">Date Start Event</th>
						<th style="text-align:center;">Date End Event</th>
						<th style="text-align:center;"><i class="fa fa-gear"></i></th>
					</tr>
				</thead>
				<tbody>
				<?php
				if($nm_event == 0){
				?>
					<tr>
						<td style="text-align:center;">-</td>
						<td style="text-align:center;">-</td>
						<td style="text-align:center;">-</td>
						<td style="text-align:center;">-</td>
						<td style="text-align:center;">-</td>
						<td style="text-align:center;">-</td>
						<td style="text-align:center;">-</td>
						<td style="text-align:center;">-</td>
						<td style="text-align:center;">-</td>
						<td style="text-align:center;">-</td>
						<td style="text-align:center;">-</td>
						<td style="text-align:center;">-</td>
					</tr>
				<?php
				}else{
					while($fa_event = mysqli_fetch_array($q_event)){
						$id_event = $fa_event['id_event'];
						$nama = $fa_event['nama'];
						$satuan = $fa_event['satuan'];
						$nama_produk = $fa_event['nama_produk'];
						$tipe = $fa_event['tipe'];
						$discount = $fa_event['discount']."%";
						$potongan_harga = $fa_event['potongan_harga'];
						$start_date = $fa_event['start_date'];
						$end_date = $fa_event['end_date'];
						$id_produk_gratis = $fa_event['id_produk_gratis'];
						$akumulasi = $fa_event['akumulasi'];
						
						$q_produk_gratis = mysqli_query($con, "SELECT tbl_produk.nama_produk, tbl_satuan_produk.nama AS satuan FROM tbl_produk LEFT JOIN tbl_satuan_produk ON tbl_satuan_produk.id_satuan_produk = tbl_produk.id_satuan_produk WHERE tbl_produk.id_produk = '$id_produk_gratis'");
						$data_produk_gratis = mysqli_fetch_assoc($q_produk_gratis);
						$nama_produk_gratis = $data_produk_gratis['nama_produk'];
						$satuan_gratis = $data_produk_gratis['satuan'];
						
						if($tipe == 1){
							$nama_tipe = "Discount";
							$potongan_harga = "";
							$qty_minimal_pembelian = "";
							$qty_gratis = "";
						}elseif($tipe == 2){
							$nama_tipe = "Potongan Harga";
							$discount = "";
							$potongan_harga = number_format($potongan_harga,2);
							$qty_minimal_pembelian = "";
							$qty_gratis = "";
						}elseif($tipe == 3){
							$nama_tipe = "Gratis Produk";
							$discount = "";
							$potongan_harga = "";
							$qty_minimal_pembelian = number_format($fa_event['qty_minimal_pembelian'],2)." ".$satuan;
							$qty_gratis = number_format($fa_event['qty_gratis'],2)." ".$satuan_gratis;
						}
						
						if($akumulasi == "yes"){
							$terakumulasi = "Terakumulasi";
						}elseif($akumulasi == "no"){
							$terakumulasi = "Tidak Terakumulasi";
						}else{
							$terakumulasi = "";
						}
				?>
					<tr>
						<td style="text-align:center;"><?=$id_event;?></td>
						<td style="text-align:center;"><?=$nama;?> <?=$terakumulasi;?></td>
						<td style="text-align:center;"><?=$nama_produk;?></td>
						<td style="text-align:center;"><?=$nama_tipe;?></td>
						<td style="text-align:center;"><?=$discount;?></td>
						<td style="text-align:right;"><?=$potongan_harga;?></td>
						<td style="text-align:right;"><?=$qty_minimal_pembelian;?></td>
						<td style="text-align:center;"><?=$nama_produk_gratis;?></td>
						<td style="text-align:right;"><?=$qty_gratis;?></td>
						<td style="text-align:center;"><?=$start_date;?></td>
						<td style="text-align:center;"><?=$end_date;?></td>
						<td>
							<a href="delete.php?table=event&id=<?=$id_event;?>&page=event-list">
								<button type="button" id="hapus" name="hapus" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Event <?=$nama;?>?')">
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
</div>
</div>