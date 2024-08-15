<?php 
session_start();
include('includes/config.php');
include('includes/format_rupiah.php');
error_reporting(0);
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
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
</head>
<body>
<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<!--Listing-Image-Slider-->
<?php 
$vhid=intval($_GET['vhid']);
$sql = "SELECT kamar_kost.*, pemilik_kost.* from kamar_kost, pemilik_kost WHERE pemilik_kost.id_pemilik=kamar_kost.id_pemilik AND kamar_kost.id_kamar='$vhid'";
$query = mysqli_query($koneksidb,$sql);
if(mysqli_num_rows($query)>0)
{
while($result = mysqli_fetch_array($query))
{ 
	$_SESSION['brndid']=$result['id_pemilik'];  
?>  

<div id="kostCarousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <?php 
    $fileNames=explode(",",$result['images']);
    $jumlah_data = count($fileNames);
    for ($i = 0; $i < $jumlah_data; $i++) {
      $activeClass = $i === 0 ? 'active' : '';
      echo "<div class='item $activeClass'>
              <img src='admin/img/kostimages/".$fileNames[$i]."' class='' style=''>
            </div>";
    }
    ?>
  </div>
  <a class="left carousel-control" href="#kostCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#kostCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<!--Listing-detail-->
<section class="listing-detail">
  <div class="container">
    <div class="listing_detail_head row">
      <div class="col-md-8">
        <h2><?php echo htmlentities($result['nama_kost']);?> (<?php echo htmlentities($result['tipe_kost']);?>), <?php echo htmlentities($result['nama_kamar']);?></h2>
        <h3>Alamat Kost : <?php echo htmlentities($result['alamat']); ?></h3>
      </div>
      <div class="col-md-4">
        <div class="price_info">
          <p><?php echo htmlentities(format_rupiah($result['harga']));?> </p><h5>/ Hari</h5>
        </div>
      </div>
      <div class="col-md-12">
        <hr>
      </div>
      <div class="col-md-12">
      <style>
        #map {
            height: 400px;
            width: 100%;
        }
        </style>
        <h4>Lokasi Google Maps</h4>
        <!-- Div untuk menampilkan peta -->
        <div id="map"></div>
        <!-- Menyisipkan Google Maps JavaScript API -->
        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_iV3faeC_1QJw69QzDDFbUXVL4G9XbtU&callback=initMap">
        </script>
        <!-- Script untuk inisialisasi peta -->
        <script>
          function initMap() {
            var lokasi =   {lat:<?php echo htmlentities($result['latitude']);?>, lng: <?php echo htmlentities($result['longitude']);?>}; // Contoh: Lokasi Monas
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                center: lokasi
                });
            var marker = new google.maps.Marker({
                position: lokasi,
                map: map
                });
          }
        </script>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="main_features">
          <ul>
            <li> <i class="fa fa-arrows-alt" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result['luas']);?> m²</h5>
              <p>Luas</p>
            </li>
            <li> <i class="fa fa-bath" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result['bath']);?></h5>
              <p>Kamar Mandi</p>
            </li>
            <li> <i class="fa fa-thermometer-quarter" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result['ac']);?></h5>
              <p>AC</p>
            </li>
          </ul>
        </div>
        <div class="listing_more_info">
          <div class="listing_detail_wrap"> 
            <ul class="nav nav-tabs gray-bg" role="tablist">
              <li role="presentation" class="active"><a href="#kost-overview " aria-controls="kost-overview" role="tab" data-toggle="tab">Deskripsi Kamar Kost</a></li>
            </ul>
            <div class="tab-content"> 
              <!-- kost-overview -->
              <div role="tabpanel" class="tab-pane active" id="kost-overview">
                <p><?php echo nl2br(htmlentities($result['deskripsi']));?></p>
              </div>
              <div role="tabpanel" class="tab-pane" id="accessories"> 
                <table>
                  <thead>
                    
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <?php }} ?>
      </div>
      
      <!--Side-Bar-->
      <aside class="col-md-3">
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-envelope" aria-hidden="true"></i>Sewa Sekarang</h5>
          </div>
          <form method="get" action="booking.php">
            <input type="hidden" class="form-control" name="vid" value=<?php echo $vhid;?> required>
			      <?php if($_SESSION['ulogin'])
            {?>
              <div class="form-group" align="center">
                <div class="form-group">
                  <label>Sewa Bulanan?</label><br/>
                  <input type="radio" name="bulanan" value="1">Ya &nbsp;
                  <input type="radio" name="bulanan" value="0" checked>Tidak
                </div>
                <button class="btn" align="center">Sewa Sekarang</button>
              </div>
              <?php } else { ?>
                <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login Untuk Menyewa</a>
              <?php } ?>
          </form>
        </div>
      </aside>
    </div>
  </div>
</section>
<!--/Listing-detail--> 

<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 
<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 
<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 
<!--Register-Form -->
<?php include('includes/registration.php');?>
<!--/Register-Form --> 
<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>