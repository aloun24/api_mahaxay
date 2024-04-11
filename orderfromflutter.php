<?php
include "function.php";
include "auth.php";




// $api = $_SERVER["REQUEST_METHOD"];
// Call function with PDO object and table name as arguments

$api = $_SERVER["REQUEST_METHOD"];

if ($api == "GET") {
    // authenticateToken($pdo);
    if (isset($_GET['idOrderfromflutter'])) {
        $idOrderfromflutter = $_GET['idOrderfromflutter'];
    } else {
        $idOrderfromflutter = null;
    }
    $table = 'orderfromflutter';
    $id_column = 'idOrderfromflutter';
    if ($api == "GET") {
    
        if (isset($id_user) != null) {
    
            $data = fetchID($pdo, $table, $id_column, $idOrderfromflutter);
        } else {
    
    
            $data = fetchAll($pdo, $table);
        }
        echo json_encode($data);
    }




}



//     $id_product = $_GET['idProduct'];
// } else {
//     $id_product = null;
// }
// $table = 'orderfromflutter';
// $id_column = 'idOrderfromflutter';
// if ($api == "GET") {

    

//     if(isset($_GET['idCategoryProducts'])){
//         $id_category_product = $_GET['idCategoryProducts'];
//         $data = fetchcategory_products($pdo,  $id_category_product);
    
//     }else{
//         if (isset($id_product) != null) {

//             $data = fetchID($pdo, $table, $id_column, $id_product);
//         } else {
    
    
//             $data = fetchAll($pdo, $table);
//         }
        
//     }

//     echo json_encode($data);
    
// }



?>