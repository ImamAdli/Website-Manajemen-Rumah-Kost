<!-- Printing -->
<link rel="stylesheet" href="css/printing.css">
		
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_GET) {
	$Kode = $_GET['code'];
	$mySql ="SELECT * FROM nama_kost WHERE email ='$Kode'";
	$myQry = mysqli_query($koneksidb, $mySql);
	$result = mysqli_fetch_array($myQry);
}
else {
	echo "Nomor Transaksi Tidak Terbaca";
	exit;
}
?>

<html>
<head>
</head>

<body>
	<div id="section-to-print">
		<div id="only-on-print">
			<h2>Detail Pemilik Kost</h2>
		</div>
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
			<h4 class="modal-title" id="myModalLabel">Detail Penyewa</h4>
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
						<input type="text" id="nis" required="required" class="form-control col-md-7 col-xs-12" name="nama" data-parsley-error-message="Field ini harus diisi" value="<?php echo $result['CreationDate'];?>" readonly>
					</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">KTP</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<img src="img/id/<?php echo htmlentities($result['ktp']);?>" height="150">
					</div>
			</div>
		</form>
		<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</body>
</html>