<?php
session_start();
error_reporting(0);
include('includes/config.php');
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
function checkLetter(theform){
	pola_nama=/^[a-zA-Z .]*$/;
	if (!pola_nama.test(theform.namapemilik.value)){
		alert ('Hanya huruf yang diperbolehkan untuk Nama!');
		theform.namapemilik.focus();
		return false;
	}

	if(theform.password.value!= theform.confpassword.value){
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
</head>

<body>
	<div class="ts-main-content">
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Daftar Akun Pemilik Kost</h2>
						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading"> Form Daftar Akun Pemilik Kost</div>
									<div class="panel-body">
									<form  method="post" name="theform" class="form-horizontal" action="pkact.php" id="theform" onSubmit="return checkLetter(this); " enctype="multipart/form-data">
									<div class="form-group">
										<label class="col-sm-3 control-label">Nama Kost</label>
										<div class="col-sm-8">
												<input type="text" class="form-control" name="namakost" id="namakost" placeholder="Nama Kost" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Nama Pemilik</label>
										<div class="col-sm-8">
												<input type="text" class="form-control" name="namapemilik" placeholder="Nama Pemilik" required>
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
										<label class="col-sm-3 control-label">Tipe Kost</label>
										<div class="col-sm-8">
											<select class="form-control" name="tipekost" id="tipekost" required>
												<option value="Pria">Pria</option>
												<option value="Wanita">Wanita</option>
												<option value="Campur" selected>Campur</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-10 col-sm-offset-1">
											<style>
												#map {
													height: 400px;
													width: 100%;
													}
												</style>
												<h4>Pilih Lokasi Kost pada Google Maps</h4>
												<div id="map"></div>
												<input type="text" name="latitude" id="latitude" hidden>
												<input type="text" name="longitude" id="longitude" hidden>
												<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_iV3faeC_1QJw69QzDDFbUXVL4G9XbtU&callback=initMap"></script>
												<script>
													function initMap() {
														var map = new google.maps.Map(document.getElementById('map'), {
															center: {lat: -0.8262803081990282, lng: 100.35501429355675}, // Default lokasi (Monas, Jakarta)
															zoom: 15
														});
														var marker = new google.maps.Marker({
															position: {lat: -0.8262803081990282, lng: 100.35501429355675},
															map: map,
															draggable: true // Marker dapat digeser
														});
														// Ketika marker digeser, update nilai latitude dan longitude pada form
														marker.addListener('dragend', function(event) {
															document.getElementById('latitude').value = event.latLng.lat();
															document.getElementById('longitude').value = event.latLng.lng();
														});
														// Ketika peta diklik, pindahkan marker dan update form
														map.addListener('click', function(event) {
															marker.setPosition(event.latLng);
															document.getElementById('latitude').value = event.latLng.lat();
															document.getElementById('longitude').value = event.latLng.lng();
														});
													}
											</script>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">KTP</label>
										<div class="col-sm-8">
											Upload Foto KTP<span style="color:red">*</span><input type="file" id="file" name="img1" accept="image/*" required>
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
										<div class="col-sm-10 col-sm-offset-1">
											<button class="btn btn-primary col-sm-2"  name="submit" type="submit">Daftar</button>
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