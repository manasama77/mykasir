<?php
$q_history = mysqli_query($con, "SELECT
pp.id_pembayaran_pembelian,
pp.kode_pembayaran,
pp.grand_total,
pp.hutang_sebelumnya,
pp.pembayaran,
pp.hutang_terbaru,
pp.tanggal_pelunasan,
p.kode_pembelian,
p.tanggal_jatuh_tempo,
v.nama_perusahaan,
p.no_faktur,
p.tanggal_order,
p.`status`
FROM
tbl_pembayaran_pembelian AS pp
Left Join tbl_pembelian AS p ON pp.id_pembelian = p.id_pembelian
Left Join tbl_vendor AS v ON p.id_vendor = v.id_vendor
ORDER BY
pp.id_pembayaran_pembelian DESC");
$nm_history = mysqli_num_rows($q_history);
?>
<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h2 class="header">History Pembayaran</h2>
	</div>
	<?php
	include("alert.php");
	?>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table id="historyList" class="table table-bordered table-striped small">
				<thead>
					<tr>
						<th style="text-align:center;">ID</th>
						<th style="text-align:center;">Kode Pembelian</th>
						<th style="text-align:center;">Tanggal Order</th>
						<th style="text-align:center;">Supplier</th>
						<th style="text-align:center;">No Faktur Supplier</th>
						<th style="text-align:center;">Tanggal Jatuh Tempo</th>
						<th style="text-align:center;">Tanggal Pelunasan</th>
						<th style="text-align:center;">Kode Pembayaran</th>
						<th style="text-align:right;">Grand Total</th>
						<th style="text-align:right;">Tagihan Sebelumnya</th>
						<th style="text-align:right;">Pembayaran</th>
						<th style="text-align:right;">Sisa Hutang</th>
						<th style="text-align:center;">Status</th>
					</tr>
				</thead>
				<tbody>
				<?php
				if($nm_history == 0){
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
					while($fa_q_history = mysqli_fetch_array($q_history)){
						$id_pembayaran_pembelian = $fa_q_history['id_pembayaran_pembelian'];
						$kode_pembayaran = $fa_q_history['kode_pembayaran'];
						$grand_total = $fa_q_history['grand_total'];
						$hutang_sebelumnya = $fa_q_history['hutang_sebelumnya'];
						$pembayaran = $fa_q_history['pembayaran'];
						$hutang_terbaru = $fa_q_history['hutang_terbaru'];
						$tanggal_pelunasan = $fa_q_history['tanggal_pelunasan'];
						$kode_pembelian = $fa_q_history['kode_pembelian'];
						$tanggal_jatuh_tempo = $fa_q_history['tanggal_jatuh_tempo'];
						$nama_perusahaan = $fa_q_history['nama_perusahaan'];
						$no_faktur = $fa_q_history['no_faktur'];
						$tanggal_order = $fa_q_history['tanggal_order'];
						$status = $fa_q_history['status'];
						
						if($status == 0){
							$text_status = "<div class=\"label label-danger\">Hutang</div>";
						}else{
							$text_status = "<div class=\"label label-success\">Lunas</div>";
						}
				?>
					<tr>
						<td style="text-align:center;"><?=$id_pembayaran_pembelian;?></td>
						<td style="text-align:center;"><?=$kode_pembayaran;?></td>
						<td style="text-align:center;"><?=$tanggal_order;?></td>
						<td style="text-align:center;"><?=$kode_pembelian;?></td>
						<td style="text-align:center;"><?=$nama_perusahaan;?></td>
						<td style="text-align:center;"><?=$no_faktur;?></td>
						<td style="text-align:center;"><?=$tanggal_jatuh_tempo;?></td>
						<td style="text-align:center;"><?=$tanggal_pelunasan;?></td>
						<td style="text-align:center;"><?=number_format($grand_total,2);?></td>
						<td style="text-align:center;"><?=number_format($hutang_sebelumnya,2);?></td>
						<td style="text-align:center;"><?=number_format($pembayaran,2);?></td>
						<td style="text-align:center;"><?=number_format($hutang_terbaru,2);?></td>
						<td style="text-align:center;"><?=$text_status;?></td>
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
				<h4 class="modal-title">Member Info</h4>
			</div>
			<div class="modal-body" id="vPembelian">
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