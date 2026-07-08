<?php
header('Content-Type: application/json');
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../includes/connfig.php';

// Only allow GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Only GET requests allowed']);
    exit;
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch cart items
$stmt = mysqli_prepare($conn, "SELECT p.product_id, p.product_name, p.product_price, uc.quantity FROM user_cart uc JOIN product p ON uc.product_id = p.product_id WHERE uc.user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$cart = [];
$total = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $cart[] = $row;
    $total += $row['product_price'] * $row['quantity'];
}

echo json_encode([
    'cart' => $cart,
    'total' => $total
]);