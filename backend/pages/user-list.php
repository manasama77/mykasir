<div class="widget">
	<div class="widget-content">
<div class="row">
	<div class="col-lg-12">
		<h2 class="header">List User</h2>
	</div>
	<?php
	include("alert.php");
	?>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table id="userList" class="table table-bordered table-striped display small" width="100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>Username</th>
						<th>Nama</th>
						<th>Role</th>
						<th>Last Login</th>
						<th style="width:50px; text-align: center;"><i class="fa fa-gear"></i></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="userModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">Ganti Password</h4>
			</div>
			<div class="modal-body" id="vUser">
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