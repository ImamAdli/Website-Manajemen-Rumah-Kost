<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Narty Boarding House | Registrasi</title>
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
<style>
.errorWrap {
  padding: 10px;
  margin: 0 0 20px 0;
  background: #fff;
  border-left: 4px solid #dd3d36;
  -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
  box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
  padding: 10px;
  margin: 0 0 20px 0;
  background: #fff;
  border-left: 4px solid #5cb85c;
  -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
  box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
</style>
<script type="text/javascript">
function checkLetter(theform)
{
  pola_nama=/^[a-zA-Z .]*$/;
  if (!pola_nama.test(theform.fullname.value)){
  alert ('Hanya huruf yang diperbolehkan untuk Nama!');
  theform.fullname.focus();
  return false;
  }
  
  if(theform.pass.value!= theform.conf.value)
  {
    alert("New Password and Confirm Password Field do not match!");
    theform.conf.focus();
    return false;
  }
  return (true);
}
</script>
<script type="text/javascript">
	function checkAvailability() {
	$("#loaderIcon").show();
	jQuery.ajax({
		url: "check_availability.php",
		data:'emailid='+$("#emailid").val(),
		type: "POST",
		success:function(data){
			$("#user-availability-status").html(data);
			$("#loaderIcon").hide();
		},
		error:function (){}
	});
	}
</script>
</head>
<body>        
<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 
<section class="user_profile inner_pages">
  <div class="container">
    <div class="user_profile_info">
      <h5 align="center">Registrasi User</h5>
      <div class="col-md-12 col-sm-10">
        <form  method="post" name="theform" action="registact.php" id="theform" onSubmit="return checkLetter(this);" enctype="multipart/form-data">
          <div class="form-group">
            <input type="text" class="form-control" name="fullname" placeholder="Nama Lengkap" required="required">
          </div>
          <div class="form-group">
            <input type="number" class="form-control" name="kosteno" placeholder="Nomor Telepon" minlength="10" maxlength="15" required="required">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" placeholder="Alamat Email" required="required">
              <span id="user-availability-status" style="font-size:12px;"></span> 
          </div>
          <div class="form-group">
            Upload Foto KTP<span style="color:red">*</span><input type="file" name="img1" accept="image/*" required>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required="required">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="conf" name="conf" placeholder="Konfirmasi Password" required="required">
          </div>
          <div class="form-group checkbox">
            <input type="checkbox" id="terms_agree" required="required" checked="">
            <label for="terms_agree">Saya Setuju dengan <a href="page.php?type=terms">Syarat dan Ketentuan yang berlaku</a></label>
          </div>
          <div class="form-group">
            <input type="submit" value="Sign Up"class="btn btn-block">
          </div>
        </form>              
        <div class="modal-footer text-center">
          <p>Sudah punya akun? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login Disini</a></p>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/Profile-setting--> 

<<!--Footer -->
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