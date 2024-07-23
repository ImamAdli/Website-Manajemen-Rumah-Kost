<?php 
session_start();
include('includes/config.php');
include('includes/format_rupiah.php');
error_reporting(0);
	$tglnow   = date('Y-m-d');
	$tglmulai = strtotime($tglnow);
  $jmlhari  = 86400*1;
	$tglplus	  = $tglmulai+$jmlhari;
	$now = date("Y-m-d",$tglplus);

  if(isset($_POST['submit'])){
    $fromdate=$_POST['fromdate'];
    $todate=$_POST['todate'];
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
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
</head>
<body>

<!--Header--> 
<?php include('includes/header.php');?>
<!-- /Header --> 

<!--Page Header-->
<section class="page-header listing_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Daftar Kost</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>Daftar Kost</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<!--Listing-->
<section class="listing-page">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-md-push-3">
        <div class="result-sorting-wrapper">
          <div class="sorting-count">
            <?php 
            //Query for Listing count
            $namakost=$_POST['namakost'];
            $fromdate=$_POST['fromdate'];
            $todate=$_POST['todate'];
            if($namakost == null){
              $sql = "SELECT DISTINCT *
                      FROM kamar_kost a 
                      JOIN pemilik_kost c 
                      ON a.id_pemilik=c.id_pemilik
                      LEFT JOIN cek_booking b 
                      ON a.id_kamar=b.id_kamar
                      AND b.tgl_booking between '$fromdate' and '$todate'
                      where b.tgl_booking is null";
            }else{
              $sql = "SELECT DISTINCT *
                    FROM kamar_kost a 
                    JOIN pemilik_kost c 
                    ON a.id_pemilik=c.id_pemilik
                    LEFT JOIN cek_booking b 
                    ON a.id_kamar=b.id_kamar
                    AND b.tgl_booking between '$fromdate' and '$todate'
                    WHERE a.id_pemilik='$namakost'
                    AND b.tgl_booking is null";
            }
            $query = mysqli_query($koneksidb,$sql);
            $cnt = mysqli_num_rows($query);
            ?>
            <p><span><?php echo htmlentities($cnt);?> Kamar Kost Tersedia</span></p>
          </div>
        </div>
        <?php 
        if($namakost == null){
          $sql1 = "SELECT DISTINCT a.*,c.*
                FROM kamar_kost a 
                JOIN pemilik_kost c 
                ON a.id_pemilik=c.id_pemilik
                LEFT JOIN cek_booking b 
                ON a.id_kamar=b.id_kamar
                AND b.tgl_booking between '$fromdate' and '$todate'
                where b.tgl_booking is null";
        }else{
          $sql1 = "SELECT DISTINCT a.*,c.*
                FROM kamar_kost a 
                JOIN pemilik_kost c 
                ON a.id_pemilik=c.id_pemilik
                LEFT JOIN cek_booking b 
                ON a.id_kamar=b.id_kamar
                AND b.tgl_booking between '$fromdate' and '$todate'
                WHERE a.id_pemilik='$namakost'
                AND b.tgl_booking is null";
        }
        $query1 = mysqli_query($koneksidb,$sql1);
        if(mysqli_num_rows($query1)>0){
          while($result = mysqli_fetch_array($query1)){ 
        ?>
        <div class="product-listing-m gray-bg">
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
            <h5><a href="kost-details.php?vhid=<?php echo $result['id_kamar'];?>"><?php echo htmlentities($result['nama_kost']);?> , <?php echo htmlentities($result['nama_kamar']);?></a></h5>
            <h6><?php echo htmlentities($result['alamat']);?></a></h6>
            <p class="list-price"><?php echo htmlentities(format_rupiah($result['harga']));?> / Hari</p>
            <ul>
            <li><i class="fa fa-arrows-alt" aria-hidden="true"></i>Luas <?php echo htmlentities($result['luas']);?>m²</li>
              <li><i class="fa fa-bath" aria-hidden="true"></i><?php echo htmlentities($result['bath']);?></li>
              <li><i class="fa fa-thermometer-quarter" aria-hidden="true"></i><?php echo htmlentities($result['ac']);?> </li>
            </ul>
            <a href="kost-details.php?vhid=<?php echo htmlentities($result['id_kamar']);?>" class="btn">Lihat Detail <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
          </div>
        </div>
        <?php }} ?>
      </div>
<!--Side-Bar-->
      <script type="text/javascript">
      function checkDate()
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
      <aside class="col-md-3 col-md-pull-9">
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-filter" aria-hidden="true"></i>Cari kost</h5>
          </div>
          <div class="sidebar_filter">
            <form method="post" action="search-kostresult.php" name="sewa" onSubmit="return checkDate();">
              <div class="form-group">
                <label>Tanggal Mulai</label>
                <input type="date" class="form-control" name="fromdate" placeholder="From Date(dd/mm/yyyy)" required>
                <input type="hidden" name="now" class="form-control" value="<?php echo $now;?>">
              </div>
              <div class="form-group">
                <label>Tanggal Selesai</label>
                <input type="date" class="form-control" name="todate" placeholder="To Date(dd/mm/yyyy)" required>
              </div>
              <div class="form-group select">
                <select class="form-control" name="namakost" >
                <option value="" selected>Pilih Nama Kost</option>
                <?php 
                $sql3 = "SELECT * from  pemilik_kost";
                $query3 = mysqli_query($koneksidb,$sql3);
                if(mysqli_num_rows($query3)>0)
                {
                  while($result = mysqli_fetch_array($query3))
                {?>
                <option value="<?php echo htmlentities($result['id_pemilik']);?>"><?php echo htmlentities($result['nama_kost']);?></option>
                <?php }} ?>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i>Cari</button>
              </div>
            </form>
          </div>
        </div>
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-home" aria-hidden="true"></i> Terbaru</h5>
          </div>
          <div class="recent_added">
            <ul>
              <?php
              $sql2 = "SELECT kamar_kost.*,pemilik_kost.* FROM kamar_kost,pemilik_kost 
                  WHERE pemilik_kost.id_pemilik=kamar_kost.id_pemilik order by pemilik_kost.id_pemilik desc limit 4";
              $query2 = mysqli_query($koneksidb,$sql2);
              if(mysqli_num_rows($query2)>0){
              while($result = mysqli_fetch_array($query2))
              { ?>
              <li class="gray-bg">
                <div class="recent_post_img"> <a href="kost-details.php?vhid=<?php echo htmlentities($result['id_kamar']);?>"><img src="admin/img/kostimages/<?php echo htmlentities($result['images']);?>" alt="image"></a> </div>
                <div class="recent_post_title"> <a href="kost-details.php?vhid=<?php echo htmlentities($result['id_kamar']);?>"><?php echo htmlentities($result['nama_kost']);?> , <?php echo htmlentities($result['nama_kamar']);?></a>
                <p class="widget_price"><?php echo htmlentities(format_rupiah($result['harga']));?> / Hari</p>
                </div>
              </li>
              <?php }} ?>
            </ul>
          </div>
        </div>
      </aside>
      <!--/Side-Bar-->
    </div>
  </div>
</section>
<!-- /Listing--> 

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
<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>
