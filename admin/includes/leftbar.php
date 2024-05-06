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
					echo "<li><a href='namakost.php'>Data Nama Kost</a></li>";
				}?>			  						
				<li><a href="kost.php">Data Kamar Kost</a></li>
			</ul>
		</li>
		<?php if ($_SESSION['alogin'] == 'admin') {
			echo "<li><a href='reg-users.php'><i class='fa fa-user'></i> User</a></li>";
			echo "<li><a href='manage-pages.php'><i class='fa fa-gear'></i> Kelola Halaman</a></li>";
			echo "<li><a href='update-contactinfo.php'><i class='fa fa-gear'></i> Kontak Info</a></li>";
		}?>
		<li><a href="laporan.php"><i class="fa fa-files-o"></i> Laporan</a></li>
	</ul>
</nav>