

<?php
//This endpoint updates the icon on our cart header
header('Content-Type: application/json');
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../includes/connfig.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error'=>'unauthorized']);
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = mysqli_prepare($conn, "SELECT SUM(quantity) as total FROM user_cart WHERE user_id=?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

$totalItems = $row['total'] ?? 0;

echo json_encode(['count' => (int)$totalItems]);
exit;
