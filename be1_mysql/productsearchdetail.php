<?php
session_start();
require_once './config/database.php';
require_once './config/config.php';
spl_autoload_register(function ($class_name) {
    require './app/models/' . $class_name . '.php';
});
$productModel = new ProductModel();
$input = json_decode(file_get_contents('php://input' ), true);
$key= $input['key'];
$listproduct;
if($key == ""){
    $listproduct  = null;
}else{
    $listproduct = $productModel->searchProducts($key); 
}
echo json_encode($listproduct);
?>