<?php
// koneksi.php
$host = "127.0.0.1"; // Ganti dengan host database kamu
$username = "root"; // Ganti dengan username database kamu
$password = ""; // Ganti dengan password database kamu
$database = "areautara"; // Ganti dengan nama database kamu

// Membuat koneksi
$con = mysqli_connect($host, $username, $password, $database);

// Memeriksa koneksi
if (!$con) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>