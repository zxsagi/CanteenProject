<?php
// Periksa apakah data dikirimkan melalui POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $name = isset($_POST['Name']) ? $_POST['Name'] : '';
    $people = isset($_POST['People']) ? $_POST['People'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $message = isset($_POST['Message']) ? $_POST['Message'] : '';
    
    // Format data untuk disimpan
    $data = "Name=$name&People=$people&date=$date&Message=$message\n";
    
    // Tentukan nama file tempat menyimpan data
    $file = 'data.txt';
    
    // Tulis data ke dalam file
    if (file_put_contents($file, $data, FILE_APPEND)) {
        // Tampilkan pesan konfirmasi jika data berhasil disimpan
        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>Terima Kasih</title>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
            <style>
                body {font-family: 'Times New Roman', Georgia, Serif;}
                h1, h2, h3, h4, h5, h6 { font-family: 'Playfair Display'; letter-spacing: 5px; }
            </style>
        </head>
        <body>
            <div class='w3-content' style='max-width:1100px; margin-top:50px'>
                <h1 class='w3-center'>Terima Kasih sudah mengirimi pesan pada kami</h1>
                <p class='w3-center'>Data yang Anda kirimkan telah berhasil disimpan.</p>
                <p><b>Nama:</b> " . htmlspecialchars($name) . "</p>
                <p><b>Jumlah Orang:</b> " . htmlspecialchars($people) . "</p>
                <p><b>Tanggal dan Waktu:</b> " . htmlspecialchars($date) . "</p>
                <p><b>Pesan:</b> " . htmlspecialchars($message) . "</p>
            </div>
        </body>
        </html>";
    } else {
        // Tampilkan pesan error jika gagal menyimpan data
        echo "<h1>Gagal menyimpan data.</h1>";
    }
} else {
    echo "<h1>Tidak ada data yang dikirimkan.</h1>";
}
?>
