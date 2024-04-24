<?php
include('includes/config.php');
error_reporting(0);
$vehicletitle=$_POST['vehicletitle'];
$brand=$_POST['brandname'];
$nopol=$_POST['nopol'];
$vehicleoverview=$_POST['vehicalorcview'];
$priceperday=$_POST['priceperday'];
$fueltype=$_POST['fueltype'];
$modelyear=$_POST['modelyear'];
$seatingcapacity=$_POST['seatingcapacity'];
$kimage1=$_FILES["img1"]["name"];
$kimage2=$_FILES["img2"]["name"];
$kimage3=$_FILES["img3"]["name"];
$kimage4=$_FILES["img4"]["name"];
$kimage5=$_FILES["img5"]["name"];
move_uploaded_file($_FILES["img1"]["tmp_name"],"img/kostimages/".$_FILES["img1"]["name"]);
move_uploaded_file($_FILES["img2"]["tmp_name"],"img/kostimages/".$_FILES["img2"]["name"]);
move_uploaded_file($_FILES["img3"]["tmp_name"],"img/kostimages/".$_FILES["img3"]["name"]);
move_uploaded_file($_FILES["img4"]["tmp_name"],"img/kostimages/".$_FILES["img4"]["name"]);
move_uploaded_file($_FILES["img5"]["tmp_name"],"img/kostimages/".$_FILES["img5"]["name"]);
$sql 	= "INSERT INTO mobil (nama_mobil,id_merek,nopol,deskripsi,harga,bb,tahun,seating,image1,image2,image3,image4,image5)
			VALUES ('$vehicletitle','$brand','$nopol','$vehicleoverview','$priceperday','$fueltype','$modelyear','$seatingcapacity',
			'$kimage1','$kimage2','$kimage3','$kimage4','$kimage5')";
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