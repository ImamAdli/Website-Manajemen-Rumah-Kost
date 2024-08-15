<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');

if(strlen($_SESSION['ulogin'])==0){ 
	header('location:index.php');
}else{

if(isset($_POST['submit'])){
$sql_booking = "SELECT MAX(CAST(SUBSTRING(kode_booking, 4, 3) as int))+1 as numrow from booking";
$struktur	= mysqli_query($koneksidb, $sql_booking);
$result_booking = mysqli_fetch_array($struktur);
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$durasi=$_POST['durasi'];
$vid=$_POST['vid'];
$email=$_POST['email'];
$numrow = $result_booking['numrow'];
$kode =  "TRX".$numrow;
$status = "Menunggu Pembayaran";
$bukti = "";
$cek=0;
$tgl=date('Y-m-d');
//insert
$sql 	= "INSERT INTO booking (kode_booking,id_kamar,tgl_mulai,tgl_selesai,durasi,status,email,tgl_booking)
			VALUES('$kode','$vid','$fromdate','$todate','$durasi','$status','$email','$tgl')";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
    $currentDate = strtotime($fromdate);
    $endDate = strtotime($todate);
    
    while ($currentDate <= $endDate) {
        $tglhasil = date("Y-m-d", $currentDate);
        $sql1     = "INSERT INTO cek_booking (kode_booking, id_kamar, tgl_booking, status) VALUES ('$kode', '$vid', '$tglhasil', '$status')";
        $query1   = mysqli_query($koneksidb, $sql1);
        $currentDate = strtotime("+1 day", $currentDate);
    }
    
    echo " <script> alert ('Kost berhasil disewa.'); </script> ";
    echo "<script type='text/javascript'> document.location = 'booking_edit.php?kode=$kode'; </script>";
} else {
    echo " <script> alert ('Ooops, terjadi kesalahan. Silahkan coba lagi.'); </script> ";
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
<title>Narty Boarding House | Booking Ready</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
</head>
<body>
        
<!--Header-->
<?php include('includes/header.php');?>


	<br/>
	<center><h3>kost Tersedia untuk disewa.</h3></center>
</div>
<?php
$email=$_SESSION['ulogin']; 
$vid=$_GET['vid'];
$mulai=$_GET['mulai'];
$selesai=$_GET['selesai'];
$start = new DateTime($mulai);
$finish = new DateTime($selesai);
$int = $start->diff($finish);
$dur = $int->days;
$durasi = $dur+1;

$sql1 	= "SELECT kamar_kost.*,pemilik_kost.* FROM kamar_kost,pemilik_kost WHERE pemilik_kost.id_pemilik=kamar_kost.id_pemilik and kamar_kost.id_kamar='$vid'";
$query1 = mysqli_query($koneksidb,$sql1);
$result = mysqli_fetch_array($query1);
$harga	= $result['harga'];
$totalkost = $durasi*$harga;
$totalsewa = $totalkost;
?>
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
 			<input type="hidden" class="form-control" name="email"  value="<?php echo $email;?>"required>
            <div class="form-group">
			<label>Tanggal Mulai</label>
				<input type="date" class="form-control" name="fromdate" placeholder="From Date(yyyy-mm-dd)" value="<?php echo $mulai;?>"readonly>
            </div>
            <div class="form-group">
				<label>Tanggal Selesai</label>
				<input type="date" class="form-control" name="todate" placeholder="To Date(yyyy-mm-dd)" value="<?php echo $selesai;?>" readonly>
            </div>
            <div class="form-group">
			<label>Durasi</label>
				<input type="text" class="form-control" name="durasi" value="<?php echo $durasi;?> Hari	"readonly>
            </div>
            <div class="form-group">
			<label>Biaya kost/hari </label><br/>
				<input type="text" class="form-control" name="biayakost" value="<?php echo format_rupiah($harga);?>"readonly>
            </div>
            <div class="form-group">
			<label>Total Biaya Sewa (<?php echo $durasi;?> Hari)</label><br/>
				<input type="text" class="form-control" name="total" value="<?php echo format_rupiah($totalsewa);?>"readonly>
            </div>
			<br/>			
			<div class="form-group">
                <input type="submit" name="submit" value="Konfirmasi Sewa" class="btn btn-block">
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