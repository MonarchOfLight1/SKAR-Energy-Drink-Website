    <?php
    header('Content-Type: application/json');
    require_once '../includes/connfig.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405); 
        echo json_encode(['error' => 'Only POST requests allowed']);
        exit;
    }

    $input = json_decode(file_get_contents('php://input'), true);

    $username = $input['username'] ?? '';
    $email = $input['email'] ?? '';
    $password = $input['password'] ?? '';

    if (!$username || !$email || !$password) {
        http_response_code(400);
        echo json_encode(['error' => 'Username, email and password are required']);
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    $hashedPassword = mysqli_real_escape_string($conn, $hashedPassword);

    // Check if email already exists
    $check = mysqli_query($conn, "SELECT * FROM skaracc WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        http_response_code(409); 
        echo json_encode(['error' => 'Email already registered']);
        exit;
    }

    // Insert into DB Preventing SQL INjection
    $stmt = mysqli_prepare($conn, "INSERT INTO skaracc (username, email, password) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);

    if (mysqli_stmt_execute($stmt)) 
    {
        http_response_code(201);
        echo json_encode(['message' => 'Account created successfully']);
        exit;
    } 
    else 
    {
        http_response_code(500);
        echo json_encode(['error' => 'Server error']);
        exit;
    }


