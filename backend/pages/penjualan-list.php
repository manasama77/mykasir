<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h2 class="header">List Penjualan</h2>
	</div>
	<?php
	include("alert.php");
	?>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table id="penjualanList" class="table table-bordered table-striped display small" width="100%">
				<thead>
					<tr>
						<th>No Transaksi</th>
						<th>Pelanggan</th>
						<th>Tanggal Transaksi</th>
						<th style="text-align:right">Total Penjualan</th>
						<th>Catatan</th>
						<th style="width:10px;"><i class="fa fa-gear"></i></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>


<!-- Modal -->
<div id="penjualanModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">Penjualan Info</h4>
			</div>
			<div class="modal-body" id="vPenjualan">
				<p>Loading... Please Wait...</p>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" onClick="bersihkan();">Close</button>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<!-- End Modal -->