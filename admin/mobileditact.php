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
$id=$_POST['id'];

$sql="UPDATE mobil SET nama_mobil='$vehicletitle',id_merek='$brand',nopol='$nopol',deskripsi='$vehicleoverview',harga='$priceperday',bb='$fueltype',tahun='$modelyear',
	seating='$seatingcapacity' where id_mobil='$id'";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			alert('Berhasil edit data.'); 
			document.location = 'kost.php'; 
		</script>";
}else {
			echo "No Error : ".mysqli_errno($koneksidb);
			echo "<br/>";
			echo "Pesan Error : ".mysqli_error($koneksidb);

	echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'kostedit.php?id=$id'; 
		</script>";
}
?>