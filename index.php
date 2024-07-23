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
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
</head>
<body>

<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<!-- Banners -->
<section id="banner" class="banner-section">
  <div class="container">
    <div class="div_zindex">
      <div class="row">
        <div class="col-md-5 col-md-push-7">
          <div class="banner_content">
            <h1>Sewa Kost untuk tempat tinggal anda.</h1>
            <p>Kami Punya beberapa pilihan untuk anda. </p>
            <a href="kost-listing.php" class="btn">Selengkapnya <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a> 
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Banners --> 

<section class="section-padding">
  <div class="container">
    <div class="row"> 
      <!-- Nav tabs -->
      <div class="recent-tab">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">Kost Untuk Anda</a></li>
        </ul>
      </div>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="resentnewcar">
          <?php 
          $sql = "SELECT kamar_kost.*, pemilik_kost.* FROM kamar_kost, pemilik_kost WHERE pemilik_kost.id_pemilik = kamar_kost.id_pemilik ORDER BY RAND() LIMIT 6";
          $query = mysqli_query($koneksidb,$sql);
          if(mysqli_num_rows($query)>0)
          {
          while($results = mysqli_fetch_array($query))
          {
          ?>  
          <div class="col-list-3">
            <div class="recent-kost-list gray-bg">
              <div class="kost-info-box"> 
                <a href="kost-details.php?vhid=<?php echo htmlentities($results['id_kamar']);?>">
                <?php
                $imagesString = $results['images'];
                $imagesArray = explode(',', $imagesString);
                if (!empty($imagesArray)) {
                    $firstImage = trim($imagesArray[0]);
                    echo '<img src="admin/img/kostimages/' . htmlentities($firstImage) . '" class="img-responsive" alt="Image" />';
                }
                ?>
                </a>
                <ul>
                  <li><i class="fa fa-arrows-alt" aria-hidden="true"></i>Luas <?php echo htmlentities($results['luas']);?>m²</li>
                  <li><i class="fa fa-bath" aria-hidden="true"></i><?php echo htmlentities($results['bath']);?></li>
                  <li><i class="fa fa-thermometer-quarter" aria-hidden="true"></i>AC <?php echo htmlentities($results['ac']);?></li>
                </ul>
              </div>
              <div class="kost-title-m">
                <h6><a href="kost-details.php?vhid=<?php echo htmlentities($results['id_kamar']);?>"><?php echo htmlentities($results['nama_kost']);?> , <?php echo htmlentities($results['nama_kamar']);?></a></h6>
                <span class="price"><?php echo htmlentities(format_rupiah($results['harga']));?> /Hari</span> 
              </div>
              <div class="inventory_info_m">
                <p><?php echo substr($results['deskripsi'],0,70);?></p>
              </div>
            </div>
          </div>
          <?php }}?>
        </div>
      </div>
    </div>
  </div>
</section>

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
<!--/Forgot-password-Form --> 
<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>