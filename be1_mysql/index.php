<?php
require_once './config/database.php';
spl_autoload_register(function ($class_name) {
    require './app/models/' . $class_name . '.php';
});

$productModel = new ProductModel();

$totalRow = $productModel->getTotalRow();
$perPage = 3;
$page = 1;
if(isset($_GET['page'])) {
    $page = $_GET['page'];
}
//$page = isset($_GET['page']) ? $_GET['page'] : 1;

$productList = $productModel->getProductsByPage($perPage, $page);
//$productListByCategory = $productModel->getProductsByCategory($id);

$categoryModel = new CategoryModel();
$categoryList = $categoryModel->getCategories();

$pageLinks = Pagination::createPageLinks($totalRow, $perPage, $page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<style>
    .navbar{
        position: relative;
    }

    .ketqua{
        margin-top: 50px;
        width: 100px; 
        height: 50px; 
        z-index: 10;
        position: absolute;
        display: none;
    }        
    .nametext{
        background: #a1a2a2;
        padding: 10px;
        width: 370px;
        border-bottom: 1px solid black;
    }

    .nametext a{
        padding: 10px;
        text-decoration: none;
        color: black;
    }
</style>
</head>
<body>


<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <?php
                foreach ($categoryList as $item) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="category.php?id=<?php echo $item['id']; ?>"><?php echo $item['category_name']; ?></a>
                </li>
                <?php
                }
                ?>
                
      </ul>
      <form class="d-flex" action="search.php" method="get">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" name="q" id="search1" onkeyup="searchProduct()">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                <div class="ketqua">
                </div>
      </form>
    </div>
  </div>
</nav></div>

    <div class="container">
        <div class="row">
        <div class="col-md-3">
                <h2>Danh mục</h2>
                <ul>
                <?php
                foreach ($categoryList as $item) {
                ?>
                <li class="nav-item">
                    <label>
                    <?php echo $item['category_name']; ?>
                    <input type="checkbox" name="" class="checkbox" onclick="getProductsByCategory()" value="<?php echo($item['id']);?>">
                    <lable>
                </li>
                <?php
                }
                ?>
                </ul>
        </div>
        <div class="col-md-9">
        <div class="row" id="cardID">
            <?php
            foreach ($productList as $item) {
            ?>
            <div class="col-md-4">
                <div class="card">
                    <?php
                    $productPath = strtolower(str_replace(' ', '-', $item['product_name'])) . '-' . $item['id'];
                    ?>
                    <a href="product.php/<?php echo $productPath; ?>">
                        <img src="./public/images/<?php echo $item['product_photo'] ?>" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title" onclick="getProductByID(<?php echo $item['id'] ?>)"><?php echo $item['product_name'] ?></h5>
                        <p class="card-text"><?php echo $item['product_price'] ?></p>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        </div>
        </div>
        <?php echo $pageLinks; ?>
    </div>
<!-- Modal -->
<div class="modal fade" id="productModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="result">
        
      </div>
    </div>
  </div>
</div>
</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

<script src="./public/js/ajax.js"></script>

</html>