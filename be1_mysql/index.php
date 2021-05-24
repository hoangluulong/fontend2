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
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

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
    
    #more{
        /* display: none; */
    }

    #body-id{
        position: relative;
    }

    .windows8 {
	position: absolute;
	width: 140px;
	height:140px;
	margin-top: 25%;
    margin-left: 50%;
    display: none;
    z-index: 9999;
}

.windows8 .wBall {
	position: absolute;
	width: 133px;
	height: 133px;
	opacity: 0;
	transform: rotate(225deg);
		-o-transform: rotate(225deg);
		-ms-transform: rotate(225deg);
		-webkit-transform: rotate(225deg);
		-moz-transform: rotate(225deg);
	animation: orbit 2.4225s infinite;
		-o-animation: orbit 2.4225s infinite;
		-ms-animation: orbit 2.4225s infinite;
		-webkit-animation: orbit 2.4225s infinite;
		-moz-animation: orbit 2.4225s infinite;
}

.windows8 .wBall .wInnerBall{
	position: absolute;
	width: 18px;
	height: 18px;
	background: rgb(0,0,0);
	left:0px;
	top:0px;
	border-radius: 18px;
}

.windows8 #wBall_1 {
	animation-delay: 0.526s;
		-o-animation-delay: 0.526s;
		-ms-animation-delay: 0.526s;
		-webkit-animation-delay: 0.526s;
		-moz-animation-delay: 0.526s;
}

.windows8 #wBall_2 {
	animation-delay: 0.103s;
		-o-animation-delay: 0.103s;
		-ms-animation-delay: 0.103s;
		-webkit-animation-delay: 0.103s;
		-moz-animation-delay: 0.103s;
}

.windows8 #wBall_3 {
	animation-delay: 0.2165s;
		-o-animation-delay: 0.2165s;
		-ms-animation-delay: 0.2165s;
		-webkit-animation-delay: 0.2165s;
		-moz-animation-delay: 0.2165s;
}

.windows8 #wBall_4 {
	animation-delay: 0.3195s;
		-o-animation-delay: 0.3195s;
		-ms-animation-delay: 0.3195s;
		-webkit-animation-delay: 0.3195s;
		-moz-animation-delay: 0.3195s;
}

.windows8 #wBall_5 {
	animation-delay: 0.423s;
		-o-animation-delay: 0.423s;
		-ms-animation-delay: 0.423s;
		-webkit-animation-delay: 0.423s;
		-moz-animation-delay: 0.423s;
}



@keyframes orbit {
	0% {
		opacity: 1;
		z-index:99;
		transform: rotate(180deg);
		animation-timing-function: ease-out;
	}

	7% {
		opacity: 1;
		transform: rotate(300deg);
		animation-timing-function: linear;
		origin:0%;
	}

	30% {
		opacity: 1;
		transform:rotate(410deg);
		animation-timing-function: ease-in-out;
		origin:7%;
	}

	39% {
		opacity: 1;
		transform: rotate(645deg);
		animation-timing-function: linear;
		origin:30%;
	}

	70% {
		opacity: 1;
		transform: rotate(770deg);
		animation-timing-function: ease-out;
		origin:39%;
	}

	75% {
		opacity: 1;
		transform: rotate(900deg);
		animation-timing-function: ease-out;
		origin:70%;
	}

	76% {
	opacity: 0;
		transform:rotate(900deg);
	}

	100% {
	opacity: 0;
		transform: rotate(900deg);
	}
}

@-o-keyframes orbit {
	0% {
		opacity: 1;
		z-index:99;
		-o-transform: rotate(180deg);
		-o-animation-timing-function: ease-out;
	}

	7% {
		opacity: 1;
		-o-transform: rotate(300deg);
		-o-animation-timing-function: linear;
		-o-origin:0%;
	}

	30% {
		opacity: 1;
		-o-transform:rotate(410deg);
		-o-animation-timing-function: ease-in-out;
		-o-origin:7%;
	}

	39% {
		opacity: 1;
		-o-transform: rotate(645deg);
		-o-animation-timing-function: linear;
		-o-origin:30%;
	}

	70% {
		opacity: 1;
		-o-transform: rotate(770deg);
		-o-animation-timing-function: ease-out;
		-o-origin:39%;
	}

	75% {
		opacity: 1;
		-o-transform: rotate(900deg);
		-o-animation-timing-function: ease-out;
		-o-origin:70%;
	}

	76% {
	opacity: 0;
		-o-transform:rotate(900deg);
	}

	100% {
	opacity: 0;
		-o-transform: rotate(900deg);
	}
}

