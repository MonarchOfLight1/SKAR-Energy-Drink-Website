<?php
header('Content-Type: application/json');
require_once '../includes/connfig.php';

$method = $_SERVER['REQUEST_METHOD'];


if ($method === 'POST') {

    $input = json_decode(file_get_contents('php://input'), true);

    $skar_id = $input['skar_id'] ?? null;
    $product_id = $input['product_id'] ?? null;
    $rating = $input['rating'] ?? null;
    $review_text = trim($input['review_text'] ?? '');

   
    if (!$skar_id || !$product_id || !$rating) {
        http_response_code(400);
        echo json_encode(['error' => 'User, product, and rating are required']);
        exit;
    }

    if ($rating < 1 || $rating > 5) {
        http_response_code(400);
        echo json_encode(['error' => 'Rating must be between 1 and 5']);
        exit;
    }

       $skar_id = (int)$skar_id;
    $product_id = (int)$product_id;
    $rating = (int)$rating;

    $review_text = mysqli_real_escape_string($conn, $review_text);


    $sql = "INSERT INTO review (skar_id, product_id, rating, review_text)
            VALUES ($skar_id, $product_id, $rating, '$review_text')";

    if (mysqli_query($conn, $sql)) {
        http_response_code(201);
        echo json_encode(['message' => 'Review added successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => mysqli_error($conn)]);
    }

}


elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $sql = "SELECT * FROM review";

    $result = mysqli_query($conn, $sql);

    $reviews = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $reviews[] = $row;
    }

    echo json_encode($reviews);
}