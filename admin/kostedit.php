<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0){	
header('location:index.php');
}else{ 
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
	<title>Narty Boarding House | Admin Edit Info Kost</title>
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
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">

<script type="text/javascript">
function valid(theform){
	pola_nama=/^[a-zA-Z0-9 ]*$/;
	if (!pola_nama.test(theform.kosttitle.value)){
	alert ('Hanya huruf yang diperbolehkan untuk Nama Kamar Kost!');
	theform.kosttitle.focus();
	return false;
	}
	return (true);
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
						<h2 class="page-title">Edit Kamar Kost</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Form Edit Kamar Kost</div>
									<div class="panel-body">
										<?php 
										$id=intval($_GET['id']);
										$sql ="SELECT kamar_kost.*,pemilik_kost.* FROM kamar_kost, pemilik_kost WHERE kamar_kost.id_pemilik=pemilik_kost.id_pemilik AND kamar_kost.id_kamar='$id'";
										$query = mysqli_query($koneksidb,$sql);
										$result = mysqli_fetch_array($query);
										?>
										<form method="post" class="form-horizontal" name="theform" action ="kosteditact.php" onsubmit="return valid(this);" enctype="multipart/form-data">
											<div class="form-group">
												<label class="col-sm-2 control-label">Nama Kamar Kost<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="hidden" name="id" class="form-control" value="<?php echo $id;?>" required>
													<input type="text" name="kosttitle" class="form-control" value="<?php echo htmlentities($result['nama_kamar']);?>" required>
												</div>
												<label class="col-sm-2 control-label">Nama Kost<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<select class="form-control" name="namakostname" required="" data-parsley-error-message="Field ini harus diisi" >
													<?php
													$idkost=$result['id_pemilik'];
													$nmkost=$result['nama_kost'];
													if($_SESSION['alogin'] != 'admin'){
															echo "<option value='$idkost'>$nmkost</option>";
													}else{
														echo "<option value='$idkost'>$nmkost</option>";
														$mySql = "SELECT * FROM pemilik_kost ORDER BY id_pemilik";
														$myQry = mysqli_query($koneksidb, $mySql);
														while ($myData = mysqli_fetch_array($myQry)) {
														if ($myData['id_pemilik']== $datapemilik_kost) {
															$cek = " selected";
															} else { $cek=""; }
															echo "<option value='$myData[id_pemilik]' $cek>$myData[nama_kost] </option>";
														}
													}
													?>
													</select>
												</div>
											</div>
											<div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Deskripsi Kamar Kost<span style="color:red">*</span></label>
												<div class="col-sm-10">
													<textarea class="form-control" name="vehicalorcview" rows="3" required><?php echo htmlentities($result['deskripsi']);?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Harga /Hari<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="priceperday" class="form-control" value="<?php echo htmlentities($result['harga']);?>" required>
												</div>
												<label class="col-sm-2 control-label">Kamar Mandi<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<select class="form-control" name="bathinfo" required>
														<?php
															$jk = $result['bath'];
															echo "<option value='$jk' selected>".$jk."</option>";
															echo "<option value='Diluar'>Diluar</option>";
															echo "<option value='Didalam'>Didalam</option>";
														?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Luas Kamar (m²)<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="modelluas" class="form-control" value="<?php echo htmlentities($result['luas']);?>" required>
												</div>
												<label class="col-sm-2 control-label">AC (Air Conditioner)<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<select class="form-control" name="acinfo" required>
														<?php
															$jc = $result['ac'];
															echo "<option value='$jc' selected>".$jc."</option>";
															echo "<option value='Ada'>Ada</option>";
															echo "<option value='Tidak Ada'>Tidak Ada</option>";
														?>
													</select>											
												</div>
											</div>
											<div class="hr-dashed"></div>								
											<div class="form-group">
												<div class="col-sm-12">
													<h3><b><center>Gambar Kamar Kost</center></b></h3>
												</div>
											</div>
											<div class="form-group">
												<?php
												$imagesString = $result['images'];
												$imagesArray = explode(',', $imagesString);
												foreach ($imagesArray as $index => $image) {
												$image = trim($image); // Hapus spasi di awal dan akhir string jika ada
												?>
												<div class="col-sm-4">
														<label class="control-label">Gambar <?php echo $index + 1; ?></label><br/>
														<img src="img/kostimages/<?php echo htmlentities($image); ?>" alt="Gambar <?php echo $index + 1; ?>" class="img-responsive"/><br/>
												</div>
												<?php } ?>
											</div>
											<div class="form-group">
												<div class="col-sm-10 col-sm-offset-1">
													<h3><b><center>Ganti Gambar Kamar</center></b></h3>
													<label for="file" class="drop-container" id="dropcontainer">
														<span class="drop-title">Drag and Drop Images Here &nbsp;<i class="fa fa-picture-o"></i></span>
														or
														<input type="file" id="file" name="imgupt[]" accept="image/*" multiple onchange="previewImages()">
													</label>
													<input type="text" name="textimg" value="<?php echo htmlentities($result['images']);?>" hidden>
													<div id="preview-container" class="preview-container"></div>
												</div>
											</div>
											<div class="hr-dashed"></div>	
											<div class="form-group">
												<div class="checkbox checkbox-inline">
													<button class="btn btn-primary" type="submit" style="margin-top:4%">Simpan Perubahan</button>
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