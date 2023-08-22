
Tahapannya:
1. buka terminal / cmd
composer require phpmailer/phpmailer
2. Setting email, password, port di akun cpanel fitur email.
3. Membuat Form Kirim email
 <form name="sendmail" method="POST" enctype="multipart/form-data">
        <label for="tujuan">Tujuan Email:</label>
        <input type="email" id="tujuan" name="tujuan" required><br><br><label for="subjek">Subjek:</label>
        <input type="text" id="subjek" name="subjek" required><br><br>        
        <label for="pesan">Pesan:</label><br>
        <textarea id="pesan" name="pesan" rows="4" cols="50" required></textarea><br><br>
               <input type="submit" name="sendmail" value="Kirim Email">
    </form>

4. Menggunakan PHPMailer
Berikut adalah contoh penggunaan PHPMailer untuk mengirim email notifikasi
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
     
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Hapus ini saat sudah selesai
    $mail->isSMTP();
    $mail->Host = $hostmail; // Ganti dengan server SMTP yang sesuai
    $mail->SMTPAuth = true;
    $mail->Username = $emailsender;  // Ganti dengan alamat email pengirim
    $mail->Password = $passwordemail;   // Ganti dengan password email pengirim
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
