<?php
header('Content-Type: application/json');
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../includes/connfig.php';

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Only POST requests allowed']);
    exit;
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$product_id = $input['product_id'] ?? 0;

if (!$product_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid product']);
    exit;
}

$user_id = $_SESSION['user_id'];

// Get current quantity
$stmt = mysqli_prepare($conn, "SELECT quantity FROM user_cart WHERE user_id=? AND product_id=?");
mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    http_response_code(404);
    echo json_encode(['error' => 'Item not found in cart']);
    exit;
}

$quantity = (int)$row['quantity'];

if ($quantity <= 1) {
    // Remove the item completely
    $stmt = mysqli_prepare($conn, "DELETE FROM user_cart WHERE user_id=? AND product_id=?");
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
} else {
    // Reduce quantity by 1
    $stmt = mysqli_prepare($conn, "UPDATE user_cart SET quantity = quantity - 1 WHERE user_id=? AND product_id=?");
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
}

if (mysqli_stmt_execute($stmt)) {
    http_response_code(200);
    echo json_encode(['message' => 'Item updated']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Server error']);
}