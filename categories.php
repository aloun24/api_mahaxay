<?php

include "function.php";
// Call function with PDO object and table name as arguments

$api = $_SERVER["REQUEST_METHOD"];

if (isset($_GET['idCategory'])) {
    $id_category = $_GET['idCategory'];
}
$table = 'categories';
$id_column = 'idCategory';
if ($api == "GET") {

    if (isset($id_category)) {

        $data = fetchID($pdo, $table, $id_column, $id_category);
    } else {


        $data = fetchAll($pdo, $table);
    }

    
    echo json_encode($data);
}

if($api == "POST"){
    $data_array = array();
   if (isset($_POST['categoryName'])) {
       $data_array['categoryName'] = $_POST['categoryName'];
    //    $data_array['id'] = $_POST['ids'];
    
   }
   $data_category =  json_encode($data_array);
    //   $table ="categories";
    //   echo $data_category;
      
      // Call the insertData function with the POST data
      insert($pdo,$table,$data_category);
   

}
?>