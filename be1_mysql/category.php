<?php
require_once './config/database.php';
require_once './config/config.php';
spl_autoload_register(function ($class_name) {
    require './app/models/' . $class_name . '.php';
});

$id = $_GET['id'];
$productModel = new ProductModel();
$productList = $productModel->getProductsByCategory($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <?php
            foreach ($productList as $item) {
            ?>
            <div class="col-md-3">
                <div class="card">
                    <?php
                    $productPath = strtolower(str_replace(' ', '-', $item['product_name'])) . '-' . $item['id'];
                    ?>
                    <a href="product.php/<?php echo $productPath; ?>">
                        <img src="./public/images/<?php echo $item['product_photo'] ?>" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $item['product_name'] ?></h5>
                        <p class="card-text"><?php echo $item['product_price'] ?></p>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>

        </div>
    </div>
</body>
</html>