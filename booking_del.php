<?php
error_reporting(0);
include('includes/config.php');
if(isset($_GET['id'])){
	$id	= $_GET['id'];
	$mySql	= "DELETE FROM booking WHERE kode_booking='$id'";
	$myQry	= mysqli_query($koneksidb, $mySql);
	echo "<script type='text/javascript'>
			alert('Penyewaan Berhasil Dibatalkan'); 
			document.location = 'riwayat_sewa.php'; 
		</script>";
}else {
	echo "<script type='text/javascript'>
		alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'riwayat_sewa.php'; 
	</script>";
}
?>