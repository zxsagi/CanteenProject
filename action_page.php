<?php
// Load kelas PHPMailer
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Periksa apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['Name']);
    $people = htmlspecialchars($_POST['People']);
    $date = htmlspecialchars($_POST['date']);
    $message = htmlspecialchars($_POST['Message']);

    // Buat instance PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Pengaturan server
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Atur server SMTP untuk digunakan
        $mail->SMTPAuth   = true; // Aktifkan otentikasi SMTP
        $mail->Username   = 'chensagi008@gmail.com'; // Alamat Gmail Anda
        $mail->Password   = 'kgiccusngjbyxlwr'; // Password Gmail Anda (atau App Password jika 2FA diaktifkan)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Aktifkan enkripsi TLS
        $mail->Port       = 587; // Port TCP untuk koneksi

        // Penerima
        $mail->setFrom('chensagi008@gmail.com', 'Sagi Canteen');
        $mail->addAddress('2382016@unai.edu'); // Tambahkan alamat penerima

        // Konten
        $mail->isHTML(true); // Atur format email ke HTML
        $mail->Subject = 'Pesanan Baru dari ' . $name;
        $mail->Body    = "<h1>Detail Pesanan Baru</h1>
                          <p>Nama Pemesan: $name</p>
                          <p>Jumlah Orang: $people</p>
                          <p>Buat Tanggal: $date</p>
                          <p>Catatan Pesanan: $message</p>";
        $mail->AltBody = "Detail Pesanan Baru\nNama: $name\nJumlah Orang: $people\nTanggal: $date\nPesan: $message";

        $mail->send();
        echo "<h2>Thank you, $name!</h2>";
        echo "<p>Your reservation for $people people on $date has been received.</p>";
        echo "<p>Message: $message</p>";
        echo "<a href='index.html'>Back to Home</a>";
    } catch (Exception $e) {
        echo "Pesan tidak dapat dikirim. Kesalahan Mailer: {$mail->ErrorInfo}";
    }
}
?>