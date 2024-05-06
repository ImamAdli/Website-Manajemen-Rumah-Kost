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
<title>Narty Boarding House</title>
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

<!-- Fav and touch icons -->
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->  
</head>
<body>

<!--Header-->
<?php include('includes/header.php');?>

<?php 
$kode=$_GET['kode'];
$sql1 	= "SELECT booking.*,kost.*, nama_kost.* FROM booking,kost,nama_kost WHERE booking.id_kamarkost=kost.id_kamarkost AND nama_kost.id_namakost=kost.id_namakost and booking.kode_booking='$kode'";
$query1 = mysqli_query($koneksidb,$sql1);
$result = mysqli_fetch_array($query1);
$harga	= $result['harga'];
$durasi = $result['durasi'];
$durasi = $result['durasi'];
$rekening = $result['rekening'];
$totalkost = $durasi*$harga;
$totalsewa = $totalkost;
$tglmulai = strtotime($result['tgl_mulai']);
$jmlhari  = 86400*1;
$tgl	  = $tglmulai-$jmlhari;
$tglhasil = date("Y-m-d",$tgl);
?>
<section class="user_profile inner_pages">
	<center><h3>Detail Sewa</h3></center>
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
						<input type="text" class="form-control" name="kost" value="<?php echo $result['nama_kost']; echo ", "; echo $result['nama_kamarkost'];?>"readonly>
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
						<b>*Silahkan transfer total biaya sewa ke BANK <?php echo $rekening;?> dengan nama <?php echo $namapemilik;?> maksimal tanggal <?php echo IndonesiaTgl($tglhasil);?>.
					</div>											
					<div class="hr-dashed"></div>
					<div class="form-group">
					<div class="col-md-6">
						<button class="btn btn-primary" type="submit" name="submit1" value="submit1" formaction="update_sewa.php">Submit</button>
						</div>
					<div class="col-md-6">
						<button class="btn btn-warning" type="submit" name="submit2" value="submit2" formaction="booking_del.php">Batalkan Pemesanan</button>
						</div>

					</div>
				</form>
			</div>
		</div>
  </div>
</section>
<!--/my-kosts--> 
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