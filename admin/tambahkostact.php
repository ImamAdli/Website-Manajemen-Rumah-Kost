<?php
include('includes/config.php');
error_reporting(0);
$kosttitle=$_POST['kosttitle'];
$namakost=$_POST['kostname'];	
$kostoverview=$_POST['kostview'];
$priceperday=$_POST['priceperday'];
$bathinfo=$_POST['bathinfo'];
$modelluas=$_POST['modelluas'];
$acinfo=$_POST['acinfo'];
$totalImages = count($_FILES['files']['name']);
for ($i = 0; $i < $totalImages; $i++) {
	$fileNames[] = $_FILES['files']['name'][$i];
	move_uploaded_file($_FILES["files"]["tmp_name"][$i],"img/kostimages/".$_FILES["files"]["name"][$i]);
}
$fileNamesString = implode(",",$fileNames);
$sql 	= "INSERT INTO kamar_kost (nama_kamar,id_pemilik,deskripsi,harga,bath,luas,ac,images)
			VALUES ('$kosttitle','$namakost','$kostoverview','$priceperday','$bathinfo','$modelluas','$acinfo',
			'$fileNamesString')";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
		alert('Berhasil tambah data.'); 
		document.location = 'kost.php'; 
		</script>";
}else {
	echo "No Error : ".mysqli_errno($koneksidb);
	echo "<br/>";
	echo "Pesan Error : ".mysqli_error($koneksidb);
	echo "<script type='text/javascript'>
		alert('Terjadi kesalahan, silahkan coba lagi!.'); 
		document.location = 'tambahkost.php'; 
		</script>";
}
?>