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
	
	<title>RentalMobil | Admin Edit Info Mobil</title>

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
function valid(theform){
		pola_nama=/^[a-zA-Z ]*$/;
		if (!pola_nama.test(theform.vehicletitle.value)){
		alert ('Hanya huruf yang diperbolehkan untuk Nama Mobil!');
		theform.vehicletitle.focus();
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
					
						<h2 class="page-title">Edit Mobil</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Form Edit Mobil</div>
									<div class="panel-body">
										<?php 
										$id=intval($_GET['id']);
										$sql ="SELECT mobil.*,merek.* FROM mobil, merek WHERE mobil.id_merek=merek.id_merek AND mobil.id_mobil='$id'";
										$query = mysqli_query($koneksidb,$sql);
										$result = mysqli_fetch_array($query);
										?>

										<form method="post" class="form-horizontal" name="theform" action ="mobileditact.php" onsubmit="return valid(this);" enctype="multipart/form-data">
										<div class="form-group">
											<label class="col-sm-2 control-label">Nama Mobil<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="hidden" name="id" class="form-control" value="<?php echo $id;?>" required>
												<input type="text" name="vehicletitle" class="form-control" value="<?php echo htmlentities($result['nama_mobil']);?>" required>
											</div>
											<label class="col-sm-2 control-label">Merek<span style="color:red">*</span></label>
				<div class="col-sm-4">
											<select class="form-control" name="brandname" required="" data-parsley-error-message="Field ini harus diisi" >
												<option value="">== Pilih Merek ==</option>
													<?php
														$mySql = "SELECT * FROM merek ORDER BY id_merek";
														$myQry = mysqli_query($koneksidb, $mySql);
														while ($myData = mysqli_fetch_array($myQry)) {
															if ($myData['id_merek']== $dataMerek) {
															$cek = " selected";
															} else { $cek=""; }
															echo "<option value='$myData[id_merek]' $cek>$myData[nama_merek] </option>";
														}
													?>
											</select>
										</div>
										</div>
																					
										<div class="hr-dashed"></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Deskripsi Mobil<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<textarea class="form-control" name="vehicalorcview" rows="3" required><?php echo htmlentities($result['deskripsi']);?></textarea>
											</div>
											<label class="col-sm-2 control-label">No. Polisi<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" name="nopol" class="form-control" value="<?php echo htmlentities($result['nopol']);?>" required>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Harga /Hari<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" name="priceperday" class="form-control" value="<?php echo htmlentities($result['harga']);?>" required>
											</div>
											<label class="col-sm-2 control-label">Jenis Bahan Bakar<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<select class="form-control" name="fueltype" required>
														<?php
															$jk = $result['bb'];
															echo "<option value='$jk' selected>".$jk."</option>";
															echo "<option value='Bensin'>Bensin</option>";
															echo "<option value='Diesel'>Diesel</option>";
														?>
												</select>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Tahun Registrasi<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" name="modelyear" class="form-control" value="<?php echo htmlentities($result['tahun']);?>" required>
											</div>
											<label class="col-sm-2 control-label">Jumlah Tempat Duduk<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" name="seatingcapacity" class="form-control" value="<?php echo htmlentities($result['seating']);?>" required>
											</div>
										</div>
										
										<div class="hr-dashed"></div>								
										
										<div class="form-group">
											<div class="col-sm-12">
												<h4><b>Gambar Mobil</b></h4>
											</div>
										</div>

										<div class="form-group">
											<div class="col-sm-4">
												Gambar 1 <img src="img/vehicleimages/<?php echo htmlentities($result['image1']);?>" width="300" style="border:solid 1px #000">
												<a href="changeimage1.php?imgid=<?php echo htmlentities($result['id_mobil'])?>">Ganti Gambar 1</a>
											</div>
											<div class="col-sm-4">
												Gambar 2<img src="img/vehicleimages/<?php echo htmlentities($result['image2']);?>" width="300" style="border:solid 1px #000">
												<a href="changeimage2.php?imgid=<?php echo htmlentities($result['id_mobil'])?>">Ganti Gambar 2</a>
											</div>
											<div class="col-sm-4">
												Gambar 3<img src="img/vehicleimages/<?php echo htmlentities($result['image3']);?>" width="300" style="border:solid 1px #000">
												<a href="changeimage3.php?imgid=<?php echo htmlentities($result['id_mobil'])?>">Ganti Gambar 3</a>
											</div>
										</div>


										<div class="form-group">
											<div class="col-sm-4">
												Gambar 4<img src="img/vehicleimages/<?php echo htmlentities($result['image4']);?>" width="300" style="border:solid 1px #000">
												<a href="changeimage4.php?imgid=<?php echo htmlentities($result['id_mobil'])?>">Ganti Gambar 4</a>
											</div>
											<div class="col-sm-4">
												Gambar 5

													<img src="img/vehicleimages/<?php echo htmlentities($result['image5']);?>" width="300" style="border:solid 1px #000">
													<a href="changeimage5.php?imgid=<?php echo htmlentities($result['id_mobil'])?>">Ganti Gambar 5</a>
												
											</div>
										</div>
										
										<div class="hr-dashed"></div>									
										
									</div>
								</div>
							</div>
						</div>

									
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="form-group">
										<div class="col-sm-3">
											<div class="checkbox checkbox-inline">
												<button class="btn btn-primary" type="submit" style="margin-top:4%">Save changes</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					</div>
				</div>
				</form>

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