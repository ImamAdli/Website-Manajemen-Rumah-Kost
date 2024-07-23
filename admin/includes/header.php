<div class="brand clearfix">
	<a href="#" style="font-size: 20px; top:15px;">Sewa Kost | Admin Panel</a>  
	<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">
			<li class="ts-account">
				<a href="#"><?php echo $_SESSION['alogin'];?><i class="fa fa-angle-down hidden-side"></i></a>
				<ul>
					<li><a href="change-password.php">Ubah Password</a></li>
					<?php if ($_SESSION['alogin'] != 'admin') {
					 echo "<li><a href='pkprofiledit.php'>Ubah Data</a></li>";
					}?>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
