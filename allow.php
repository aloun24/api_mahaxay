<?php 
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // The request is a preflight request, so respond with a 200 status
    http_response_code(200);
    exit;
}


    

?>