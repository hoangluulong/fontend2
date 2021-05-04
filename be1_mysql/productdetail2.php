<?php
session_start();
require_once './config/database.php';
require_once './config/config.php';
spl_autoload_register(function ($class_name) {
    require './app/models/' . $class_name . '.php';
});
$productModel = new ProductModel();
$input = json_decode(file_get_contents('php://input' ), true);
$ids= $input['ids'];

$array1=[];

if (count($ids)!=0) {
    foreach ($ids as $id) { 
        $item = $productModel->getProductsByCategory($id['id']);
        array_push($array1, $item);
    }
}else{
    $array1 = $productModel->getProductsByPage(3, 1);
}


/* 
    $list = [];
    $productModel = new ProductModel();

    foreach ($input['id'] as $value) { 
        $id = $value;
        $list = array_merge($list, $productModel->getProductsByCategory($id));
    }

    if(count($list)==0){
        $list = $productModel->getProductsByPage(3, 1);
    }

    echo json_encode($list);

*/

echo json_encode($array1);
?>