<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Start the session

require "koneksi.php";

// Ensure proper content type for JSON
header('Content-Type: application/json');

// Get the raw POST data
$data = json_decode(file_get_contents('php://input'), true);

// Check if data is received and action is set
if (!$data || !isset($data['action'])) {
    echo json_encode(["error" => "Invalid input or action not set"]);
    exit;
}

 // Check if database connection is successful
 if ($con->connect_error) {
    echo json_encode(["error" => "Database connection failed: " . $con->connect_error]);
    exit;
}

// Prepare and bind
$stmt = $con->prepare("INSERT INTO `order` (receipt_id, email, name, address, postcode, delivery_method, delivery_fee, sub_total, total, products, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    echo json_encode(["error" => "Prepare failed: " . $con->error]);
    exit;
}
$stmt->bind_param(
    "ssssssdddsd",
    $receipt_id,
    $email,
    $name,
    $address,
    $postCode,
    $delivery_method,
    $delivery_fee,
    $sub_total,
    $total,
    $products,
    $created_at
);

// Set parameters and execute
$receipt_id = $data['receiptId'];
$email = $data['email'];
$name = $data['name'];
$address = $data['address'];
$postCode = $data['postCode'];
$delivery_method = $data['deliveryMethod'];
$delivery_fee = $data['deliveryFee'];
$sub_total = $data['subTotal'];
$total = $data['total'];
$products = json_encode($data['products']); // Convert products array to JSON
$created_at = $data['createdAt'];

if ($stmt->execute()) {
    echo json_encode(["success" => "Order has been successfully created"]);
} else {
    echo json_encode(["error" => "Execute failed: " . $stmt->error]);
}

// Close the statement
$stmt->close();
$con->close(); 
unset($_SESSION['cart']);
?>
