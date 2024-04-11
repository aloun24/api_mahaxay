<?php 

include "connect.php";

$api = $_SERVER["REQUEST_METHOD"];
if ($api == "POST") {
    $data = json_decode(file_get_contents('php://input'), true); // Get the JSON data sent from the client
    $username = $data["username"];
    $password = $data["password"];
    $deviceName = $data["deviceName"];
    $ip = $data["ip"];
    $location = json_encode($data["location"]); // Encode the location data as JSON

    if (validateUser($pdo, $username, $password, $userId, $roleId)) {
        $token_gen = bin2hex(random_bytes(16));
        $token = hash('sha256', $token_gen."MHX");
        $Insert_token = $pdo->prepare("INSERT INTO  login  (userId,token,lastlogin,deviceName,ip,location,roleId) values (?, ?, NOW(), ?, ?, ?, ?)");
        $Insert_token->execute([$userId, "Bearer ".$token, $deviceName, $ip, $location, $roleId]);

        // User is authenticated, return the token
        echo json_encode(["token" => $token]);
    }
}

function validateUser($pdo, $username, $password, &$userId, &$roleId) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        echo json_encode(["message" => "Invalid username"]);
        return false; // Invalid username
    }
    $hash =  $row['password'];
    $hashedPassword = password_hash($hash, PASSWORD_DEFAULT);
    

    if (password_verify($password, $hashedPassword)) {
        $userId = $row['idUser'];
        $roleId = $row['roleId'];
        return true; // Password is correct
    } else {
       
        echo json_encode(["message" => "Invalid Password"]);
        return false; // Invalid password
    }
}

?>
