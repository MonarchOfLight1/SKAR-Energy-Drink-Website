<?php
header('Content-Type: application/json');
require_once '../includes/connfig.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    // RESTFUL post method for products.
    $input = json_decode(file_get_contents('php://input'), true);

    $name = trim($input['product_name'] ?? '');
    $price = $input['product_price'] ?? null;
    $quantity = $input['product_quantity'] ?? 0;
    $description = trim($input['description'] ?? '');

    if (!$name || $price === null || !is_numeric($price)) {
        http_response_code(400);
        echo json_encode(['error' => 'Product name and valid price are required']);
        exit;
    }

   
    $name = mysqli_real_escape_string($conn, $name);
    $description = mysqli_real_escape_string($conn, $description);

    $price = number_format((float)$price, 2, '.', ''); // ensure DECIMAL format
    $quantity = (int)$quantity;

    $sql = "INSERT INTO product (product_name, product_price, product_quantity, description) 
            VALUES ('$name', $price, $quantity, '$description')";

    if (mysqli_query($conn, $sql)) {
        http_response_code(201);
        echo json_encode(['message' => 'Product added successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . mysqli_error($conn)]);
    }

} elseif ($method === 'GET') {
    $result = mysqli_query($conn, "SELECT * FROM product");

    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    http_response_code(200);
    echo json_encode($products);

} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
?>