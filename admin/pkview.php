<!-- Printing -->
<link rel="stylesheet" href="css/printing.css">
		
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_GET) {
	$Kode = $_GET['code'];
	$mySql ="SELECT * FROM pemilik_kost WHERE email ='$Kode'";
	$myQry = mysqli_query($koneksidb, $mySql);
	$result = mysqli_fetch_array($myQry);
}
else {
	echo "Nomor Transaksi Tidak Terbaca";
	exit;
}
?>

<html>
<body>
	<div id="section-to-print">
		<div id="only-on-print">
			<h2>Detail Pemilik Kost</h2>
		</div>
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
			<h4 class="modal-title" id="myModalLabel">Detail Pemilik Kost</h4>
		</div>
		<div><br/></div>
		<form id="theform" data-parsley-validate class="form-horizontal form-label-left" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Kost</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" id="nis" required="required" class="form-control col-md-7 col-xs-12" name="nama" data-parsley-error-message="Field ini harus diisi" value="<?php echo $result['nama_kost'];?>" readonly>
					</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Pemilik Kost</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" id="nis" required="required" class="form-control col-md-7 col-xs-12" name="nama" data-parsley-error-message="Field ini harus diisi" value="<?php echo $result['nama_pemilik'];?>" readonly>
					</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Email</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" id="nis" required="required" class="form-control col-md-7 col-xs-12" name="nama" data-parsley-error-message="Field ini harus diisi" value="<?php echo $result['email'];?>" readonly>
					</div>
			</div>	
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nomor Telepon</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" id="nis" required="required" class="form-control col-md-7 col-xs-12" name="nama" data-parsley-error-message="Field ini harus diisi" value="<?php echo $result['telepon'];?>" readonly>
					</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nomor Rekening</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" id="nis" required="required" class="form-control col-md-7 col-xs-12" name="nama" data-parsley-error-message="Field ini harus diisi" value="<?php echo $result['rekening'];?>" readonly>
					</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Tanggal Daftar</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" id="nis" required="required" class="form-control col-md-7 col-xs-12" name="nama" data-parsley-error-message="Field ini harus diisi" value="<?php echo $result['regDate'];?>" readonly>
					</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">KTP</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<img src="img/id/<?php echo htmlentities($result['ktp']);?>" height="150">
					</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Lokasi Kost</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				<style>
				#map {
						height: 400px;
						width: 100%;
				}
				</style>
				<div id="map"></div>
				<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_iV3faeC_1QJw69QzDDFbUXVL4G9XbtU&callback=initMap"></script>
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
		</form>
		<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</body>
</html>