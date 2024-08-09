<?php
session_start();

// Hapus semua data sesi
session_unset();

// Hapus sesi
session_destroy();

// Arahkan pengguna ke halaman login atau halaman utama
header("Location: login.php");
exit;
?>
