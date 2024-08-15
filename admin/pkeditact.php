<?php
include('includes/config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

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
    // Kirim email notifikasi ke pemilik kost menggunakan PHPMailer
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nartylaptop17@gmail.com'; // Ganti dengan email Anda
        $mail->Password = 'ntobkniigiqnpznx'; // Ganti dengan password email Anda
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Menggunakan SMTPS sesuai dengan pengaturan SSL
        $mail->Port = 465; // Port yang sesuai dengan pengaturan SSL

        //Recipients
        $mail->setFrom('no-reply@yourdomain.com', 'Narty Boarding House');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Perubahan Status Pemilik Kost';
        $mail->Body = "<b>Admin telah merubah status anda menjadi $statuspk.</b>";

        $mail->send();
    } catch (Exception $e) {
        echo "Pesan tidak dapat dikirim. Mailer Error: {$mail->ErrorInfo}";
    }

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