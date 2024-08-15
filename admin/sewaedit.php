<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
require '../vendor/autoload.php'; // Tambahkan ini untuk autoload PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(strlen($_SESSION['alogin'])==0){	
header('location:index.php');
}else{
	if(isset($_POST['submit'])){
		$status = $_POST['status'];
		$kode = $_POST['id'];

		if ($status == 'Dibatalkan') {
			// Hapus pesanan jika status adalah Dibatalkan
			$mySql = "DELETE FROM booking WHERE kode_booking='$kode'";
			$myQry = mysqli_query($koneksidb, $mySql);
			$mySql1 = "DELETE FROM cek_booking WHERE kode_booking='$kode'";
			$myQry1 = mysqli_query($koneksidb, $mySql1);
		} else {
			// Update status pesanan
			$mySql = "UPDATE booking SET status = '$status' WHERE kode_booking='$kode'";
			$myQry = mysqli_query($koneksidb, $mySql);
			$mySql1 = "UPDATE cek_booking SET status = '$status' WHERE kode_booking='$kode'";
			$myQry1 = mysqli_query($koneksidb, $mySql1);
		}

		// Ambil email penyewa dari database
		$sqlEmail = "SELECT users.email FROM booking JOIN users ON booking.email = users.email WHERE booking.kode_booking='$kode'";
		$queryEmail = mysqli_query($koneksidb, $sqlEmail);
		$resultEmail = mysqli_fetch_array($queryEmail);
		$emailPenyewa = $resultEmail['email'];

		// Kirim email notifikasi ke penyewa menggunakan PHPMailer
		$mail = new PHPMailer(true);
		try {
			//Server settings
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'nartylaptop17@gmail.com'; // Ganti dengan email Anda
			$mail->Password = 'ntobkniigiqnpznx'; // Ganti dengan password email Anda
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Menggunakan SMTPS sesuai dengan pengaturan SSL
			$mail->Port = 465; // Port yang sesuai dengan pengaturan SSL

			//Recipients
			$mail->setFrom('no-reply@yourdomain.com', 'Narty Boarding House');
			$mail->addAddress($emailPenyewa);

			//Content
			$mail->isHTML(true);
			$mail->Subject = 'Perubahan Status Transaksi';
			$mail->Body = "<b>Pemilik kost telah merubah status anda menjadi $status di transaksi $kode.</b>";

			$mail->send();
		} catch (Exception $e) {
			echo "Pesan tidak dapat dikirim. Mailer Error: {$mail->ErrorInfo}";
		}

		echo "<script type='text/javascript'>
			alert('Status berhasil diupdate.'); 
			document.location = 'sewa_konfirmasi.php'; 
			</script>";
	}else {
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
	<title>Narty Boarding House | Admin Edit Sewa kamar_kost</title>
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
</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Edit Status Sewa</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Info Penyewa</div>
									<div class="panel-body">
										<?php 
										$id=$_GET['id'];
										$sqlsewa = "SELECT booking.*,kamar_kost.*,pemilik_kost.*,users.* FROM booking,kamar_kost,pemilik_kost,users WHERE booking.id_kamar=kamar_kost.id_kamar
													AND pemilik_kost.id_pemilik=kamar_kost.id_pemilik AND users.email=booking.email AND booking.kode_booking ='$id'";
										$querysewa = mysqli_query($koneksidb,$sqlsewa);
										$result = mysqli_fetch_array($querysewa);
										$biayakost=$result['durasi']*$result['harga'];
										$total =$biayakost;
										?>
										<form method="post" class="form-horizontal" name="theform" enctype="multipart/form-data">
											<div class="form-group">
												<label class="col-sm-2 control-label">Kode Sewa</label>
												<div class="col-sm-4">
													<input type="text" name="id" class="form-control" value="<?php echo $id;?>" required readonly>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Status<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<select class="form-control" name="status" required>
															<?php
																$stt = $result['status'];
																echo "<option value='$stt' selected>".strtoupper($stt)."</option>";
																echo "<option value='Menunggu Pembayaran'>".strtoupper("Menunggu Pembayaran")."</option>";
																echo "<option value='Selesai'>".strtoupper("Selesai")."</option>";
																echo "<option value='Dibatalkan'>DIBATALKAN</option>";
															?>
													</select>
												</div>
											</div>
												<div class="form-group">
												<label class="col-sm-2 control-label">Penyewa</label>
												<div class="col-sm-4">
													<input type="text" name="penyewa" class="form-control" value="<?php echo $result['nama_user'];?>" required readonly>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Email Penyewa</label>
												<div class="col-sm-4">
													<input type="text" name="penyewa" class="form-control" value="<?php echo $result['email'];?>" required readonly>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Telepon Penyewa</label>
												<div class="col-sm-4">
													<input type="text" name="telp" class="form-control" value="<?php echo $result['telp'];?>" required readonly>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Alamat</label>
												<div class="col-sm-4">
													<textarea col="5" name="alamat" class="form-control" readonly><?php echo $result['alamat'];?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Bukti Bayar</label>
												<div class="col-sm-4">
													<a href="../image/bukti/<?php echo $result['bukti_bayar'];?>" target="_blank"><img src="../image/bukti/<?php echo $result['bukti_bayar'];?>" height="150"></a>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<button class="btn btn-primary" type="submit" name="submit" style="margin-top:4%">Simpan Perubahan</button>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Detail Sewa</div>
									<div class="panel-body">
										<form>
											<div class="form-group">
												<label class="col-sm-2 control-label">kost</label>
												<div class="col-sm-4">
													<input type="text" name="namakost" class="form-control" value="<?php echo $result['nama_kamar'];?>" required readonly>
												</div>
											</div>
											<br/>
											<div class="form-group">
												<label class="col-sm-2 control-label">Tanggal Mulai</label>
												<div class="col-sm-4">
													<input type="text" name="mulai" class="form-control" value="<?php echo IndonesiaTgl($result['tgl_mulai']);?>" required readonly>
												</div>
											</div>
											<br/>
											<div class="form-group">
												<label class="col-sm-2 control-label">Biaya kost</label>
												<div class="col-sm-4">
													<input type="text" name="biayakost" class="form-control" value="<?php echo format_rupiah($biayakost);?>" required readonly>
												</div>
											</div>
											<br/>
											<div class="form-group">
												<label class="col-sm-2 control-label">Tanggal Selesai</label>
												<div class="col-sm-4">
													<input type="text" name="selesai" class="form-control" value="<?php echo IndonesiaTgl($result['tgl_selesai']);?>" required readonly>
												</div>
											</div>
											<br/>
											<div class="form-group">
												<label class="col-sm-2 control-label">Total Biaya</label>
												<div class="col-sm-4">
													<input type="text" name="total" class="form-control" value="<?php echo format_rupiah($total);?>" required readonly>
												</div>
											</div>
											<br/>
											<div class="form-group">
												<label class="col-sm-2 control-label">Durasi</label>
												<div class="col-sm-4">
													<input type="text" name="durasi" class="form-control" value="<?php echo $result['durasi'];?>" required readonly>
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