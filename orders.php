<?php
include "allow.php";
include "function.php";
// Call function with PDO object and table name as arguments

$api = $_SERVER["REQUEST_METHOD"];

if ($api == "GET") {
    if (isset($_GET['orderDetails'])) {
        $id_order_details = $_GET['orderDetails'];
        $data = fetchOrder_details($pdo, $id_order_details);
    } else {

        if (isset($_GET['idOrder'])) {
            $id_order = $_GET['idOrder'];
        } else {
            $id_order = null;
        }
        $table = 'orders as o left join users as u on o.customerID = u.iduser';
        


        if (isset($id_order) != null) {
            $id_column = 'idOrder';
            $data = fetchID($pdo, $table, $id_column, $id_order);
        } else {


            $data = fetchAll($pdo, $table);
        }
        if(isset($_GET['statusID'])){
            $status_id = "'".$_GET['statusID']."'";
            $id_column = 'status';
            $data = fetchID($pdo, $table, $id_column, $status_id);

        }
    }
    echo json_encode($data);
}if($api == "POST"){
    if(isset($_GET['deleteOrder'])){
        $id_order =$_GET['deleteOrder'];
        $table = "orders";
        $id_column ="idOrder";
        $link = $_POST['link'];

        delete($pdo,$table,$id_column,$id_order,$link);

        $id_column_detail = "orderID";
        $table_detail = "orderDetails";
        delete($pdo,$table_detail,$id_column_detail,$id_order,$link);
    }
    if(isset($_GET['deleteOrderItem'])){
        $id_order_details =$_GET['deleteOrderItem'];
        $table_detail = "orderDetails";
        $id_column_details ="idOrderDetails";
        $link = $_POST['link'];
        delete($pdo,$table_detail,$id_column_details,$id_order_details,$link);

    }
}


?>
