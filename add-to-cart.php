<?php
session_start(); // Start the session

require "koneksi.php";

// Ambil data dari form
$id_produk = mysqli_real_escape_string($con, $_POST['id_produk']);
$nama_produk = mysqli_real_escape_string($con, $_POST['nama_produk']);
$harga_produk = mysqli_real_escape_string($con, $_POST['harga_produk']);
$action = $_POST['action'];

if ($action == 'beli') {
    // Simpan ke tabel pembelian
    $query = "INSERT INTO pembelian (id_produk, nama_produk, harga_produk, jumlah) VALUES ('$id_produk', '$nama_produk', '$harga_produk', 1)";
    mysqli_query($con, $query);
    header("Location: success.php"); // Halaman sukses
} elseif ($action == 'keranjang') {
    // Inisialisasi keranjang jika belum ada
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Update keranjang
    if (isset($_SESSION['cart'][$id_produk])) {
        $_SESSION['cart'][$id_produk]++;
    } else {
        $_SESSION['cart'][$id_produk] = 1;
    }

    header("Location: cart.php"); // Halaman keranjang
} else {
    echo "Aksi tidak dikenal.";
}

mysqli_close($con);
?>