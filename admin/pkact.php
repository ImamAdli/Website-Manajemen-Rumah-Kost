<?php
session_start();
error_reporting(0);
include('includes/config.php');
$namakost	= $_POST['namakost'];
$email = $_POST['emailid'];
$password = $_POST['password'];
$conf = $_POST['confpassword'];
$telepon = $_POST['telepon'];
$namapemilik= $_POST['namapemilik'];
$rekening = $_POST['rekening'];
$alamat = $_POST['alamat'];
$tipekost = $_POST['tipekost'];
$statuspk = "Pending";
$images=$_FILES["img1"]["name"];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$newimg1 = date('d-m-Y-His').$images;
move_uploaded_file($_FILES["img1"]["tmp_name"],"img/id/".$newimg1);
if($conf!=$password){
	echo "<script>alert('Password tidak sama!');</script>";
	echo "<script type='text/javascript'> document.location = 'registpk.php'; </script>";			
}else{
	$sqlcek = "SELECT email FROM pemilik_kost WHERE email='$email'";
	$querycek = mysqli_query($koneksidb,$sqlcek);
		if(mysqli_num_rows($querycek)>0){
			echo "<script>alert('Email sudah terdaftar, silahkan gunakan email lain!');</script>";
			echo "<script type='text/javascript'> document.location = 'registpk.php'; </script>";			
		}else{
			$password=md5($_POST['password']);
			$sql1="INSERT INTO pemilik_kost (nama_kost,email,password,telepon,nama_pemilik,rekening,alamat,tipe_kost,ktp,statuspk,latitude,longitude) VALUES 
			('$namakost','$email','$password','$telepon','$namapemilik','$rekening','$alamat','$tipekost','$newimg1','$statuspk','$latitude','$longitude')";
			$lastInsertId = mysqli_query($koneksidb, $sql1);
				if($lastInsertId){
					if($_SESSION['alogin'] == 'admin'){	
						echo "<script>alert('Pemilik Kost Berhasil ditambahkan.');</script>";
						echo "<script type='text/javascript'> document.location = 'pk.php'; </script>";
					} else {
						echo "<script>alert('Registrasi berhasil. Sekarang anda bisa login.');</script>";
						echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
					}
				}else {
					if($_SESSION['alogin'] == 'admin'){	
						echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
						echo "<script type='text/javascript'> document.location = 'addpk.php'; </script>";
					} else {
						echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
						echo "<script type='text/javascript'> document.location = 'registpk.php'; </script>";
					}
				}
		}	
}
?>