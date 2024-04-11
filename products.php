<?php

include "function.php";
// Call function with PDO object and table name as arguments
include "auth.php";

$api = $_SERVER["REQUEST_METHOD"];

if (isset($_GET['idProduct'])) {
    $id_product = $_GET['idProduct'];
} else {
    $id_product = null;
}
$table = 'products';
$id_column = 'idProduct';
if ($api == "GET") {
    authenticateToken($pdo);
    

    if(isset($_GET['idCategoryProducts'])){
        $id_category_product = $_GET['idCategoryProducts'];
        $data = fetchcategory_products($pdo,  $id_category_product);
    
    }else{
        if (isset($id_product) != null) {

            $data = fetchID($pdo, $table, $id_column, $id_product);
        } else {
    
    
            $data = fetchAll($pdo, $table);
        }
        
    }

    echo json_encode($data);
    
}





// =============================================================================================== INSERT PRODUCTS ===========================================================================
// =============================================================================================== INSERT PRODUCTS ===========================================================================
// =============================================================================================== INSERT PRODUCTS ===========================================================================
// =============================================================================================== INSERT PRODUCTS ===========================================================================
// =============================================================================================== INSERT PRODUCTS ===========================================================================


// include "auth.php";
if($api == "POST"){
    
    // authenticateToken($pdo);
      // Get the file name and path of the uploaded image  
      
        $file_name = $_FILES['productImage']['name'];
      $tmp_name = $_FILES['productImage']['tmp_name'];
      $file_type = $_FILES['productImage']['type'];

      if($file_type == 'image/png' || $file_type == 'image/jpeg' || $file_type == 'image/webp') {

       // Load the original image file
       $image = imagecreatefromstring(file_get_contents($tmp_name));
     
       // Create a new image with the same dimensions as the original
       $new_image = imagecreatetruecolor(imagesx($image), imagesy($image));
     
       // Fill the new image with a transparent background
       $transparent = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
       imagefill($new_image, 0, 0, $transparent);
       imagesavealpha($new_image, true);
     
       // Copy the original image to the new image
       imagecopy($new_image, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
     
       // Save the new image as a WebP format file
       $new_file_name = pathinfo($file_name, PATHINFO_FILENAME) . '.webp';
       $new_file_path = 'images/products/' . $new_file_name;
       imagewebp($new_image, $new_file_path, 80);
     
       // Free up memory by destroying the images
       imagedestroy($image);
       imagedestroy($new_image);
     
       // Delete the original file
       unlink($tmp_name);
     
     } else {
       // Handle invalid file type error
     }
     $main_url ="https://" . $_SERVER['SERVER_NAME'] ."/api_mahaxay/images/products"; 
     $image_database_name =$main_url."/".$new_file_name;

    $data_array = array();
   
       $data_array['categoryID'] = $_POST['categoryID'];
       $data_array['productName'] = $_POST['productName'];
       $data_array['productCode'] = $_POST['productCode'];
       $data_array['productImage'] = $image_database_name;
       $data_array['description'] = $_POST['description'];
       $data_array['price'] = $_POST['price'];
       $data_array['stock'] = $_POST['stock'];
       $data_array['unit'] = $_POST['unit'];
       $data_array['productGroup'] = $_POST['productGroup'];




       



       // Convert the uploaded image to WebP format
    //    $imagick = new \Imagick($tmp_name);
    //    $imagick->setImageFormat('webp');
    //    $webp_data = $imagick->getImageBlob();


    

   $data_category =  json_encode($data_array);
      $table ="products";
      echo $data_category;
      
      // Call the insertData function with the POST data
      insert($pdo, $table,$data_category);


      
   

}






// =============================================================================================== EDIT PRODUCTS ===========================================================================
// =============================================================================================== EDIT PRODUCTS ===========================================================================
// =============================================================================================== EDIT PRODUCTS ===========================================================================
// =============================================================================================== EDIT PRODUCTS ===========================================================================
// =============================================================================================== EDIT PRODUCTS ===========================================================================


// if($api == "PUT" ||  $api == "put"){
    // $body = file_get_contents('php://input');
    // parse_str(file_get_contents("php://input"), $put_vars);
    // $data = json_decode($body, true);
    // $name_product = $put_vars['name_product'];
    // $id =$put_vars['id_product'];
    // $table="products";
    // $id_table = "id_product";
    // $id =$put_vars['id_product'];


    // $data = json_decode(file_get_contents("php://input"), true);
    // echo $data;


    // $data_array = array();
    //     $data_array['name_product'] = $name_product;
    //     $data_category =  json_encode($data_array);
    //     $table="products";
    //     $id_table = "id_product";

        
        
    //     insert($pdo, $table,$data_category,$id_table,$id);
// }







if($api == "POST"){
    if(isset($_GET['editProduct'])){
        $id = $_GET['editProduct'];
        $id_table = "idProduct";

        if(!isset($_FILES['productImage']['name']) || trim($_FILES['productImage']['name']) == ''){
            $image_database_name = $_POST['image_old'];
          
        }else{

            




            $file_name = $_FILES['productImage']['name'];
            $tmp_name = $_FILES['productImage']['tmp_name'];
            $file_type = $_FILES['productImage
            ']['type'];
      
            if($file_type == 'image/png' || $file_type == 'image/jpeg' || $file_type == 'image/webp') {
      
             // Load the original image file
             $image = imagecreatefromstring(file_get_contents($tmp_name));
           
             // Create a new image with the same dimensions as the original
             $new_image = imagecreatetruecolor(imagesx($image), imagesy($image));
           
             // Fill the new image with a transparent background
             $transparent = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
             imagefill($new_image, 0, 0, $transparent);
             imagesavealpha($new_image, true);
           
             // Copy the original image to the new image
             imagecopy($new_image, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
           
             // Save the new image as a WebP format file
             $new_file_name = pathinfo($file_name, PATHINFO_FILENAME) . '.webp';
             $new_file_path = 'images/products/' . $new_file_name;
             imagewebp($new_image, $new_file_path, 80);
           
             // Free up memory by destroying the images
             imagedestroy($image);
             imagedestroy($new_image);
           
             // Delete the original file
             unlink($tmp_name);
           
           } else {
             // Handle invalid file type error
           }
           $main_url ="http://" . $_SERVER['SERVER_NAME'] ."/api/images/products"; 
           $image_database_name =$main_url."/".$new_file_name;

        }

        $data_array = array();
        $data_array['categoryID'] = $_POST['categoryID'];
        $data_array['productName'] = $_POST['productName'];
        $data_array['productCode'] = $_POST['productCode'];
        $data_array['productImage'] = $image_database_name;
        $data_array['description'] = $_POST['description'];
        $data_array['price'] = $_POST['price'];
        $data_array['stock'] = $_POST['stock'];
        $data_array['unit'] = $_POST['unit'];


        // this link for redirect 
        $link= $_POST['link'];


        $data_category =  json_encode($data_array);
        $table = "products";
        // echo $data_category;

        edit($pdo, $table,$data_category,$id_table,$id,$link);


    }
    if(isset($_GET['delete_product'])){
        $id_product =$_GET['delete_product'];
        $table = "products";
        $id_column ="idProduct";
        $link = $_POST['link'];

        delete($pdo,$table,$id_column,$id_product,$link);
    }
}


?>



   








