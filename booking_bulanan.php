<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');

if(strlen($_SESSION['ulogin'])==0){ 
	header('location:index.php');
}else{
	$tglnow   = date('Y-m-d');
	$tglmulai = strtotime($tglnow);
	$jmlhari  = 86400*1;
	$tglplus	  = $tglmulai+$jmlhari;
	$now = date("Y-m-d",$tglplus);

if(isset($_POST['submit'])){
	$fromdate=$_POST['fromdate'];
	$todate=$_POST['todate'];
	$vid=$_POST['vid'];
//cek
$sql 	= "SELECT kode_booking FROM cek_booking WHERE tgl_booking between '$fromdate' AND '$todate' AND id_kamar='$vid' AND status!='Cancel'";
$query 	= mysqli_query($koneksidb,$sql);
if(mysqli_num_rows($query)>0){
		echo " <script> alert ('kost tidak tersedia di tanggal yang anda pilih, silahkan pilih tanggal lain!'); 
		</script> ";
	}else{
		echo "<script type='text/javascript'> document.location = 'booking_ready.php?vid=$vid&mulai=$fromdate&selesai=$todate'; </script>";
	}
}
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

</head>
<body>

<!--Header-->
<?php include('includes/header.php');?>
<!--Page Header-->
<!-- /Header --> 

<?php 
$vid=$_GET['vid'];
$useremail=$_SESSION['login'];
$sql1 = "SELECT kamar_kost.*,pemilik_kost.* FROM kamar_kost,pemilik_kost WHERE pemilik_kost.id_pemilik=kamar_kost.id_pemilik and kamar_kost.id_kamar='$vid'";
$query1 = mysqli_query($koneksidb,$sql1);
$result = mysqli_fetch_array($query1);
?>
<script type="text/javascript">
function valid()
{
	if(document.sewa.todate.value < document.sewa.fromdate.value){
		alert("Tanggal selesai harus lebih besar dari tanggal mulai sewa!");
		return false;
	}
	if(document.sewa.fromdate.value < document.sewa.now.value){
		alert("Tanggal sewa minimal H-1!");
		return false;
	}

return true;
}
</script>

	<section class="user_profile inner_pages">
	<div class="container">
	<div class="col-md-6 col-sm-8">
	      <div class="product-listing-img">
					<?php
            $imagesString = $result['images'];
            $imagesArray = explode(',', $imagesString);
            if (!empty($imagesArray)) {
              $firstImage = trim($imagesArray[0]);
              echo '<img src="admin/img/kostimages/' . htmlentities($firstImage) . '" class="img-responsive" alt="Image" />';
            }
          ?>
				</div>
          <div class="product-listing-content">
            <h5><?php echo htmlentities($result['nama_kost']);?> , <?php echo htmlentities($result['nama_kamar']);?></a></h5>
            <p class="list-price"><?php echo htmlentities(format_rupiah($result['harga']));?> / Hari</p>
            <ul>
              <li><i class="fa fa-arrows-alt" aria-hidden="true"></i><?php echo htmlentities($result['luas']);?>m²</li>
              <li><i class="fa fa-bath" aria-hidden="true"></i><?php echo htmlentities($result['bath']);?></li>
			  <li><i class="fa fa-thermometer-quarter" aria-hidden="true"></i><?php echo htmlentities($result['ac']);?> </li>
            </ul>
          </div>	
	</div>
	
	<div class="user_profile_info">	
		<div class="col-md-12 col-sm-10">
        <form method="post" name="sewa" onSubmit="return valid();"> 
			<input type="hidden" class="form-control" name="vid"  value="<?php echo $vid;?>"required>
            <div class="form-group">
			<label>Tanggal Mulai</label>
				<input type="date" class="form-control" name="fromdate" placeholder="From Date(dd/mm/yyyy)" required>
				<input type="hidden" name="now" class="form-control" value="<?php echo $now;?>">
            </div>
            <div class="form-group">
			<label>Tanggal Selesai</label>
				<input type="date" class="form-control" name="todate" placeholder="To Date(dd/mm/yyyy)" required>
            </div>
			<br/>			
			<div class="form-group">
                <input type="submit" name="submit" value="Cek Ketersediaan" class="btn btn-block">
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