@-ms-keyframes orbit {
	0% {
		opacity: 1;
		z-index:99;
		-ms-transform: rotate(180deg);
		-ms-animation-timing-function: ease-out;
	}

	7% {
		opacity: 1;
		-ms-transform: rotate(300deg);
		-ms-animation-timing-function: linear;
		-ms-origin:0%;
	}

	30% {
		opacity: 1;
		-ms-transform:rotate(410deg);
		-ms-animation-timing-function: ease-in-out;
		-ms-origin:7%;
	}

	39% {
		opacity: 1;
		-ms-transform: rotate(645deg);
		-ms-animation-timing-function: linear;
		-ms-origin:30%;
	}

	70% {
		opacity: 1;
		-ms-transform: rotate(770deg);
		-ms-animation-timing-function: ease-out;
		-ms-origin:39%;
	}

	75% {
		opacity: 1;
		-ms-transform: rotate(900deg);
		-ms-animation-timing-function: ease-out;
		-ms-origin:70%;
	}

	76% {
	opacity: 0;
		-ms-transform:rotate(900deg);
	}

	100% {
	opacity: 0;
		-ms-transform: rotate(900deg);
	}
}

@-webkit-keyframes orbit {
	0% {
		opacity: 1;
		z-index:99;
		-webkit-transform: rotate(180deg);
		-webkit-animation-timing-function: ease-out;
	}

	7% {
		opacity: 1;
		-webkit-transform: rotate(300deg);
		-webkit-animation-timing-function: linear;
		-webkit-origin:0%;
	}

	30% {
		opacity: 1;
		-webkit-transform:rotate(410deg);
		-webkit-animation-timing-function: ease-in-out;
		-webkit-origin:7%;
	}

	39% {
		opacity: 1;
		-webkit-transform: rotate(645deg);
		-webkit-animation-timing-function: linear;
		-webkit-origin:30%;
	}

	70% {
		opacity: 1;
		-webkit-transform: rotate(770deg);
		-webkit-animation-timing-function: ease-out;
		-webkit-origin:39%;
	}

	75% {
		opacity: 1;
		-webkit-transform: rotate(900deg);
		-webkit-animation-timing-function: ease-out;
		-webkit-origin:70%;
	}

	76% {
	opacity: 0;
		-webkit-transform:rotate(900deg);
	}

	100% {
	opacity: 0;
		-webkit-transform: rotate(900deg);
	}
}

@-moz-keyframes orbit {
	0% {
		opacity: 1;
		z-index:99;
		-moz-transform: rotate(180deg);
		-moz-animation-timing-function: ease-out;
	}

	7% {
		opacity: 1;
		-moz-transform: rotate(300deg);
		-moz-animation-timing-function: linear;
		-moz-origin:0%;
	}

	30% {
		opacity: 1;
		-moz-transform:rotate(410deg);
		-moz-animation-timing-function: ease-in-out;
		-moz-origin:7%;
	}

	39% {
		opacity: 1;
		-moz-transform: rotate(645deg);
		-moz-animation-timing-function: linear;
		-moz-origin:30%;
	}

	70% {
		opacity: 1;
		-moz-transform: rotate(770deg);
		-moz-animation-timing-function: ease-out;
		-moz-origin:39%;
	}

	75% {
		opacity: 1;
		-moz-transform: rotate(900deg);
		-moz-animation-timing-function: ease-out;
		-moz-origin:70%;
	}

	76% {
	opacity: 0;
		-moz-transform:rotate(900deg);
	}

	100% {
	opacity: 0;
		-moz-transform: rotate(900deg);
	}
}
</style>
</head>
<body id="body-id">

<div class="windows8">
	<div class="wBall" id="wBall_1">
		<div class="wInnerBall"></div>
	</div>
	<div class="wBall" id="wBall_2">
		<div class="wInnerBall"></div>
	</div>
	<div class="wBall" id="wBall_3">
		<div class="wInnerBall"></div>
	</div>
	<div class="wBall" id="wBall_4">
		<div class="wInnerBall"></div>
	</div>
	<div class="wBall" id="wBall_5">
		<div class="wInnerBall"></div>
	</div>
</div>


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
<style>
    .like{
        fill: #fff;
        width: 30px;
        height: 40px;
    }
</style>

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
        <!-- <?php //echo $pageLinks; ?> -->
        <button type="button" class="btn btn-success" id="more" onclick="readmore()">Hiển thị Thêm >></button>
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