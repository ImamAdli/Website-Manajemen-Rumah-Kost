<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/library.php');

		$image1=$_FILES["img1"]["name"];
		$newimg1 = date('dmYHis').$image1;
		$kode = $_POST['kode'];
		$stt = "Menunggu Konfirmasi";

		move_uploaded_file($_FILES["img1"]["tmp_name"],"image/bukti/".$newimg1);

		$sql="UPDATE booking SET bukti_bayar='$newimg1', status='$stt' WHERE kode_booking='$kode'";
		$lastInsertId = mysqli_query($koneksidb, $sql);
		if($lastInsertId){
			echo "<script>alert('Upload Bukti Pembayaran Berhasil!');</script>";
			echo "<script type='text/javascript'> document.location = 'riwayatsewa.php'; </script>";
		}else {
			echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
			echo "<script type='text/javascript'> document.location = 'bookingedit.php?kode'".$kode."'; </script>";
		}
?>