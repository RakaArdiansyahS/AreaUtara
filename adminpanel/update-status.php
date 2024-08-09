<?php
session_start(); // Mulai sesi

require "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $payment_status = $_POST['payment_status'];

    // Query untuk mengupdate status pembayaran
    $query = "UPDATE `order` SET `payment_status` = ? WHERE `id` = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'si', $payment_status, $order_id);
    
    if (mysqli_stmt_execute($stmt)) {
        // Set pesan sukses ke dalam sesi
        $_SESSION['status_message'] = "Status pembayaran berhasil diubah.";
    } else {
        // Set pesan error ke dalam sesi
        $_SESSION['status_message'] = "Gagal mengubah status pembayaran.";
    }
    
    // Tutup koneksi
    mysqli_close($con);
    
    // Redirect kembali ke halaman laporan penjualan
    header('Location: laporan-penjualan.php');
    exit();
} else {
    // Redirect ke halaman laporan penjualan jika tidak ada permintaan POST
    header('Location: laporan-penjualan.php');
    exit();
}
