<?php
header('Content-Type: application/json');
session_start();

require_once '../includes/connfig.php';

//To Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Only POST requests are allowed']);
    exit;
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);
$email = $input['email'] ?? '';
$password = $input['password'] ?? '';

if (!$email || !$password) {
    echo json_encode(['error' => 'Email and password are required']);
    exit;
}

// to prevent SQL injection
$stmt = mysqli_prepare($conn, "SELECT skar_id, username, password FROM skaracc WHERE email=?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Check password
    if (password_verify($password, $row['password'])) {
        
        $_SESSION['user_id'] = $row['skar_id'];
        $_SESSION['username'] = $row['username'];

        echo json_encode([
            'message' => "You are logging in as \"{$row['username']}\"",
            'user_id' => $row['skar_id']
        ]);
        exit;
    } else {
        // Wrong password
        echo json_encode(['error' => 'Wrong Email or Password']);
        exit;
    }
} else {
    // Email not found
    echo json_encode(['error' => 'Wrong Email or Password']);
    exit;
}
?>