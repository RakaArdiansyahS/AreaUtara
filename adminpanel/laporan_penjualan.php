<?php
session_start(); // Mulai sesi
require "../koneksi.php";

// Cek apakah form update status telah dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['shipment_status'])) {
    $order_ids = $_POST['order_id'];
    $shipment_statuses = $_POST['shipment_status'];

    // Periksa jumlah ID dan status pengiriman
    if (count($order_ids) == count($shipment_statuses)) {
        foreach ($order_ids as $index => $order_id) {
            $shipment_status = $shipment_statuses[$index];

            // Query untuk mengupdate status pengiriman
            $query = "UPDATE `order` SET `shipment_status` = ? WHERE `id` = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 'si', $shipment_status, $order_id);

            if (!mysqli_stmt_execute($stmt)) {
                $_SESSION['status_message'] = 'Error: ' . mysqli_error($con);
                header('Location: laporan-penjualan.php');
                exit();
            }
        }

        // Set pesan status dan redirect
        $_SESSION['status_message'] = 'Status pengiriman berhasil diperbarui!';
        header('Location: laporan-penjualan.php');
        exit();
    } else {
        die('Data tidak valid.');
    }
}

// Ambil pesan status dari sesi
$status_message = isset($_SESSION['status_message']) ? $_SESSION['status_message'] : '';
unset($_SESSION['status_message']); // Hapus pesan setelah dibaca

// Query untuk mengambil data dari tabel order
$query = "SELECT id, email, name, address, postcode, delivery_method, total, products FROM `order`";
$result = mysqli_query($con, $query);

if (!$result) {
    die('Query Error: ' . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> <!-- Path disesuaikan -->
    <link rel="stylesheet" href="../fontawesome/css/all.min.css"> <!-- Path disesuaikan -->
    <style>
        .table-container {
            margin-top: 20px;
        }
        .status-message {
            margin-bottom: 20px;
        }
        .print-button {
            margin-bottom: 20px;
        }
        .product-details {
            font-size: 0.9rem;
            margin-top: 10px;
        }
        @media print {
            @page {
                size: landscape;
                margin: 10mm; /* Sesuaikan margin sesuai kebutuhan */
            }
            
            body {
                width: 100%;
                margin: 0;
            }
            
            .container {
                width: 100%;
            }

            .table-container {
                margin-top: 0;
            }

            .print-button {
                display: none; /* Hapus tombol cetak dari tampilan saat mencetak */
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php require "navbar.php"; ?>

    <!-- Konten Utama -->
    <div class="container table-container">
        <?php if ($status_message): ?>
        <div class="alert alert-info status-message">
            <?php echo htmlspecialchars($status_message); ?>
        </div>
        <?php endif; ?>

        <h2 class="mb-4">Laporan Penjualan</h2>
        
        <!-- Tombol Cetak -->
        <div class="print-button text-center mb-4">
            <button onclick="printReport()" class="btn btn-primary">Cetak Laporan</button>
        </div>

        <form action="laporan-penjualan.php" method="POST">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Kode Pos</th>
                        <th>Metode Pengiriman</th>
                        <th>Total</th>
                        <th>Nama Produk</th>
                        <th>Jumlah Produk</th>
                        <th>Harga Produk</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['postcode']); ?></td>
                        <td><?php echo htmlspecialchars($row['delivery_method']); ?></td>
                        <td><?php echo htmlspecialchars($row['total']); ?></td>
                        <?php
                        // Parse JSON data untuk produk
                        $products = json_decode($row['products'], true);
                        if ($products && is_array($products)):
                        ?>
                        <td>
                            <?php foreach ($products as $product): ?>
                                <div class="product-details">
                                    <?php echo htmlspecialchars($product['nama']); ?>
                                </div>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <?php foreach ($products as $product): ?>
                                <div class="product-details">
                                    <?php echo htmlspecialchars($product['quantity']); ?>
                                </div>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <?php foreach ($products as $product): ?>
                                <div class="product-details">
                                    Rp <?php echo number_format(htmlspecialchars($product['harga']), 2, ',', '.'); ?>
                                </div>
                            <?php endforeach; ?>
                        </td>
                        <?php else: ?>
                        <td colspan="3">Tidak ada data produk tersedia.</td>
                        <?php endif; ?>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </form>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script> <!-- Path disesuaikan -->
    <script>
        function printReport() {
            window.print();
        }
    </script>
</body>
</html>

<?php
// Tutup koneksi
mysqli_close($con);
?>
