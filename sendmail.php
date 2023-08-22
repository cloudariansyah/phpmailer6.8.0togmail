<?php
require 'config/access.php'; 
    // Mengimpor PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if (isset($_POST['sendmail'])) {


require 'vendor/autoload.php'; // Sesuaikan dengan path di proyek Anda
    
     $email = mysqli_real_escape_string($koneksi,$_POST["tujuan"]);
// Inisialisasi objek PHPMailer
$mail = new PHPMailer(true);

try {
     
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Hapus ini saat sudah selesai
    $mail->isSMTP();
    $mail->Host = $hostmail; 
    $mail->SMTPAuth = true;
    $mail->Username = $emailsender;  
    $mail->Password = $passwordemail;   
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587; 

    // Konfigurasi email
    $mail->setFrom($emailsender, 'Ariansyah Center'); // Alamat email pengirim
    $mail->addAddress($email, 'Nama Penerima'); // Alamat email penerima
    $mail->Subject = mysqli_real_escape_string($koneksi,$_POST["subjek"]);
    $mail->Body = mysqli_real_escape_string($koneksi,$_POST["pesan"]);

    // Kirim email
    $mail->send();
    echo 'Email notifikasi berhasil dikirim';
} catch (Exception $e) {
    echo 'Gagal mengirim email notifikasi: ', $mail->ErrorInfo;
}
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kirim Email</title>
</head>
<body>
    <h2>Kirim Email</h2>
    <form name="sendmail" method="POST" enctype="multipart/form-data">
        <label for="tujuan">Tujuan Email:</label>
        <input type="email" id="tujuan" name="tujuan" required><br><br>
        
        <label for="subjek">Subjek:</label>
        <input type="text" id="subjek" name="subjek" required><br><br>
        
        <label for="pesan">Pesan:</label><br>
        <textarea id="pesan" name="pesan" rows="4" cols="50" required></textarea><br><br>
        
        <input type="submit" name="sendmail" value="Kirim Email">
    </form>
</body>
</html>
