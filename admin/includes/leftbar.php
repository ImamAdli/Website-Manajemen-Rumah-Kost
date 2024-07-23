<nav class="ts-sidebar">
	<ul class="ts-sidebar-menu">			
		<li class="ts-label">Main</li>
		<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="#"><i class="fa fa-exchange"></i> Sewa</a>
			<ul class="ts-sidebar-menu">
				<li><a href="sewa_bayar.php">Menunggu Pembayaran</a></li>				  						
				<li><a href="sewa_konfirmasi.php">Menunggu Konfirmasi</a></li>
				<li><a href="sewa.php">Riwayat Sewa</a></li>
			</ul>
		</li>
		<li><a href="#"><i class="fa fa-home"></i> Kost</a>
			<ul class="ts-sidebar-menu">
				<?php if ($_SESSION['alogin'] == 'admin') {
					echo "<li><a href='pk.php'>Data Pemilik Kost</a></li>";
				}?>			  						
				<li><a href="kost.php">Data Kamar Kost</a></li>
			</ul>
		</li>
		<?php if ($_SESSION['alogin'] == 'admin') {
			echo "<li><a href='reg-users.php'><i class='fa fa-user'></i> User</a></li>";
			// echo "<li><a href='manage-pages.php'><i class='fa fa-gear'></i> Kelola Halaman</a></li>";
			echo "<li><a href='update-contactinfo.php'><i class='fa fa-gear'></i> Kontak Info</a></li>";
		}?>
		<li><a href="laporan.php"><i class="fa fa-files-o"></i> Laporan</a></li>
	</ul>
	<ul class="ts-sidebar-menu ts-profile-nav">
		<li class="ts-label">Account</li>
		<li><a href="#"><?php echo $_SESSION['alogin'];?><i class="fa fa-angle-down hidden-side"></i></a>
			<ul>
				<li><a href="change-password.php">Ubah Password</a></li>
				<?php if ($_SESSION['alogin'] != 'admin') {
				 echo "<li><a href='pkprofiledit.php'>Ubah Data</a></li>";
				}?>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</li>
	</ul>
</nav>