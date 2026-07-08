<?php
header('Content-Type: application/json');
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../includes/connfig.php';

$response = []; 

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    $response['error'] = 'Only POST requests allowed';
    echo json_encode($response);
    exit;
}

// Check authentication
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    $response['error'] = 'Unauthorized';
    echo json_encode($response);
    exit;
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);
$product_id = $input['product_id'] ?? 0;
$quantity = $input['quantity'] ?? 1;

if (!$product_id || $quantity < 1) {
    http_response_code(400);
    $response['error'] = 'Invalid product or quantity';
    echo json_encode($response);
    exit;
}

// Check if product exists
$stmt = mysqli_prepare($conn, "SELECT * FROM product WHERE product_id=?");
mysqli_stmt_bind_param($stmt, "i", $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result || mysqli_num_rows($result) == 0) {
    http_response_code(404);
    $response['error'] = 'Product not found';
    echo json_encode($response);
    exit;
}

// Add to cart or update quantity)
$stmt = mysqli_prepare($conn, "INSERT INTO user_cart (user_id, product_id, quantity) VALUES (?, ?, ?) 
    ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)");
mysqli_stmt_bind_param($stmt, "iii", $_SESSION['user_id'], $product_id, $quantity);

if (mysqli_stmt_execute($stmt)) {
   
    http_response_code(200);
} else {
    $response['error'] = 'Server error';
    http_response_code(500);
}


echo json_encode($response);
exit;