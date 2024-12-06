<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include autoloader jika menggunakan Composer
require 'vendor/autoload.php';

// Buat instance PHPMailer
$mail = new PHPMailer(true);

try {
    // Konfigurasi SMTP
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io'; // Mailtrap SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = '7f1c6c9a78880c'; // Ganti dengan Username Mailtrap Anda
    $mail->Password = 'f23d3b7a0568b5'; // Ganti dengan Password Mailtrap Anda
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enkripsi STARTTLS
    $mail->Port = 2525; // Port Mailtrap
    
    // Pengaturan email pengirim dan penerima
    $mail->setFrom('noreply@example.com', 'Gym Subscription'); // Email pengirim
    $mail->addAddress('user@example.com', 'Nama Penerima');   // Email penerima
    
    // Konten email
    $mail->isHTML(true); // Menggunakan format HTML
    $mail->Subject = 'Konfirmasi Langganan Gym';
    $mail->Body = '<h1>Terima kasih telah berlangganan!</h1><p>Detail langganan Anda: ...</p>';
    $mail->AltBody = 'Terima kasih telah berlangganan! Detail langganan Anda: ...';

    // Kirim email
    $mail->send();
    echo 'Email berhasil dikirim!';
} catch (Exception $e) {
    echo "Email gagal dikirim. Error: {$mail->ErrorInfo}";
}
?>