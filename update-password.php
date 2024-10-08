<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['ulogin'])==0){ 
    header('location:index.php');
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $passw = $_POST['pass'];
        $pass = md5($passw);
        $new = $_POST['new'];
        $confirm = $_POST['confirm'];
        $mail = $_POST['mail'];
        $sql = "SELECT * FROM users WHERE email='$mail' AND password='$pass'";
        $query = mysqli_query($koneksidb, $sql);

        if (mysqli_num_rows($query) == 1) {
            if ($confirm == $new) {
                $newpass = md5($new);
                $sqlup = "UPDATE users SET password='$newpass' WHERE email='$mail'";
                $queryup = mysqli_query($koneksidb, $sqlup);
                if ($queryup) {
                    $msg = "Berhasil update password.";
                } else {
                    $error = "Gagal update password!";
                }
            } else {
                $error = "Password baru dan konfirmasi password baru tidak sama!";
            }
        } else {
            $error = "Password sekarang yang dimasukkan salah!";
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
<title>Narty Boarding House | Update Password</title>
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
<!-- /Page Header--> 
<section class="user_profile inner_pages">
  <div class="container">
    <div class="user_profile_info">
      <div class="col-md-12 col-sm-10">
        <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
        <?php
        $mail=$_SESSION['ulogin'];
        ?>
        <form  method="post" action="">
          <div class="form-group">
            <label class="control-label">Password Sekarang</label>
            <input class="form-control white_bg" name="mail" id="mail" type="hidden" value="<?php echo $mail;?>" required>
            <input class="form-control white_bg" name="pass" id="pass" type="password"  required>
          </div>
          <div class="form-group">
            <label class="control-label">Password Baru</label>
            <input class="form-control white_bg" name="new" id="new" type="password"  required>
          </div>
          <div class="form-group">
            <label class="control-label">Konfirmasi Password Baru</label>
            <input class="form-control white_bg" name="confirm" id="confirm" type="password"  required>
          </div>
          <div class="form-group">
            <button type="submit" class="btn">Ubah Password <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!--/Profile-setting--> 

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
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>
<?php } ?>