<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');

if(strlen($_SESSION['ulogin'])==0){ 
	header('location:index.php');
}else{
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title> Narty Boarding House | Riwayat Sewa</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<!--Custome Style -->
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<!--OWL Carousel slider-->
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<!--slick-slider -->
<link href="assets/css/slick.css" rel="stylesheet">
<!--bootstrap-slider -->
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<!--FontAwesome Font Style -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
</head>
<body>

<!--Header-->
<?php include('includes/header.php');?>

<?php
$email=$_SESSION['ulogin'];  
$sql1 	= "SELECT booking.*,kamar_kost.*, pemilik_kost.*, users.* FROM booking,kamar_kost,pemilik_kost,users WHERE booking.id_kamar=kamar_kost.id_kamar 
			AND pemilik_kost.id_pemilik=kamar_kost.id_pemilik and booking.email=users.email and booking.email='$email'";
$query1 = mysqli_query($koneksidb,$sql1);
$result = mysqli_fetch_array($query1);
$harga	= $result['harga'];
$durasi = $result['durasi'];
$totalkost = $durasi*$harga;
$totalsewa = $totalkost;
$tglmulai = strtotime($result['tgl_mulai']);
$jmlhari  = 86400*1;
$tgl	  = $tglmulai-$jmlhari;
$tglhasil = date("Y-m-d",$tgl);
?>
<section class="user_profile inner_pages">
	<center><h3>Riwayat Sewa</h3></center>
	<div class="container">
		<!-- Tambahkan input pencarian -->
		<input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari transaksi berdasarkan Kode Sewa atau Nama Kost" class="form-control mb-3">
		
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="rentalTable">
				<thead>
					<tr>    
						<th width="3%" align="center">No</th>
						<th width="10%">Kode Sewa</th>		
						<th width="15%">Kost</th>
						<th width="10%">Tgl. Mulai</th>
						<th width="10%">Tgl. Selesai</th>
						<th width="5%">Durasi</th>
						<th width="10%">Biaya/Hari</th>
						<th width="10%">Total Biaya</th>
						<th width="10%">Status</th>
						<th width="10%">Opsi</th>
					</tr>
				</thead>
				<?php
				$email=$_SESSION['ulogin'];  
				$sql1 	= "SELECT booking.*,kamar_kost.*, pemilik_kost.*, users.* FROM booking,kamar_kost,pemilik_kost,users WHERE booking.id_kamar=kamar_kost.id_kamar 
						AND pemilik_kost.id_pemilik=kamar_kost.id_pemilik and booking.email=users.email and booking.email='$email'";
				$query1 = mysqli_query($koneksidb,$sql1);
				if(mysqli_num_rows($query1)!=0){
					while($result = mysqli_fetch_array($query1)){
						$harga	= $result['harga'];
						$durasi = $result['durasi'];
						$totalkost = $durasi*$harga;
						$totalsewa = $totalkost;
						$tglmulai = strtotime($result['tgl_mulai']);
						$jmlhari  = 86400*1;
						$tgl	  = $tglmulai-$jmlhari;
						$tglhasil = date("Y-m-d",$tgl);
						$nomor++;
					?>
					<tr>
						<td align="center"><?php echo $nomor; ?></td>
						<td><?php echo $result['kode_booking']; ?></td>
						<td><?php echo $result['nama_kost']; echo ", "; echo $result['nama_kamar']; ?></td>
						<td><?php echo IndonesiaTgl($result['tgl_mulai']); ?></td>
						<td><?php echo IndonesiaTgl($result['tgl_selesai']); ?></td>
						<td><?php echo $result['durasi']; ?> Hari</td>
						<td><?php echo format_rupiah($result['harga']);?></td>
						<td><?php echo format_rupiah($totalsewa); ?></td>
						<td><?php echo $result['status']; ?></td>
						<td align="center">
						<?php 
							if($result['status']=="Sudah Dibayar"||$result['status']=="Selesai"){
							?>
							<a href="booking_detail.php?kode=<?php echo $result['kode_booking'];?>" class="glyphicon glyphicon-eye-open"></a>
							<?php 
							}else{
							?>
							<a href="booking_edit.php?kode=<?php echo $result['kode_booking'];?>" class="fa fa-edit"></a>&emsp;
							<a href="booking_detail.php?kode=<?php echo $result['kode_booking'];?>" class="glyphicon glyphicon-eye-open"></a>&emsp;
							<a href="booking_del.php?kode=<?php echo $result['kode_booking'];?>" onclick="return confirm('Apakah anda yakin menghapus transaksi <?php echo $result['kode_booking'];?>?');" class="fa fa-close"></a>
							<?php }?>
						</td>
					</tr>
					<?php } ?>
					<?php
					}else{
					?>
					<tr>
						<td colspan="11" align="center"><b>Belum ada riwayat sewa.</b></td>
					</tr>
					<?php }?>
				</table>
			</div>
		</div>
	</section>

	<?php include('includes/footer.php');?>

	<!-- Scripts --> 
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script> 
	<script src="assets/js/interface.js"></script> 
	<!--bootstrap-slider-JS--> 
	<script src="assets/js/bootstrap-slider.min.js"></script> 
	<!--Slider-JS--> 
	<script src="assets/js/slick.min.js"></script> 
	<script src="assets/js/owl.carousel.min.js"></script>
	
	<!-- Tambahkan script pencarian -->
	<script>
		function searchTable() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("searchInput");
			filter = input.value.toUpperCase();
			table = document.getElementById("rentalTable");
			tr = table.getElementsByTagName("tr");

			for (i = 1; i < tr.length; i++) {
				tr[i].style.display = "none";
				td = tr[i].getElementsByTagName("td");
				for (var j = 0; j < td.length; j++) {
					if (td[j]) {
						txtValue = td[j].textContent || td[j].innerText;
						if (txtValue.toUpperCase().indexOf(filter) > -1) {
							tr[i].style.display = "";
							break;
						}
					}
				}
			}
		}
	</script>
</body>
</html>
<?php } ?>