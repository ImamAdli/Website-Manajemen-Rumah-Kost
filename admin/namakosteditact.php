<?php
include('includes/config.php');
$id		= $_POST['id'];
$namakost	= $_POST['namakost'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$telepon = $_POST['telepon'];
$namapemilik= $_POST['namapemilik'];
$rekening = $_POST['rekening'];
$alamat = $_POST['alamat'];
$sql 	= "UPDATE nama_kost SET nama_kost='$namakost', email='$email', password='$password', telepon='$telepon', nama_pemilik='$namapemilik', rekening='$rekening', alamat='$alamat' WHERE id_namakost='$id'";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			alert('Berhasil edit data.'); 
			document.location = 'namakost.php'; 
		</script>";

}else {
	echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'namakostedit.php?id=$id'; 
		</script>";

}
?>