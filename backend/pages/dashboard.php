<div class="row">
	<div class="col-lg-12">
	
		<div class="row">
		
			<div class="col-lg-3">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<span class="fa fa-cubes fa-5x"></span>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge"><?=number_format(count_produk(),0);?></div>
								<div>Produk</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-3">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<span class="fa fa-truck fa-5x"></span>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge"><?php echo number_format(count_vendor(),0); ?></div>
								<div>Vendor</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-3">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<span class="fa fa-id-card-o fa-5x"></span>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge"><?php echo number_format(count_member(),0); ?></div>
								<div>Member</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-3">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<span class="fa fa-shopping-cart fa-5x"></span>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge"><?php echo number_format(count_penjualan(),0); ?></div>
								<div>Penjualan</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
        
	</div>
</div>