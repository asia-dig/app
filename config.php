<?php
$host = "localhost";  // Ganti jika menggunakan hosting
$user = "root";       // Username database
$pass = "";           // Password database (kosong jika pakai XAMPP)
$dbname = "kontak_db";

$conn = new mysqli($host, $user, $pass, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>