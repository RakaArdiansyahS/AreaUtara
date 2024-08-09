<?php
session_start(); // Start the session

require "koneksi.php";

$cartItems = array();
$totalPrice = 0;

// Check if the cart is set
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        $query = mysqli_query($con, "SELECT * FROM produk WHERE id='$productId'");
        $product = mysqli_fetch_array($query);
        if ($product) {
            $product['quantity'] = $quantity;
            $cartItems[] = $product;
            $totalPrice += $product['harga'] * $quantity;
        }
    }
} else {
    header("Location: produk.php"); // Redirect ke halaman utama setelah login    
}

// Encode cart items to JSON for use in JavaScript
$cartItemsJson = json_encode($cartItems);
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
    .custom-radio {
        display: flex;
        align-items: center;
    }

    .custom-radio+.custom-radio {
        margin-top: 10px;
    }

    .delivery-icon {
        margin-left: auto;
        margin-right: 15px;
    }

    .additional-info {
        margin-top: 15px;
    }

    .divider {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 1px;
        background-color: grey;
        right: -0.5px;
    }
    </style>
</head>

<body>
    <?php require "navbar.php"; ?>

    <div class="container" style="min-height: 80vh; display: flex; flex-direction: column; justify-content: center;">
        <div class="row align-items-center">
            <div class="col position-relative">
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">
                        <h4>Contact</h4>
                    </label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <label for="delivery" class="form-label">
                    <h4>Delivery</h4>
                </label>
                <div class="mb-3 form-check">
                    <div class="custom-radio">
                        <input type="radio" class="form-check-input" id="ship" name="optradio" value="ship" checked
                            onclick="toggleDeliveryOptions()">
                        <label class="form-check-label ml-2" for="ship">Ship</label>
                        <i class="fa fa-truck delivery-icon" aria-hidden="true"></i>
                    </div>
                    <div class="custom-radio">
                        <input type="radio" class="form-check-input" id="pickup" name="optradio" value="pickup"
                            onclick="toggleDeliveryOptions()">
                        <label class="form-check-label ml-2" for="pickup">Pick up in store</label>
                        <i class="fa fa-store delivery-icon" aria-hidden="true"></i>
                    </div>
                </div>
                <div id="shipping-info" class="additional-info">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Enter address" name="address">
                    </div>
                    <div class="mb-3">
                        <label for="postCode" class="form-label">Postcode</label>
                        <input type="text" class="form-control" id="postCode" placeholder="Enter Post Code"
                            name="postCode">
                    </div>
                </div>
                <div id="pickup-info" class="additional-info" style="display: none;">
                    <h4>Store Location</h4>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15844.462500490798!2d107.6096949!3d-6.876748049999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6ee129c896d%3A0xb01ca182dac12846!2sUniversitas%20Katolik%20Parahyangan!5e0!3m2!1sen!2sid!4v1722707289287!5m2!1sen!2sid"
                        width="500" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="divider"></div>
            </div>
            <div class="col">
                <?php foreach ($cartItems as $item) { ?>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <img src="image/<?php echo htmlspecialchars($item['foto']); ?>" class="img-fluid rounded"
                            alt="<?php echo htmlspecialchars($produk['nama']); ?>">
                    </div>
                    <div class="col-md-10">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="font-weight-bold"><?php echo htmlspecialchars($item['nama']); ?></div>
                                <div>Quantity: <?php echo htmlspecialchars($item['quantity']); ?></div>
                            </div>
                            <div>
                                <div>Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        Delivery Fee
                    </div>
                    <div class="col-md text-right" id="delivery-fee-ship">
                        Rp 15.000
                    </div>
                    <div class="col-md text-right" id="delivery-fee-cod" style="display:none">
                        FREE
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        Subtotal
                    </div>
                    <div class="col-md text-right">
                        Rp <?php echo number_format($totalPrice, 0, ',', '.'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h4>Total</h4>
                    </div>
                    <div class="col-md text-right" id="total-price-final">
                        Rp <?php echo number_format($totalPrice, 0, ',', '.'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col text-center">
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-dark" data-toggle="modal"
                                    data-target="#openConfirmationModal">
                                    Continue to Pay
                                </button>
                            </div>

                            <!-- The Modal -->
                            <div class="modal fade" id="openConfirmationModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmationModalLabel">Confirmation Required
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <p>To complete your payment, please confirm with the admin via WhatsApp.</p>
                                            <a href="https://wa.me/081212311231?text=I%20would%20like%20to%20confirm%20my%20payment%20request."
                                                class="btn btn-dark" target="_blank" onclick="submitOrder()">Confirm via
                                                WhatsApp</a>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php require "footer.php"; ?>
    <script>
    // Pass PHP data to JavaScript
    const cartItems = <?php echo $cartItemsJson; ?>;
    var totalPrice = <?php echo $totalPrice ?>;

    function toggleDeliveryOptions() {
        const shipRadio = document.getElementById('ship');
        const pickupRadio = document.getElementById('pickup');
        const shippingInfo = document.getElementById('shipping-info');
        const pickupInfo = document.getElementById('pickup-info');
        const deliveryFeeShip = document.getElementById('delivery-fee-ship');
        const deliveryFeeCOD = document.getElementById('delivery-fee-cod');
        const totalPriceFinal = document.getElementById('total-price-final');
        var deliveryFee = 15000

        if (shipRadio.checked) {
            shippingInfo.style.display = 'block';
            pickupInfo.style.display = 'none';
            deliveryFeeShip.style.display = 'block';
            deliveryFeeCOD.style.display = 'none';
            deliveryFee=15000
        } else if (pickupRadio.checked) {
            shippingInfo.style.display = 'none';
            pickupInfo.style.display = 'block';
            deliveryFeeShip.style.display = 'none';
            deliveryFeeCOD.style.display = 'block';
            deliveryFee=0
        }

        totalPriceFinal.innerHTML = formatCurrency(totalPrice+deliveryFee).replace(/\s/g, '')
    }

    function submitOrder() {
        email = document.getElementById('email').value;
        name = document.getElementById('name').value;
        address = document.getElementById('address').value;
        postCode = document.getElementById('postCode').value;
        const selectedDelivery = document.querySelector('input[name="optradio"]:checked').value;
        const receiptId = generateReceiptId(10);
        deliveryFee = 0;
        subTotal = totalPrice;

        if (!validateEmail(email)) {
            Swal.fire({
                icon: "info",
                title: "Oops...",
                text: "Email is required and must be valid",
                confirmButtonColor: "grey"
            });
            return;
        }

        if (selectedDelivery === "ship") {
            deliveryFee = 15000;
            totalPrice = deliveryFee + subTotal;

            if (name.trim() === "" || address.trim() === "" || postCode.trim() === "") {
                Swal.fire({
                    icon: "info",
                    title: "Oops...",
                    text: "Name, address, and postCode are required",
                    confirmButtonColor: "grey"
                });
                return;
            }
        }

        // Define the data to be sent to the server
        const data = {
            action: 'beli',
            name: name.trim() === '' ? null : name,
            postCode: postCode.trim() === '' ? null : postCode,
            address: address.trim() === '' ? null : address,
            email: email,
            receiptId: receiptId,
            products: cartItems,
            deliveryFee: deliveryFee,
            deliveryMethod: selectedDelivery,
            subTotal: subTotal,
            total: totalPrice,
            createdAt: now()
        };

        console.log(data);
        // Send the POST request to proses-pembelian.php
        fetch('proses-pembelian.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok " + response.statusText);
                }
                return response.text(); // Get the raw response text
            })
            .then(text => {
                if (!text) {
                    throw new Error("Empty response from server");
                }
                try {
                    return JSON.parse(text); // Try to parse the response text as JSON
                } catch (error) {
                    throw new Error("Failed to parse JSON: " + error.message);
                }
            })
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
                }
                Swal.fire({
                    icon: "success",
                    title: "Order Has been successfully created",
                    confirmButtonColor: "grey"
                }).then(() => {
                    window.location.href = `order-detail.php?receipt_id=${receiptId}`;
                });
            })
            .catch((error) => {
                Swal.fire({
                    icon: "error",
                    title: "Something went wrong!!!",
                    text: error.message,
                    confirmButtonColor: "grey"
                });
                console.error('Error:', error);
            });
    }

    // Initialize on page load
    window.onload = toggleDeliveryOptions;
    </script>
</body>

</html>


<?php mysqli_close($con); ?>