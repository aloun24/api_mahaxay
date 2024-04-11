<?php
include "function.php";
// Call function with PDO object and table name as arguments

$api = $_SERVER["REQUEST_METHOD"];

if (isset($_GET['idUser'])) {
    $id_user = $_GET['idUser'];
} else {
    $id_user = null;
}
$table = 'users';
$id_column = 'idUser';
if ($api == "GET") {

    if (isset($id_user) != null) {

        $data = fetchID($pdo, $table, $id_column, $id_user);
    } else {


        $data = fetchAll($pdo, $table);
    }
    echo json_encode($data);
}
?>