<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0){	
header('location:index.php');
}else{
// Code for change password	
if(isset($_POST['updatepk'])){
	$name=$_POST['fullname'];
	$kosteno=$_POST['kostenumber'];
	$address=$_POST['address'];
	$email=$_POST['email'];
	$statuspk = "Pending";
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];
	// $ktp=$_POST['ktp'];
	$rekening=$_POST['rekening'];
	$imgoldData = $_POST['textimg'];
	$file = $_FILES['imgusr']['name'];
	
	if($file!="") {
		move_uploaded_file($_FILES["imgusr"]["tmp_name"],"img/id/".$_FILES['imgusr']['name']);
	} else {
		$file = $imgoldData;
	}

	$sql="UPDATE nama_kost SET nama_pemilik='$name',telepon='$kosteno',
	alamat='$address', ktp='$file', rekening='$rekening', statuspk='$statuspk', 
	latitude='$latitude', longitude='$longitude'  WHERE email='$email'";
	$query = mysqli_query($koneksidb,$sql);
	if($query){
	$msg="Profile berhasi diupdate.";
	}else{
    echo "No Error : ".mysqli_errno($koneksidb);
    echo "<br/>";
    echo "Pesan Error : ".mysqli_error($koneksidb);	
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
<link rel="stylesheet" href="css/fileinput.min.css">
<!-- Awesome Bootstrap checkbox -->
<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
<!-- Admin Stye -->
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript">
function checkLetter(theform)
{
  pola_nama=/^[a-zA-Z .]*$/;
  if (!pola_nama.test(theform.fullname.value)){
  alert ('Hanya huruf yang diperbolehkan untuk Nama!');
  theform.fullname.focus();
  return false;
  }
  return (true);
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
<?php 
$useremail=$_SESSION['alogin'];
$sql = "SELECT * from nama_kost where email='$useremail'";
$query = mysqli_query($koneksidb,$sql);
while($result=mysqli_fetch_array($query)){
?>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Ubah Data Pemilik Kost</h2>
						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Form Ubah Data Pemilik Kost</div>
									<div class="panel-body">
										<?php  if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
										<form  method="post" name="theform" onSubmit="return checkLetter(this);" enctype="multipart/form-data">
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label">Tanggal Daftar -</label>
													<?php echo htmlentities($result['CreationDate']);?>
												</div>
												<?php if($result['UpdationDate']!=""){?>
												<div class="form-group">
													<label class="control-label">Terakhir diupdate pada  -</label>
												<?php echo htmlentities($result['UpdationDate']);?>
												</div>
												<?php } ?>
												<div class="form-group">
													<label class="control-label">Nama</label>
													<input class="form-control white_bg" name="fullname" value="<?php echo htmlentities($result['nama_pemilik']);?>" id="fullname" type="text"  required>
												</div>
												<div class="form-group">
													<label class="control-label">Email</label>
													<input class="form-control white_bg" value="<?php echo htmlentities($result['email']);?>" name="email" id="email" type="email" required readonly>
												</div>
												<div class="form-group">
													<label class="control-label">Alamat Kost</label>
													<input class="form-control white_bg" value="<?php echo htmlentities($result['alamat']);?>" name="address" id="address" type="text" required>
												</div>
												<div class="form-group">
													<label class="control-label">Rekening</label>
													<input class="form-control white_bg" value="<?php echo htmlentities($result['rekening']);?>" name="rekening" id="rekening" type="text" required>
												</div>
												<div class="form-group">
													<label class="control-label">Telepon</label>
													<input class="form-control white_bg" name="kostenumber" value="<?php echo htmlentities($result['telepon']);?>" id="phone-number" type="number" min="0" required>
												</div>
												<div class="form-group">
													<label class="control-label">KTP</label><br/>
													<img src="img/id/<?php echo htmlentities($result['ktp']);?>" width="300"  style="border:solid 1px #000"><br/>
													<input type="text" name="textimg" value="<?php echo htmlentities($result['ktp']);?>" hidden>
													<label>Ganti Gambar KTP</label><input type="file" name="imgusr">
												</div>
												<div class="form-group">
													<style>
															#map {
																	height: 400px;
																	width: 100%;
															}
													</style>
													<body>
													<h4>Pilih Lokasi pada Peta</h4>
													<div id="map"></div>
													<input type="text" name="latitude" id="latitude" hidden><br>
													<input type="text" name="longitude" id="longitude" hidden><br>
													<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_iV3faeC_1QJw69QzDDFbUXVL4G9XbtU&callback=initMap"></script>
													<script>
														function initMap() {
															var map = new google.maps.Map(document.getElementById('map'), {
																	center: {lat: -6.175110, lng: 106.865039}, // Default lokasi (Monas, Jakarta)
																	zoom: 12
															});
															var marker = new google.maps.Marker({
																	position: {lat: -6.175110, lng: 106.865039},
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
												<?php } ?>
												<div class="form-group">
													<button type="submit" name="updatepk" class="btn btn-primary col-md-3">Simpan Perubahan <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
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