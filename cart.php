<?php
session_start(); // Start the session

require "koneksi.php";

$cartItems = array();
$totalPrice = 0;

// Check if the cart is set
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        $query = mysqli_query($con, "SELECT * FROM produk WHERE id='$productId'");
        $products = mysqli_fetch_array($query);
        if ($products) {
            $products['quantity'] = $quantity;
            $cartItems[] = $products;
            $totalPrice += $products['harga'] * $quantity;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container py-5" style="min-height: 80vh; display: flex; flex-direction: column; justify-content: center;">
        <h2 class="mb-4">Shopping Cart</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($cartItems as $item) {
                    $subtotal = $item['harga'] * $item['quantity'];
                    $total += $subtotal;
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['nama']); ?></td>
                        <td>Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="3" class="text-right"><strong>Total</strong></td>
                    <td><strong>Rp <?php echo number_format($total, 0, ',', '.'); ?></strong></td>
                </tr>
            </tbody>
        </table>
        <a href="checkout.php" class="btn btn-dark">Checkout</a>
    </div>
    <?php require "footer.php"; ?>    
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php mysqli_close($con); ?>
