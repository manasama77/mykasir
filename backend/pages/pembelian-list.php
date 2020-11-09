<?php
$q_pembelian = mysqli_query($con, "SELECT
tbl_pembelian.id_pembelian,
tbl_pembelian.kode_pembelian,
tbl_pembelian.tanggal_order,
tbl_pembelian.no_faktur,
tbl_pembelian.tanggal_pelunasan,
tbl_pembelian.tanggal_jatuh_tempo,
tbl_pembelian.catatan,
tbl_pembelian.status,
tbl_pembelian.pembayaran,
tbl_pembelian.hutang,
tbl_pembelian.grand_total,
tbl_vendor.nama_perusahaan
FROM tbl_pembelian
LEFT JOIN tbl_vendor ON tbl_vendor.id_vendor = tbl_pembelian.id_vendor
ORDER BY tbl_pembelian.id_pembelian DESC");
$nm_pembelian = mysqli_num_rows($q_pembelian);
?>
<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h2 class="header">List Pembelian Barang</h2>
	</div>
	<?php
	include("alert.php");
	?>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table id="pembelianList" class="table table-bordered table-striped small">
				<thead>
					<tr>
						<th style="text-align:center;">ID</th>
						<th style="text-align:center;">Kode Pembelian</th>
						<th style="text-align:center;">Tanggal Order</th>
						<th style="text-align:center;">Supplier</th>
						<th style="text-align:center;">No Faktur Supplier</th>
						<th style="text-align:center;">Tanggal Jatuh Tempo</th>
						<th style="text-align:center;">Tanggal Pelunasan</th>
						<th style="text-align:right;">Terbayarkan</th>
						<th style="text-align:right;">Sisa / Hutang</th>
						<th style="text-align:right;">Grand Total</th>
						<th style="text-align:center;">Status</th>
						<th style="text-align:center;">Catatan</th>
						<th style="text-align:center; width:60px !important;"><i class="fa fa-gear"></i></th>
					</tr>
				</thead>
				<tbody>
				<?php
				if($nm_pembelian == 0){
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
						<td style="text-align:center;">-</td>
					</tr>
				<?php
				}else{
					while($fa_q_pembelian = mysqli_fetch_array($q_pembelian)){
						$id_pembelian = $fa_q_pembelian['id_pembelian'];
						$kode_pembelian = $fa_q_pembelian['kode_pembelian'];
						$tanggal_order = $fa_q_pembelian['tanggal_order'];
						$nama_perusahaan = $fa_q_pembelian['nama_perusahaan'];
						$no_faktur = $fa_q_pembelian['no_faktur'];
						$tanggal_pelunasan = $fa_q_pembelian['tanggal_pelunasan'];
						$tanggal_jatuh_tempo = $fa_q_pembelian['tanggal_jatuh_tempo'];
						$catatan = $fa_q_pembelian['catatan'];
						$grand_total = $fa_q_pembelian['grand_total'];
						$status = $fa_q_pembelian['status'];
						$pembayaran = $fa_q_pembelian['pembayaran'];
						$hutang = $fa_q_pembelian['hutang'];
						
						if($status == 0){
							$text_status = "<div class=\"label label-danger\">Hutang</div>";
							$button_pembayaran = "";
						}else{
							$text_status = "<div class=\"label label-success\">Lunas</div>";
							$button_pembayaran = "disabled";
						}
				?>
					<tr>
						<td style="text-align:center;"><?=$id_pembelian;?></td>
						<td style="text-align:center;">
							<button class="btn btn-xs btn-primary btn-block btn-flat" onClick="openModalPembelian(<?=$id_pembelian;?>);">
								<?=$kode_pembelian;?>
							</button>
						</td>
						<td style="text-align:center;"><?=$tanggal_order;?></td>
						<td style="text-align:center;"><?=$nama_perusahaan;?></td>
						<td style="text-align:center;"><?=$no_faktur;?></td>
						<td style="text-align:center;"><?=$tanggal_jatuh_tempo;?></td>
						<td style="text-align:center;"><?=$tanggal_pelunasan;?></td>
						<td style="text-align:right;"><?=number_format($pembayaran,2);?></td>
						<td style="text-align:right;"><?=number_format($hutang,2);?></td>
						<td style="text-align:right;"><?=number_format($grand_total,2);?></td>
						<td style="text-align:center;"><?=$text_status;?></td>
						<td style="text-align:left;"><?=$catatan;?></td>
						<td style="text-align:center; width:60px !important;">
							<button <?=$button_pembayaran;?> type="button" id="pembayaran" name="pembayaran" class="btn btn-primary btn-xs" title="Pembayaran" onClick="openModalPembayaran(<?=$id_pembelian;?>);">
								<i class="fa fa-money"></i>
							</button>
							<a href="delete.php?table=pembelian&id=<?=$id_pembelian;?>&page=pembelian-list">
								<button <?=$button_pembayaran;?> type="button" id="hapus" name="hapus" class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm('Hapus Data Pembelian <?=$kode_pembelian;?>?')">
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
<div id="pembelianModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">Pembelian Info</h4>
			</div>
			<div class="modal-body" id="vPembelian">
				<p>Loading... Please Wait</p>
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