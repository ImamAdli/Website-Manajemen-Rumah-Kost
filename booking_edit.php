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
<title>Narty Boarding House | Booking Edit</title>
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
$kode=$_GET['kode'];
$sql1 	= "SELECT booking.*,kamar_kost.*, pemilik_kost.* FROM booking,kamar_kost,pemilik_kost WHERE booking.id_kamar=kamar_kost.id_kamar AND pemilik_kost.id_pemilik=kamar_kost.id_pemilik and booking.kode_booking='$kode'";
$query1 = mysqli_query($koneksidb,$sql1);
$result = mysqli_fetch_array($query1);
$harga	= $result['harga'];
$durasi = $result['durasi'];
$rekening = $result['rekening'];
$telepon = $result['telepon'];
$namapemilik = $result['nama_pemilik'];
$totalkost = $durasi*$harga;
$totalsewa = $totalkost;
$tglmulai = strtotime($result['tgl_mulai']);
$jmlhari  = 86400*2;
$tglbooking = strtotime($result['tgl_booking']);
$tgl = $tglbooking + $jmlhari;
$tglhasil = date("Y-m-d",$tgl);
?>
<section class="user_profile inner_pages">
	<center><h3>Bayar Sewa</h3></center>
	<div class="container">
		<div class="user_profile_info">	
			<div class="col-md-12 col-sm-10">
				<form method="post" action="update_sewa.php" name="sewa" onSubmit="return valid();" enctype="multipart/form-data"> 
					<input type="hidden" class="form-control" name="vid"  value="<?php echo $vid;?>"required>
					<div class="form-group">
					<label>Kode Sewa</label>
						<input type="text" class="form-control" name="kode" value="<?php echo $result['kode_booking'];?>"readonly>
					</div>
					<input type="hidden" class="form-control" name="vid"  value="<?php echo $vid;?>"required>
					<div class="form-group">
					<label>kost</label>
						<input type="text" class="form-control" name="kost" value="<?php echo $result['nama_kost']; echo ", "; echo $result['nama_kamar'];?>"readonly>
					</div>
					<div class="form-group">
					<label>Tanggal Mulai</label>
						<input type="date" class="form-control" name="fromdate" placeholder="From Date(dd/mm/yyyy)" value="<?php echo $result['tgl_mulai'];?>"readonly>
					</div>
					<div class="form-group">
					<label>Tanggal Selesai</label>
						<input type="date" class="form-control" name="todate" placeholder="To Date(dd/mm/yyyy)" value="<?php echo $result['tgl_selesai'];?>"readonly>
					</div>
					<div class="form-group">
					<label>Durasi</label>
						<input type="text" class="form-control" name="durasi" value="<?php echo $durasi;?> Hari"readonly>
					</div>
					<div class="form-group">
					<label>Biaya kost (<?php echo $durasi;?> Hari)</label><br/>
						<input type="text" class="form-control" name="biayakost" value="<?php echo format_rupiah($totalkost);?>"readonly>
					</div>
					<div class="form-group">
					<label>Total Biaya Sewa (<?php echo $durasi;?> Hari)</label><br/>
						<input type="text" class="form-control" name="total" value="<?php echo format_rupiah($totalsewa);?>"readonly>
					</div>
					<div class="form-group">
					<label>Upload Bukti Pembayaran</label><br/>
						<input type="file" class="form-control" name="img1" accept="image/*" required>
					</div>
					<div class="form-group payment-notification">
						<h5>Silahkan Transfer Total Biaya Sewa ke:</h5>
						<h5>- BANK <?php echo $rekening;?> dengan Nama <?php echo $namapemilik;?></h5>
						<h5>- Maksimal pada Tanggal <?php echo IndonesiaTgl($tglhasil);?>.</h5>
						<h5>- Kontak Pemilik Kost di : <?php echo $telepon;?></h5>
					</div>								
					<div class="hr-dashed"></div>
					<div class="form-group">
						<button class="btn btn-primary col-md-12" type="submit" name="submit1" value="submit1" formaction="update_sewa.php">Submit</button>
					</div>
				</form>
			</div>
		</div>
  </div>
</section>

<?php include('includes/footer.php');?>
<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
</body>
</html>
<?php } ?>