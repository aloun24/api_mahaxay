<?php 
// include_once "function.php";

include "function.php";
$api = $_SERVER["REQUEST_METHOD"];


// Allow CORS


include "auth.php";

// authenticateToken($pdo);


    
    






function fetchID1($pdo, $table, $id_column, $id) {
    $stmt = $pdo->prepare("SELECT * FROM $table WHERE $id_column = ? group by $id_column");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function fetchAll1($pdo, $table) {
    $stmt = $pdo->prepare("SELECT * FROM $table");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Call function with PDO object and table name as arguments


$api = $_SERVER["REQUEST_METHOD"];

if ($api == "GET") {
    if (isset($_GET['idOrderfromflutter'])) {
        $idOrderfromflutter = $_GET['idOrderfromflutter'];
    } else {
        $idOrderfromflutter = null;
    }
    $table = 'orderfromflutter';
    $id_column = 'idOrderfromflutter';

    if ($idOrderfromflutter != null) {
        $data = fetchID1($pdo, $table, $id_column, $idOrderfromflutter);
    } else {
        $data = fetchAll1($pdo, $table);
    }
   
    echo json_encode($data);
}


?>