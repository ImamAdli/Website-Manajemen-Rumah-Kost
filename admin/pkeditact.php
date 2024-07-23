<?php
include('includes/config.php');
$id		= $_POST['id'];
$namakost	= $_POST['namakost'];
$email = $_POST['email'];
$telepon = $_POST['telepon'];
$namapemilik= $_POST['namapemilik'];
$rekening = $_POST['rekening'];
$alamat = $_POST['alamat'];
$tipekost = $_POST['tipekost'];
$statuspk = $_POST['statuspk'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$sql 	= "UPDATE pemilik_kost SET nama_kost='$namakost', email='$email', telepon='$telepon', nama_pemilik='$namapemilik', rekening='$rekening', alamat='$alamat', tipe_kost='$tipekost', statuspk='$statuspk', latitude='$latitude', longitude='$longitude'  WHERE id_pemilik='$id'";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
		alert('Berhasil edit data.'); 
		document.location = 'pk.php'; 
		</script>";

}else {
	echo "<script type='text/javascript'>
		alert('Terjadi kesalahan, silahkan coba lagi!.'); 
		document.location = 'pkedit.php?id=$id'; 
		</script>";
}
?>