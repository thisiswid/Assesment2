<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-literasi";

// Menambahkan header CORS untuk mengizinkan akses lintas domain
header('Access-Control-Allow-Origin: *');

try {
    // Koneksi ke database dengan PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query untuk mendapatkan data dari tabel
    $query = "SELECT User_ID, Username, Nama, Email FROM Pengguna";  
    $stmt = $pdo->query($query);

    // Mengambil hasil sebagai array asosiatif
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Mengkonversi hasil ke JSON
    $json = json_encode($result, JSON_PRETTY_PRINT);

    // Menyimpan JSON ke dalam file 'output.json'
    $file_path = __DIR__ . '/output.json'; // Menentukan lokasi file
    file_put_contents($file_path, $json); // Menyimpan JSON ke file

    // Mengatur header respons JSON
    header('Content-Type: application/json'); 

    // Mengembalikan JSON sebagai output
    echo $json;

} catch (PDOException $e) {
    // Jika ada kesalahan, kirimkan pesan kesalahan dalam format JSON
    echo json_encode(["error" => $e->getMessage()]);
}
?>
