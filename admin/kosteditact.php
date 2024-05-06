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
$kimage1=$_FILES["imgusr1"]["name"];
$kimage2=$_FILES["imgusr2"]["name"];
$kimage3=$_FILES["imgusr3"]["name"];
$kimage4=$_FILES["imgusr4"]["name"];
$kimage5=$_FILES["imgusr5"]["name"];
$imgoldData1 = $_POST['textimg1'];
$imgoldData2 = $_POST['textimg2'];
$imgoldData3 = $_POST['textimg3'];
$imgoldData4 = $_POST['textimg4'];
$imgoldData5 = $_POST['textimg5'];
move_uploaded_file($_FILES["imgusr1"]["tmp_name"],"img/kostimages/".$_FILES["imgusr1"]["name"]);
move_uploaded_file($_FILES["imgusr2"]["tmp_name"],"img/kostimages/".$_FILES["imgusr2"]["name"]);
move_uploaded_file($_FILES["imgusr3"]["tmp_name"],"img/kostimages/".$_FILES["imgusr3"]["name"]);
move_uploaded_file($_FILES["imgusr4"]["tmp_name"],"img/kostimages/".$_FILES["imgusr4"]["name"]);
move_uploaded_file($_FILES["imgusr5"]["tmp_name"],"img/kostimages/".$_FILES["imgusr5"]["name"]);

if($kimage1!="") {
	move_uploaded_file($_FILES["imgusr1"]["tmp_name"],"img/kostimages/".$_FILES["imgusr1"]["name"]);
} else {
	$kimage1 = $imgoldData1;
}
if($kimage2!="") {
	move_uploaded_file($_FILES["imgusr1"]["tmp_name"],"img/kostimages/".$_FILES["imgusr1"]["name"]);
} else {
	$kimage2 = $imgoldData2;
}
if($kimage3!="") {
	move_uploaded_file($_FILES["imgusr1"]["tmp_name"],"img/kostimages/".$_FILES["imgusr1"]["name"]);
} else {
	$kimage3 = $imgoldData3;
}
if($kimage4!="") {
	move_uploaded_file($_FILES["imgusr1"]["tmp_name"],"img/kostimages/".$_FILES["imgusr1"]["name"]);
} else {
	$kimage4 = $imgoldData4;
}
if($kimage5!="") {
	move_uploaded_file($_FILES["imgusr1"]["tmp_name"],"img/kostimages/".$_FILES["imgusr1"]["name"]);
} else {
	$kimage5 = $imgoldData5;
}

$id=$_POST['id'];
$sql="UPDATE kost SET nama_kamarkost='$kosttitle',id_namakost='$namakost',deskripsi='$kostoverview',harga='$priceperday',bath='$bathinfo',luas='$modelluas',
	ac='$acinfo', image1='$kimage1', image2='$kimage2', image3='$kimage3', image4='$kimage4', image5='$kimage5' where id_kamarkost='$id'";
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