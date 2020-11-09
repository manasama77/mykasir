<div class="row">
	<nav class="navbar navbar-static-top navbar-custom">
		<div class="navbar-header">
			<div class="navbar-brand"><i class="fa fa-shopping-cart"></i> UD Mandiri Cahaya Abadi</div>
		</div>
		<ul class="nav navbar-nav navbar-right" style="margin-right:5px;">
			<li>
				<div class="clock">
					<ul id="Date2">
						<li id="hours"></li>
						<li id="point">:</li>
						<li id="min"></li>
						<li id="point">:</li>
						<li id="sec"></li>
					</ul>
				</div>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-user fa-fw"></i> <?=ucwords($_SESSION['username']);?> &nbsp;&nbsp;<i class="fa fa-caret-down"></i>
				</a>
				<ul class="dropdown-menu dropdown-user">
					<li><a onClick="passwordModal()"><i class="fa fa-key fa-fw"></i> Ubah Password</a></li>
					<li class="divider"></li>
					<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
				</ul>
				<!-- /.dropdown-user -->
			</li>
		</ul>				
	</nav>
</div>