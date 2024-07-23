<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
// Code for change password	
if(isset($_POST['submit'])){
	$password=md5($_POST['password']);
	$newpassword=md5($_POST['newpassword']);
	$username=$_SESSION['alogin'];

	if ($_SESSION['alogin'] == 'admin') {
	$sql ="SELECT Password FROM admin WHERE UserName='$username' and Password='$password'";
	$query= mysqli_query($koneksidb,$sql);
		if(mysqli_num_rows($query) > 0){
			$con="update admin set Password='$newpassword' where UserName='$username'";
			$chngpwd = mysqli_query($koneksidb,$con);
			$msg="Your Password succesfully changed";
		}else {
			$error="Your current password is not valid.";	
		}
	} else {
		$sql ="SELECT password FROM pemilik_kost WHERE email='$username' and password='$password'";
		$query= mysqli_query($koneksidb,$sql);
			if(mysqli_num_rows($query) > 0){
				$con="update pemilik_kost set password='$newpassword' where email='$username'";
				$chngpwd = mysqli_query($koneksidb,$con);
				$msg="Your Password succesfully changed";
			}else {
				$error="Your current password is not valid.";	
			}
	}
}
?>

<!doctype html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="theme-color" content="#3e454c">
<title>Narty Boarding House | Admin Change Password</title>
<!-- Font awesome -->
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- Sandstone Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Bootstrap Datatables -->
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
<!-- Bootstrap social button library -->
<link rel="stylesheet" href="css/bootstrap-social.css">
<!-- Bootstrap select -->
<link rel="stylesheet" href="css/bootstrap-select.css">
<!-- Bootstrap file input -->

<!-- Awesome Bootstrap checkbox -->
<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
<!-- Admin Stye -->
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript">
function valid()
{
	if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
	{
		alert("New Password and Confirm Password Field do not match!");
		document.chngpwd.confirmpassword.focus();
		return false;
	}
	return true;
}
</script>
</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Ubah Password</h2>
						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Form Ubah Password</div>
									<div class="panel-body">
										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
  	        	  			<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
											else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
											<div class="form-group">
												<label class="col-sm-4 control-label">Password Sekarang</label>
												<div class="col-sm-8">
													<input type="password" class="form-control" name="password" id="password" required>
												</div>
											</div>
											<div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-4 control-label">Password Baru</label>
												<div class="col-sm-8">
													<input type="password" class="form-control" name="newpassword" id="newpassword" required>
												</div>
											</div>
											<div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-4 control-label">Konfirmasi Password Baru</label>
												<div class="col-sm-8">
													<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required>
												</div>
											</div>
											<div class="hr-dashed"></div>
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
													<button class="btn btn-primary" name="submit" type="submit">Simpan Perubahan</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- Loading Scripts -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/Chart.min.js"></script>
<script src="js/fileinput.js"></script>
<script src="js/chartData.js"></script>
<script src="js/main.js"></script>

</body>
</html>
<?php } ?>