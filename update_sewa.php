<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/library.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$images=$_FILES["img1"]["name"];
$newimg1 = date('dmYHis').$images;
$kode = $_POST['kode'];
$stt = "Menunggu Konfirmasi";
move_uploaded_file($_FILES["img1"]["tmp_name"],"image/bukti/".$newimg1);
$sql="UPDATE booking SET bukti_bayar='$newimg1', status='$stt' WHERE kode_booking='$kode'";
$lastInsertId = mysqli_query($koneksidb, $sql);
if($lastInsertId){
    // Mengambil email pemilik kost
    $sql2 = "SELECT pemilik_kost.email, kamar_kost.nama_kamar FROM pemilik_kost JOIN kamar_kost ON pemilik_kost.id_pemilik = kamar_kost.id_pemilik JOIN booking ON kamar_kost.id_kamar = booking.id_kamar WHERE booking.kode_booking = '$kode'";
    $query2 = mysqli_query($koneksidb, $sql2);
    $result2 = mysqli_fetch_array($query2);
    $email_pemilik = $result2['email'];
    $nama_kamar = $_POST['kost'];
    $nama_penyewa = $_SESSION['fname'];
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $durasi = $_POST['durasi'];
    $email_penyewa = $_SESSION['ulogin'];
    $total_biaya = $_POST['total'];

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
        $mail->addAddress($email_pemilik); // Mengirim ke email pemilik kost

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Penyewaan Kamar Kost';
        $mail->Body = "Penyewa baru telah menyewa dan membayar kamar kost dengan detail berikut:<br><br>
											Nama Penyewa: $nama_penyewa<br>
											Email Penyewa: $email_penyewa<br>
											Nama Kamar: $nama_kamar<br>
											Tanggal Mulai: $fromdate<br>
											Tanggal Selesai: $todate<br>
											Durasi: $durasi<br>
											Total Biaya: $total_biaya<br><br>
											<b>Tolong Untuk Melakukan Konfirmasi Pembayaran.</b>";

        $mail->send();
    } catch (Exception $e) {
        echo " <script> alert ('Email tidak dapat dikirim. Mailer Error: {$mail->ErrorInfo}'); </script> ";
    }
    echo "<script>alert('Upload Bukti Pembayaran Berhasil!');</script>";
    echo "<script type='text/javascript'> document.location = 'riwayatsewa.php'; </script>";
}else {
    echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
    echo "<script type='text/javascript'> document.location = 'booking_edit.php?kode'".$kode."'; </script>";
}
?>