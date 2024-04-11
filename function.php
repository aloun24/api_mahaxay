<?php

include "connect.php";



// ==================================================================================== DISPLAY =======================================================================================
// ==================================================================================== DISPLAY =======================================================================================
// ==================================================================================== DISPLAY =======================================================================================


function fetchAll($pdo, $table)
{
    $stmt = $pdo->prepare("SELECT * FROM $table");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}
function fetchID($pdo, $table, $id_column, $id)
{
    $stmt = $pdo->prepare("SELECT * FROM $table where $id_column = $id");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

// Call function with PDO object and table name as arguments
// $table = 'users';
// $data = fectAll($pdo, $table);

// Do something with results
// foreach ($data as $row) {
//     echo $row['username'] . '<br>';
// }
function fetchOrder_details($pdo, $id_order_details)
{
    $stmt = $pdo->prepare("SELECT * FROM order_details od JOIN orders o on od.order_id = o.id_order JOIN products as  p  on p.id_product = od.product_id WHERE order_id = $id_order_details");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}


function fetchcategory_products($pdo, $id_category)
{
    $stmt = $pdo->prepare("SELECT * FROM products where category_id = $id_category");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}













// ==================================================================================== INSERT =======================================================================================
// ==================================================================================== INSERT =======================================================================================
// ==================================================================================== INSERT =======================================================================================


function insert($pdo, $table,$data)

{
    
$data_array = json_decode($data, true);
$columns = implode(',', array_keys($data_array));
$values = "'".implode("','", ($data_array))."'";

  $stmt = $pdo->prepare("INSERT INTO $table ($columns) values ($values)");
    $stmt->execute();

    
}





function edit($pdo, $table, $data, $id_table, $id, $link){
    $data_array = json_decode($data, true);

    $columns = array_keys($data_array);
    $placeholders = array_map(function($column) {
        return $column . ' = :' . $column;
    }, $columns);

    $sql = "UPDATE $table SET " . implode(', ', $placeholders) . " WHERE $id_table = :id";

    $stmt = $pdo->prepare($sql);

    foreach($data_array as $column => $value){
        $stmt->bindValue(':' . $column, $value);
    }
    $stmt->bindValue(':id', $id);

    $stmt->execute();


   
  
    // Use JavaScript to redirect the user to the specified URL
    echo "<script>window.location.replace('$link');</script>";
    exit();
}




function delete($pdo, $table, $id_table, $id,$link){
    
    $stmt = $pdo->prepare("DELETE FROM $table  WHERE $id_table = $id");
    $stmt->execute();

    echo "<script>window.location.replace('$link');</script>";
    exit();


}

?>
