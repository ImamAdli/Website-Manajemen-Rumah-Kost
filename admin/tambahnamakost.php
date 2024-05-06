<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0){	
	header('location:index.php');
}
else{
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
	<title>Narty Boarding House | Admin Create namakost</title>
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
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">

<script type="text/javascript">
function checkLetter(theform)
{
	pola_nama=/^[a-zA-Z .]*$/;
	if (!pola_nama.test(theform.namapemilik.value)){
	alert ('Hanya huruf yang diperbolehkan untuk Nama!');
	theform.namapemilik.focus();
	return false;
	}
	if(theform.password.value!= theform.confpassword.value)
	{
	alert("New Password and Confirm Password Field do not match!");
	theform.confpassword.focus();
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
</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Tambah Nama Kost</h2>
						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Form Tambah Nama Kost</div>
									<div class="panel-body">
										<form  method="post" name="theform" class="form-horizontal" action="namakostact.php" id="theform" onSubmit="return checkLetter(this); " enctype="multipart/form-data">
											<div class="form-group">
												<label class="col-sm-3 control-label">Nama Kost</label>
												<div class="col-sm-8">
														<input type="text" class="form-control" name="namakost" id="namakost" placeholder="Nama Kost" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Nama Lengkap</label>
												<div class="col-sm-8">
														<input type="text" class="form-control" name="namapemilik" placeholder="Nama Lengkap" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Email</label>
												<div class="col-sm-8">
													<input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" placeholder="Alamat Email" required="required">
													<span id="user-availability-status" style="font-size:12px;"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Nomor Telepon</label>
												<div class="col-sm-8">
														<input type="number" class="form-control" name="telepon" id="telepon" placeholder="Nomor Telepon" required="required">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Bank dan No.Rekening</label>
												<div class="col-sm-8">
														<input type="text" class="form-control" name="rekening" id="rekening" placeholder="Nama Bank dan Nomor Rekening" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Alamat Kost</label>
												<div class="col-sm-8">
														<input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">KTP</label>
												<div class="col-sm-8">
												Upload Foto KTP<span style="color:red">*</span><input type="file" name="img1" accept="image/*" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Password</label>
												<div class="col-sm-8">
													<input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Konfirmasi Password</label>
												<div class="col-sm-8">
												<input type="password" class="form-control" id="confpassword" name="confpassword" placeholder="Konfirmasi Password" required="required">
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-3">
													<button class="btn btn-primary" name="submit" type="submit">Daftar</button>
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