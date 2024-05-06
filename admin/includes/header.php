<div class="brand clearfix">
	<div class="col-sm-9 col-md-5" style="top:15px;">
		<a href="#" style="font-size: 20px;">Sewa Kost | Admin Panel</a>  
	</div>	
	<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">
			<li class="ts-account">
				<a href="#"><?php echo $_SESSION['alogin'];?><i class="fa fa-angle-down hidden-side"></i></a>
				<ul>
					<li><a href="change-password.php">Ubah Password</a></li>
					<?php if ($_SESSION['alogin'] != 'admin') {
					 echo "<li><a href='pkdataedit.php'>Ubah Data</a></li>";
					}?>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
