<?php 
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
$tglnow   = date('Y-m-d');
$tglmulai = strtotime($tglnow);
$jmlhari  = 86400*1;
$tglplus	  = $tglmulai+$jmlhari;
$now = date("Y-m-d",$tglplus);

// Ambil data nama kost dari database
$sqlNamaKost = "SELECT DISTINCT nama_kost FROM pemilik_kost";
$queryNamaKost = mysqli_query($koneksidb, $sqlNamaKost);
$namaKostList = [];
while ($row = mysqli_fetch_assoc($queryNamaKost)) {
    $namaKostList[] = $row['nama_kost'];
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
<title>Narty Boarding House | Daftar Kost</title>
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
<!-- Tambahkan link ke Font Awesome di bagian <head> dari dokumen HTML Anda -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    <aside class="col-md-3">
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-filter" aria-hidden="true"></i>Cari Kost</h5>
          </div>
          <div class="sidebar_filter">
            <form method="post" name="sewa" onsubmit="return checkDate();" action="kost-listing.php">
              <div class="form-group">
                <label>Tanggal Mulai</label>
                <input type="date" class="form-control" name="fromdate" placeholder="From Date(dd/mm/yyyy)" >
                <input type="hidden" name="now" class="form-control" value="<?php echo $now;?>">
              </div>
              <div class="form-group">
                <label>Tanggal Selesai</label>
                <input type="date" class="form-control" name="todate" placeholder="To Date(dd/mm/yyyy)" required>
              </div>
              <!-- Tambahkan dua tombol di bawah input Tanggal Selesai -->
              <div class="button-group">
                <button class="btn-left">
                  <i class="fa fa-angle-left"></i>
                </button>
                <button class="btn-right">
                  <i class="fa fa-angle-right"></i>
                </button>
              </div>
              <div class="form-group">
                <button type="submit" name="searchresult" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i>Cari</button>
              </div>
            </form>
          </div>
        </div>

        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-home" aria-hidden="true"></i>Kost Terbaru</h5>
          </div>
          <div class="recent_addedkost">
            <ul>
              <?php
              $sql2 = "SELECT kamar_kost.*,pemilik_kost.* FROM kamar_kost,pemilik_kost 
                  WHERE pemilik_kost.id_pemilik=kamar_kost.id_pemilik order by pemilik_kost.id_pemilik desc limit 4";
              $query2 = mysqli_query($koneksidb,$sql2);
              if(mysqli_num_rows($query2)>0)
              {
                while($result = mysqli_fetch_array($query2))
              { ?>
              <li class="gray-bg">
                <div class="recent_post_img"> 
                  <a href="kost-details.php?vhid=<?php echo htmlentities($result['id_kamar']);?>">
                    <?php
                    $imagesString = $result['images'];
                    $imagesArray = explode(',', $imagesString);
                    if (!empty($imagesArray)) {
                        $firstImage = trim($imagesArray[0]);
                        echo '<img src="admin/img/kostimages/' . htmlentities($firstImage) . '" class="img-responsive" alt="Image" />';
                    }
                    ?>
                  </a>                 
                </div>
                <div class="recent_post_title"> <a href="kost-details.php?vhid=<?php echo htmlentities($result['id_kamar']);?>"><?php echo htmlentities($result['nama_kost']);?> , <?php echo htmlentities($result['nama_kamar']);?></a>
                <p class="widget_price"><?php echo htmlentities(format_rupiah($result['harga']));?> / Hari</p>
                </div>
              </li>
            <?php }} ?>
            </ul>
          </div>
        </div>
      </aside>
      <div class="col-md-9">
        <!-- Result Sorting and Search Bar -->
        <div class="result-sorting-wrapper">
          <div class="sorting-count">
            <p>
              <span id="availableRoomsCount">0 Kamar Kost Tersedia</span>
              <?php if(isset($_POST['searchresult']) && !empty($_POST['fromdate']) && !empty($_POST['todate'])): ?>
                <span id="dateRange"> pada tanggal <?php echo date('d F Y', strtotime($_POST['fromdate'])); ?> hingga <?php echo date('d F Y', strtotime($_POST['todate'])); ?></span>
              <?php endif; ?>
            </p>
          </div>
          <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Cari Kamar Kost..." class="form-control">
          </div>
          <br>
          <div class="col-md-6 filter-group">
            <select id="searchNamaKost" class="form-control">
              <option value="">Filter Nama Kost</option>
              <?php foreach ($namaKostList as $namaKost) { ?>
                <option value="<?php echo htmlentities($namaKost); ?>"><?php echo htmlentities($namaKost); ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-6 filter-group">
            <select id="searchKamarMandi" class="form-control">
              <option value="">Filter Kamar Mandi</option>
              <option value="dalam">Di Dalam</option>
              <option value="luar">Di Luar</option>
            </select>
          </div>
          <div class="col-md-6 filter-group">
            <select id="searchAC" class="form-control">
              <option value="">Filter AC</option>
              <option value="ada">Ada</option>
              <option value="tidak ada">Tidak Ada</option>
            </select>
          </div>
          <div class="col-md-6 filter-group">
            <select id="searchTipeKost" class="form-control">
              <option value="">Filter Tipe Kost</option>
              <option value="pria">Pria</option>
              <option value="wanita">Wanita</option>
              <option value="campur">Campur</option>
            </select>
          </div>
        </div>

        <?php
        $fromdate=$_POST['fromdate'];
        $todate=$_POST['todate'];
        if(isset($_POST['searchresult'])){
          $namakost=$_POST['nama_kost'];
          $_SESSION['fdate']=$_POST['fromdate'];
          $_SESSION['tdate']=$_POST['todate'];
          $sql1 = "SELECT DISTINCT a.*,c.*
                      FROM kamar_kost a 
                      JOIN pemilik_kost c 
                      ON a.id_pemilik=c.id_pemilik
                      LEFT JOIN cek_booking b 
                      ON a.id_kamar=b.id_kamar
                      AND b.tgl_booking between '$fromdate' and '$todate'
                      where b.tgl_booking is null";
          $query1 = mysqli_query($koneksidb,$sql1);
        } else {
          $sql1 = "SELECT DISTINCT a.*,c.*
          FROM kamar_kost a 
          JOIN pemilik_kost c 
          ON a.id_pemilik=c.id_pemilik
          LEFT JOIN cek_booking b 
          ON a.id_kamar=b.id_kamar and b.kode_booking is not NULL";
        }
        
        $query1 = mysqli_query($koneksidb,$sql1);
        
        if(mysqli_num_rows($query1)>0){
          while($result = mysqli_fetch_array($query1)){ 
        ?>
        <div class="product-listing-m gray-bg">
          <div class="product-listing-img">
            <a href="kost-details.php?vhid=<?php echo htmlentities($result['id_kamar']);?>">
            <?php
            $imagesString = $result['images'];
            $imagesArray = explode(',', $imagesString);
            if (!empty($imagesArray)) {
                $firstImage = trim($imagesArray[0]);
                echo '<img src="admin/img/kostimages/' . htmlentities($firstImage) . '" class="img-responsive" alt="Image" />';
            }
            ?>
            </a> 
          </div>
          <div class="product-listing-content">
          <h5><a href="kost-details.php?vhid=<?php echo htmlentities($result['id_kamar']);?>"><?php echo htmlentities($result['nama_kost']);?> (<?php echo htmlentities($result['tipe_kost']);?>), <?php echo htmlentities($result['nama_kamar']);?></a></h5>
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

        
      <div class="button-group">
        <button class="btn-prev note"><i class="fa fa-angle-left"></i></button>
        <button class="btn-next note"><i class="fa fa-angle-right"></i></button>
      </div>
      </div>


<!--Side-Bar-->

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

<?php include('includes/login.php');?>
<?php include('includes/registration.php');?>
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