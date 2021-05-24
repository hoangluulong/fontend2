<?php
session_start();
require_once './config/database.php';
require_once './config/config.php';
spl_autoload_register(function ($class_name) {
    require './app/models/' . $class_name . '.php';
});

$input = json_decode(file_get_contents('php://input' ), true);
$page = $input['page'];
$check = $page + 1;

$item = array();
$item2 = array();
$productModel = new ProductModel();
for ($i=1; $i<$page ; $i++) { 
    $item = $productModel->getProductsByPage($page,1);
    $item2 = $productModel->getProductsByPage($check,1);
}

$result = array();

if(count($item)<count($item2)){
    echo json_encode($item);
}else{
    $result = array_merge($item , array("stop"));
    echo json_encode($result);
}
?>