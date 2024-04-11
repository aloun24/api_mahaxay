<?php

include "connect.php";

function authenticateToken($pdo) {
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    // Get the token from the request headers
    $headers = getallheaders();
    if (!isset($headers['Authorization'])) {
        http_response_code(401); // Unauthorized
        echo json_encode(["message" => "Unauthorized"]);
        exit();
    }
    $token = $headers['Authorization'];

    // Check if the token is valid
    $stmt = $pdo->prepare('SELECT * FROM login WHERE token = ?');
    $stmt->execute([$token]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        http_response_code(401); // Unauthorized
        echo json_encode(["message" => "Unauthorized"]);
        exit();
    }

    // Token is valid, continue with the request
    // echo json_encode(["message" => $token]);
    return $row;
}

// Example protected endpoint


?>
