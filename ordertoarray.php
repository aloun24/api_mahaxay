<?php
include "function.php";
// include "auth.php";




// $api = $_SERVER["REQUEST_METHOD"];
// Call function with PDO object and table name as arguments

$api = $_SERVER["REQUEST_METHOD"];


function fetchAlltoArray($pdo, $table)
{
    $stmt = $pdo->prepare("SELECT * FROM $table");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}
function fetchIDtoArray($pdo, $table, $id_namecolumn, $id)
{
    $stmt = $pdo->prepare("SELECT * FROM $table WHERE $id_namecolumn = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $data = []; // Initialize an empty array to hold the data

    if ($row) {
        $idorder = $row['idordertoarray'];

        $pronameArray = explode(',', $row['proname']); // Split the string into an array
        $proname = array_map(function($item) {
            return trim($item, "[]");
        }, $pronameArray);

        $barcodeArray = explode(',', $row['barcode']); // Split the string into an array
        $barcode = array_map(function($item) {
            return trim($item, "[]");
        }, $barcodeArray);

        $priceArray = explode(',', $row['price']); // Split the string into an array
        $price = array_map(function($item) {
            return trim($item, "[]");
        }, $priceArray);

        

        $quantityArray = explode(',', $row['quantity']); // Split the string into an array
        $quantity = array_map(function($item) {
            return trim($item, "[]");
        }, $quantityArray);

        $sumArray = explode(',', $row['sum']); // Split the string into an array
        $sum = array_map(function($item) {
            return trim($item, "[]");
        }, $sumArray);

        for ($i = 0; $i < count($proname); $i++) {
            // Add an object with idorder, proname, and barcode to the data array
            $data[] = [
                'idorder' => $idorder,
                'barcode' => $barcode[$i],
                'proname' => $proname[$i],
                'price'   => $price[$i],
                'quantity'=> $quantity[$i],
                'sum'     => $sum[$i],
                
            ];
        }
    }

    return $data; // Return the data array
}

// if ($rows && isset($rows['barcode'])) {
//     // Split the string into an array
//     $barcodeArray = explode(',', $rows['barcode']);

//     // Remove square brackets from each element
//     $barcodes = array_map(function($item) {
//         return trim($item, "[]");
//     }, $barcodeArray);

//     return $barcodes;
// } else {
//     // Handle the case where no row was fetched or 'barcode' column is not set
//     return [];
// }
// }

if ($api == "GET") {
    // authenticateToken($pdo);
    if (isset($_GET['idordertoarray'])) {
        $idOrderfromflutter = $_GET['idordertoarray'];
    } else {
        $idOrderfromflutter = null;
    }
    $table = 'ordertoarray';
    $id_namecolumn = 'idordertoarray';
    if ($api == "GET") {
    
        if (isset($idOrderfromflutter) != null) {
    
            $data = fetchIDtoArray($pdo, $table, $id_namecolumn, $idOrderfromflutter);
           
        } else {
    
    
            $data = fetchAlltoArray($pdo, $table);
        }
        echo json_encode($data,$idOrderfromflutter);
    }




}





?>
