<?php
include('includes/config.php');
error_reporting(0);
$kosttitle=$_POST['kosttitle'];
$namakost=$_POST['namakostname'];
$kostoverview=$_POST['vehicalorcview'];
$priceperday=$_POST['priceperday'];
$bathinfo=$_POST['bathinfo'];
$modelluas=$_POST['modelluas'];
$acinfo=$_POST['acinfo'];
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
$id=$_POST['id'];

$sql="UPDATE kost SET nama_kamarkost='$kosttitle',id_namakost='$namakost',deskripsi='$kostoverview',harga='$priceperday',bath='$bathinfo',luas='$modelluas',
	ac='$acinfo' where id_kamarkost='$id'";
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