<?php
include('includes/config.php');
error_reporting(0);
$kosttitle = $_POST['kosttitle'];
$namakost = $_POST['namakostname'];
$kostoverview = $_POST['vehicalorcview'];
$priceperday = $_POST['priceperday'];
$bathinfo = $_POST['bathinfo'];
$modelluas = $_POST['modelluas'];
$acinfo = $_POST['acinfo'];
$totalImages = count($_FILES['imgupt']['name']);
$imgold = $_POST['textimg'];

if ($totalImages > 0 && !empty($_FILES['imgupt']['name'][0])) {
    $fileNames = [];
    for ($i = 0; $i < $totalImages; $i++) {
        $fileNames[] = $_FILES['imgupt']['name'][$i];
        move_uploaded_file($_FILES["imgupt"]["tmp_name"][$i], "img/kostimages/" . $_FILES["imgupt"]["name"][$i]);
    }
    $fileNamesString = implode(",", $fileNames);
} else {
    $fileNamesString = $imgold;
}

$id = $_POST['id'];
$sql = "UPDATE kamar_kost SET 
    nama_kamar='$kosttitle',
    id_pemilik='$namakost',
    deskripsi='$kostoverview',
    harga='$priceperday',
    bath='$bathinfo',
    luas='$modelluas',
    ac='$acinfo',
    images='$fileNamesString' 
WHERE id_kamar='$id'";

$query = mysqli_query($koneksidb, $sql);
if($query){
	echo "<script type='text/javascript'>
		alert('Data kamar berhasil diubah.'); 
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