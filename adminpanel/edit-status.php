<?php
session_start();
require "session.php";
require "../koneksi.php";

$id = $_GET['p']; // Ambil ID dari parameter GET

// Query untuk mendapatkan detail order berdasarkan ID
$query = mysqli_query($con, "SELECT * FROM `order` WHERE id='$id'");
$data = mysqli_fetch_array($query);

// Jika form disubmit untuk memperbarui status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_status'])) {
        $payment_status = htmlspecialchars($_POST['payment_status']);
        $shipment_status = htmlspecialchars($_POST['shipment_status']);

        // Query untuk memperbarui status
        $queryUpdate = mysqli_query($con, "UPDATE `order` SET payment_status='$payment_status', shipment_status='$shipment_status' WHERE id='$id'");

        if ($queryUpdate) {
            $_SESSION['status_message'] = 'Status berhasil diperbarui!';
            header('Location: laporan_penjualan.php');
            exit();
        } else {
            $_SESSION['status_message'] = 'Error: ' . mysqli_error($con);
        }
    }

    // Jika form disubmit untuk menghapus order
    if (isset($_POST['delete_order'])) {
        $queryDelete = mysqli_query($con, "DELETE FROM `order` WHERE id='$id'");

        if ($queryDelete) {
            $_SESSION['status_message'] = 'Order berhasil dihapus!';
            header('Location: laporan_penjualan.php');
            exit();
        } else {
            $_SESSION['status_message'] = 'Error: ' . mysqli_error($con);
        }
    }
}

// Ambil pesan status dari sesi
$status_message = isset($_SESSION['status_message']) ? $_SESSION['status_message'] : '';
unset($_SESSION['status_message']); // Hapus pesan setelah dibaca
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Status Order</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <?php if ($status_message): ?>
        <div class="alert alert-info">
            <?php echo htmlspecialchars($status_message); ?>
        </div>
        <?php endif; ?>

        <h2>Edit Status Order</h2>
        
        <form action="edit-status.php?p=<?php echo $id; ?>" method="post">
            <div class="mb-3">
                <label for="payment_status" class="form-label">Payment Status</label>
                <select name="payment_status" id="payment_status" class="form-control" required>
                    <option value="Belum Terkonfirmasi" <?php echo $data['payment_status'] == 'Belum Terkonfirmasi' ? 'selected' : ''; ?>>Belum Terkonfirmasi</option>
                    <option value="Terkonfirmasi" <?php echo $data['payment_status'] == 'Terkonfirmasi' ? 'selected' : ''; ?>>Terkonfirmasi</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="shipment_status" class="form-label">Shipment Status</label>
                <select name="shipment_status" id="shipment_status" class="form-control" required>
                    <option value="Belum Dikirim" <?php echo $data['shipment_status'] == 'Belum Dikirim' ? 'selected' : ''; ?>>Belum Dikirim</option>
                    <option value="Sudah Dikirim" <?php echo $data['shipment_status'] == 'Sudah Dikirim' ? 'selected' : ''; ?>>Sudah Dikirim</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" name="update_status" class="btn btn-primary">Update Status</button>
                <button type="submit" name="delete_order" class="btn btn-danger">Delete Order</button>
            </div>
        </form>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
