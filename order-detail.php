<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "koneksi.php";

if (isset($_GET['receipt_id'])) {
    $receipt_id = $_GET['receipt_id'];

    $query = mysqli_query($con, "SELECT * FROM `order` where receipt_id = '$receipt_id'");
    $order = mysqli_fetch_array($query);
} else {
    header("Location: index.php"); // Halaman Index
    // Handle the case where receipt_id is not present
}

$orderProducts = json_decode($order["products"], true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
            .border-right {
        border-right: 1px solid #ddd;
    }
    </style>
</head>

<body>
    <?php require "navbar.php"; ?>

    <div class="container" style="min-height: 80vh; display: flex; flex-direction: column; justify-content: center;">
        <span class="mt-2"><h4>Thank you, your order has been received</h4></span>
        <br>
        <div class="row" style="border-bottom:1px solid #ddd">
            <div class="col-md" style="border-right:1px solid #ddd"><span>Nomor Pesanan</span>
                <p class="font-weight-bold"><?php echo htmlspecialchars($order['receipt_id']); ?> </p>
            </div>
            <div class="col-md" style="border-right:1px solid #ddd"><span>Tanggal</span>
                <p class="font-weight-bold"><?php echo gmdate("Y-m-d\ H:i:s", $order['created_at']);  ?></p>
            </div>
            <div class="col-md" style="border-right:1px solid #ddd"><span>Email</span>
                <p class="font-weight-bold">areautara@gmail.com</p>
            </div>
            <div class="col-md" style="border-right:1px solid #ddd"><span>Total</span>
                <p class="font-weight-bold">Rp. <?php echo number_format($order["total"], 0, ',', '.'); ?></p>
            </div>
            <div class="col-md"><span>Payment Method</span>
                <p class="font-weight-bold">Transfer Bank</p>
            </div>
        </div>
        <br>
        <div class="row" style="border-bottom:1px solid #ddd">
            <div class="col">
                <h4>Bank Details</h4>
                <p>Bank Central Asia (BCA) <br> <span class="font-weight-bold">123123123</span></p>
            </div>
            <div class="col">
                <p class="font-italic">Make a payment immediately to the BCA account that we listed. 
                    Please transfer according to the nominal to the end of the digit so that your order is processed automatically. 
                    Your order will not be shipped until we have received the funds. 
                    If within 1×24 hours you don’t make a transaction, the order will be automatically canceled by the system.</p>
            </div>
        </div>
        <br>
        <h4>Order Details</h4>
        <div class="row">
            <?php foreach ($orderProducts as $orderProduct) { ?>
            <div class="row mb-3">
                <div class="col-md-2">
                    <img src="image/<?php echo htmlspecialchars($orderProduct['foto']); ?>" class="img-fluid rounded"
                        alt="<?php echo htmlspecialchars($orderProduct['nama']); ?>">
                </div>
                <div class="col-md-10">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="font-weight-bold"><?php echo htmlspecialchars($orderProduct['nama']); ?></div>
                            <div>Quantity: <?php echo htmlspecialchars($orderProduct['quantity']); ?></div>
                        </div>
                        <div>
                            <div>Rp <?php echo number_format($orderProduct['harga'], 0, ',', '.'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php require "footer.php"; ?>
    <script>
    </script>
</body>

</html>


<?php mysqli_close($con); ?>