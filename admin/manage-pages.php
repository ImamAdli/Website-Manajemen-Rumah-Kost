<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0){	
	header('location:index.php');
}
else{
	if($_POST['submit']=="Update"){
		$pagetype=$_GET['type'];
		$pagedetails=$_POST['pgedetails'];
		$sql = "UPDATE tblpages SET detail='$pagedetails' WHERE type='$pagetype'";
		$query = mysqli_query($koneksidb,$sql);
		$msg="Page data updated  successfully";
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
	<title>Narty Boarding House | Admin Kelola Halaman</title>
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

	<script type="text/javascript" src="js/nicEdit.js"></script>
	<script type="text/javascript">
		bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
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
						<h2 class="page-title">Kelola Halaman</h2>
						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Form Kelola Halaman</div>
									<div class="panel-body">
										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
											<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
											else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
											<div class="form-group">
												<label class="col-sm-4 control-label">Pilih Halaman</label>
												<div class="col-sm-4">
													<select name="menu1" class="form-control" onChange="MM_jumpMenu('parent',this,0)">
														<option value="" selected="selected" class="form-control">***Pilih Halaman***</option>
														<option value="manage-pages.php?type=terms">Syarat dan Ketentuan</option>
														<option value="manage-pages.php?type=privacy">Kebijakan Privasi</option>
														<option value="manage-pages.php?type=aboutus">Tentang Kami</option> 
														<option value="manage-pages.php?type=faqs">Pertanyaan Terkait</option>
													</select>
												</div>
											</div>
											<div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-4 control-label">Halaman Terpilih</label>
												<div class="col-sm-4">
												<?php
												switch($_GET['type']){
													case "terms" :
														echo "<input type='text' class='form-control' value='Syarat dan Ketentuan' readonly>";
														break;
													case "privacy" :
														echo "<input type='text' class='form-control' value='Kebijakan Privasi' readonly>";
														break;
													case "aboutus" :
														echo "<input type='text' class='form-control' value='Tentang Kami' readonly>";
														break;
													case "faqs" :
														echo "<input type='text' class='form-control' value='Pertanyaan Terkait' readonly>";
														break;
													default :
														echo "<input type='text' class='form-control' value='' readonly>";
														break;
												}
												?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label">Detail Halaman</label>
												<div class="col-sm-8">
													<textarea class="form-control" rows="5" cols="50" name="pgedetails" id="pgedetails" placeholder="Package Details" required>
													<?php 
													$pagetype=$_GET['type'];
													$sql = "SELECT detail from tblpages where type='$pagetype'";
													$query = mysqli_query($koneksidb,$sql);
													while($result=mysqli_fetch_array($query))
													{		
														echo htmlentities($result['detail']);
													}
													?>
													</textarea> 
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
													<button type="submit" name="submit" value="Update" id="submit" class="btn-primary btn">Update</button>
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