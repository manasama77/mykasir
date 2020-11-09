<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php">
				<img src="assets/images/logo-ananda.PNG" width="50px" style="margin-top:-10px; position:absolute;">
				<span style="margin-left: 70px;">UD Mandiri Cahaya Abadi - Administrator</span>
			</a>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-gear fa-fw"></i> User Management
					<b class="caret"></b>					
				</a>
				<ul class="dropdown-menu">
					<li><a href="?page=user-list">User List</a></li>
					<li><a href="?page=user-add">Add User</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-user fa-fw"></i> <?=ucwords($_SESSION['nama']);?>
					<b class="caret"></b>					
				</a>
				<ul class="dropdown-menu">
					<li><a href="?page=profile">Profile</a></li>
					<li><a role="button" id="bckdb"><i class="fa fa-database"></i> Backup Database</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
</nav>

<div class="subnavbar">
	<div class="subnavbar-inner">
		<div class="container">
			<ul class="mainnav">
				<li id="pdashboard">
					<a href="./"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>	    				
				</li>
				
				<li id="pproduk" class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-cubes"></i>
						<span>Produk</span>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="?page=produk-list"><i class="fa fa-list"></i> List Produk</a></li>
						<li><a href="?page=produk-add"><i class="fa fa-plus"></i> Tambah Produk</a></li>
						<li class="separator"><hr></li>
						<li style="text-align:center;"><b>Pembelian</b></li>
						<li><a href="?page=pembelian-list"><i class="fa fa-list fa-fw"></i> List Pembelian Produk</a></li>
						<li><a href="?page=pembelian-add"><i class="fa fa-plus"></i> Pembelian Produk</a></li>
						<li><a href="?page=history-pembayaran"><i class="fa fa-history"></i> History Pembayaran</a></li>
						<li class="separator"><hr></li>
						<li><a href="?page=kadarluarsa-list"><i class="fa fa-gear"></i> Kadarluarsa Management</a></li>
					</ul>   
				</li>
				
				<li id="pkategori" class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-tags"></i>
						<span>Kategori Produk</span>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="?page=kategori_produk-list"><i class="fa fa-list"></i> List Kategori Produk</a></li>
						<li><a href="?page=kategori_produk-add"><i class="fa fa-plus"></i> Tambah Kategori Produk</a></li>
					</ul>   
				</li>

				<li id="psatuan" class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-balance-scale"></i>
						<span>Satuan Produk</span>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="?page=satuan_produk-list"><i class="fa fa-list"></i> List Satuan Produk</a></li>
						<li><a href="?page=satuan_produk-add"><i class="fa fa-plus"></i> Tambah Satuan Produk</a></li>
					</ul>   
				</li>
				
				<li id="pkoreksi" class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-pencil"></i>
						<span>Koreksi Stock</span>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="?page=koreksi-list"><i class="fa fa-list fa-fw"></i> List Koreksi Stock</a></li>
						<li><a href="?page=koreksi-add"><i class="fa fa-plus fa-fw"></i> Koreksi Stock</a></li>
					</ul>   
				</li>
				
				<li id="pmember" class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-id-card-o"></i>
						<span>Member</span>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="?page=member-list"><i class="fa fa-list"></i> List Member</a></li>
						<li><a href="?page=member-add"><i class="fa fa-plus"></i> Tambah Member Baru</a></li>
					</ul>   
				</li>
				
				<li id="pvendor" class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-truck"></i>
						<span>Supplier</span>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="?page=vendor-list"><i class="fa fa-list"></i> List Supplier</a></li>
						<li><a href="?page=vendor-add"><i class="fa fa-plus"></i> Tambah Supplier Baru</a></li>
					</ul>   
				</li>
				
				<li id="psalesman" class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-male"></i>
						<span>Salesman</span>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="?page=salesman-list"><i class="fa fa-list"></i> List Salesman</a></li>
						<li><a href="?page=salesman-add"><i class="fa fa-plus"></i> Tambah Salesman Baru</a></li>
					</ul>   
				</li>
				
				<li id="plaporan" class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-file-text"></i>
						<span>Laporan</span>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="?page=laporan-pembelian"><i class="fa fa-info-circle"></i> Laporan Pembelian</a></li>
						<li><a href="?page=laporan-pembelian-hutang"><i class="fa fa-info-circle"></i> Laporan Pembelian Hutang</a></li>
						<li><a href="?page=laporan-pembelian-hutang-supplier"><i class="fa fa-info-circle"></i> Laporan Pembelian Hutang Per Supplier</a></li>
						<li><a href="?page=laporan-pembelian-lunas"><i class="fa fa-info-circle"></i> Laporan Pembelian Lunas</a></li>
						<li><a href="?page=laporan-penjualan"><i class="fa fa-info-circle"></i> Laporan Penjualan</a></li>
						<li><a href="?page=laporan-penjualan-hutang"><i class="fa fa-info-circle"></i> Laporan Barang Penjualan Hutang</a></li>
						<li><a href="?page=laporan-bon-penjualan-hutang"><i class="fa fa-info-circle"></i> Laporan Bon Penjualan Hutang</a></li>
						<li><a href="?page=laporan-penjualan-discount"><i class="fa fa-info-circle"></i> Laporan Penjualan Discount</a></li>
						<li><a href="?page=laporan-laba-rugi"><i class="fa fa-info-circle"></i> Laporan Laba Rugi</a></li>
						<li><a href="?page=laporan-shu"><i class="fa fa-info-circle"></i> Laporan Sisa Hasil Usaha</a></li>
						<li><a href="" ><i class="fa fa-info-circle"></i> Laporan Saldo</a></li>
					</ul>   
				</li>
				
				
				
				<li id="plistpenjualan">
					<a href="?page=penjualan-list"><i class="fa fa-shopping-cart fa-fw"></i><span>List Penjualan</span></a>	    				
				</li>
				<li id="pevent" class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-calendar-o"></i>
						<span>Jurnal</span>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="?page=jurnal_rca_add"><i class="fa fa-plus"></i> Input Jurnal Saldo</a></li>
						<li><a href="http://localhost/matrial/backend/pages/laporan-neraca.php" target="_blank"><i class="fa fa-list"></i> Laporan Saldo </a></li>
						<li><a href="?page=opr-add"><i class="fa fa-plus"></i> Input Operasional</a></li>
						<li><a href="?page=opr-list"><i class="fa fa-list"></i> List jurnal Operasional </a></li>
						<li><a href="?page=laporan-opr"><i class="fa fa-list"></i> Laporan Operasional</a></li>
					</ul>   
				</li>
			</ul>

		</div> <!-- /container -->

	</div> <!-- /subnavbar-inner -->

</div> <!-- /subnavbar -->