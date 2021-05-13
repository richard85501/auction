<?php
require_once('./checkSession.php'); //引入判斷是否登入機制
require_once('./db.inc.php'); //引用資料庫連線

if (!isset($_GET['categoryId']) && !isset($_GET['search'])) {
    $sqlTotal = "SELECT count(1) AS `count`
                FROM `auctionitems`";
    $stmtTotal = $pdo->query($sqlTotal);
} else {
    $sqlTotal = "SELECT count(1) AS `count`
                     FROM `auctionitems`";
    if (isset($_GET['search'])) {
        $sqlTotal .= "WHERE `aucName` LIKE ? OR `aucName` LIKE ? OR `aucName` LIKE ?";
        $stmtTotal = $pdo->prepare($sqlTotal);
        $stmtTotal->execute(['%' . $_GET['search'], '%' . $_GET['search'] . '%', $_GET['search'] . '%']);
    } else {
        $sqlTotal .= "WHERE `aucClass`= ? ";
        $stmtTotal = $pdo->prepare($sqlTotal);
        $stmtTotal->execute([(int)$_GET['categoryId']]);
    }
}

$arrTotal = $stmtTotal->fetchAll()[0];
$total = $arrTotal['count'];
$numPerPage = 5;
$totalPages = ceil($total / $numPerPage);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = $page < 1 ? 1 : $page;
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ARTDDICT</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <?php
    require_once './template/linkTemplate.php';
    ?>
</head>
<style>
    .border {
        border: 1px #aaaaff solid;
        text-align: center;
    }

    .w200px {
        width: 100px;
    }

    .page_size {
        font-size: 20px;
    }

    .button_style {
        background-color: #ffffff;
        border: 1px solid #ffffff;
    }

    .whitewordcolor {
        background-color: #111111;
        color: #ffffff;
    }
</style>
</head>

<body>
    <div class="page-holder">
        <!-- navbar-->
        <header class="header bg-white">
            <div class="container px-0 px-lg-3">
                <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="index.php"><span class="font-weight-bold text-uppercase text-dark">ARTITIED</span></a>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <!-- Link--><a class="nav-link" href="index.html"></a>
                            </li>
                            <li class="nav-item">
                                <!-- Link--><a class="nav-link" href="shop.html"></a>
                            </li>
                            <li class="nav-item">
                                <!-- Link--><a class="nav-link" href="detail.html"></a>
                            </li>
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item"><a class="nav-link" href="cart.html"> <i class="fas fa-dolly-flatbed mr-1 text-white"></i><small class="text-gray"></small></a></li>
                                <li class="nav-item"><a class="nav-link" href="#"> <i class="fas fa-user-alt mr-1 text-white"></i></a></li>
                            </ul>

                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--  Modal -->
        <div class="modal fade" id="productView" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="row align-items-stretch">
                            <div class="col-lg-6 p-lg-0"><a class="product-view d-block h-100 bg-cover bg-center" style="background: url(img/product-5.jpg)" href="img/product-5.jpg" data-lightbox="productview" title="Red digital smartwatch"></a><a class="d-none" href="img/product-5-alt-1.jpg" title="Red digital smartwatch" data-lightbox="productview"></a><a class="d-none" href="img/product-5-alt-2.jpg" title="Red digital smartwatch" data-lightbox="productview"></a></div>
                            <div class="col-lg-6">
                                <button class="close p-4" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <div class="p-5 my-md-4">
                                    <ul class="list-inline mb-2">
                                        <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                                        <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                                        <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                                        <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                                        <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                                    </ul>
                                    <h2 class="h4">Red digital smartwatch</h2>
                                    <p class="text-muted">$250</p>
                                    <p class="text-small mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut ullamcorper leo, eget euismod orci. Cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus. Vestibulum ultricies aliquam convallis.</p>
                                    <div class="row align-items-stretch mb-4">
                                        <div class="col-sm-7 pr-sm-0">
                                            <div class="border d-flex align-items-center justify-content-between py-1 px-3"><span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                                                <div class="quantity">
                                                    <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                                                    <input class="form-control border-0 shadow-0 p-0" type="text" value="1">
                                                    <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 pl-sm-0"><a class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" href="cart.html">Add to cart</a></div>
                                    </div><a class="btn btn-link text-dark p-0" href="#"><i class="far fa-heart mr-2"></i>Add to wish list</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- HERO SECTION-->
            <section class="py-5 bg-light">
                <div class="container">
                    <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                        <div class="col-lg-6">
                            <h1 class="h2 text-uppercase mb-0">product</h1>
                        </div>
                        <div class="col-lg-6 text-lg-right">

                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="container pb-5">
            <?php require_once('./templates/titles.php') ?>
            <!-- 設定標頭 -->
            <div class="d-flex">
                <!-- 樹狀商品種類連結  -->
                <div class="col-md-2 col-sm-3 categories mt-4 whitewordcolor pt-3" style="height: 400px">
                    <h4>分類</h4>
                    <?php
                    $sqlCat = "SELECT `categoryId`, `categoryName` FROM `categories` ";
                    $stmt = $pdo->query($sqlCat);
                    if ($stmt->rowCount() > 0) {
                        $arr = $stmt->fetchAll();
                        // 盛裝分類值給page的變數
                    ?>
                        <ul>
                            <?php for ($i = 0; $i < count($arr); $i++) { ?>
                                <li>
                                    <a class="whitewordcolor" href="./admin.php?categoryId=<?php echo $arr[$i]['categoryId'] ?>">
                                        <?php echo $arr[$i]['categoryName'] ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
                <!-- proList目前沒用 -->
                <div class="col-md-10 col-sm-9 proList pt-1">
                    <!-- 方法使用post 來傳遞資料 -->
                    <div>
                        <div class="d-flex align-items-center mt-1 mb-1">
                            <h6 class="mb-0">查詢 : &nbsp;</h6>
                            <form class="mb-0" action="./admin.php" method="get" name="formforsearch">
                                <input type="text" name="search" value="" maxlength="50" />
                                <button class="button_style" type="submit" name="smb" value="查詢">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <form action="./deleteIds.php" name="myForm" method="POST">
                            <table class="border">
                                <thead class="whitewordcolor">
                                    <tr>
                                        <th class="border">選擇</th>
                                        <th class="border">商品名稱</th>
                                        <th class="border">商品數量</th>
                                        <th class="border">起始價格</th>
                                        <th class="border">最新價格</th>
                                        <th class="border">商品描述</th>
                                        <th class="border">商品照片</th>
                                        <th class="border">上價日期</th>
                                        <th class="border">上次編輯<br>時間</th>
                                        <th class="border">功能</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php


                                    $sql = "SELECT `i`.`id`,`i`.`aucClass`,`i`.`aucName`,`i`.`aucQty`,`i`.`aucDes`,`i`.`aucId`,`i`.`aucPriceStart`,`i`.`aucPriceNow`,`i`.`aucImg`,`i`.`created_at`,`i`.`updated_at`
                                FROM `auctionitems`AS `i` INNER JOIN `categories`
                                ON `i`.`aucClass` = `categories`.`categoryId`";

                                    if (isset($_GET['categoryId']) && !isset($_GET['search'])) {
                                        $sql .= "WHERE `i`.`aucClass` = ?
                                    ORDER BY `i`.`id` ASC
                                    LIMIT?,?";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute([$_GET['categoryId'], ($page - 1) * $numPerPage, $numPerPage]);
                                    } else {
                                        if (isset($_GET['search'])) {
                                            $sql .= "WHERE `aucName` LIKE ? OR `aucName` LIKE ? OR `aucName` LIKE ?
                                                    ORDER BY `i`.`id` ASC
                                                    LIMIT?,?";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute(['%' . $_GET['search'], '%' . $_GET['search'] . '%', $_GET['search'] . '%', ($page - 1) * $numPerPage, $numPerPage]);
                                        } else {
                                            $sql .= "ORDER BY `i`.`id` ASC
                                            LIMIT?,?";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute([($page - 1) * $numPerPage, $numPerPage]);
                                        }
                                    }

                                    if ($stmt->rowCount() > 0) {
                                        $arr = $stmt->fetchAll();
                                        for ($i = 0; $i < count($arr); $i++) {
                                    ?>
                                            <tr>
                                                <!-- 可以再前面勾選並予以刪除 -->
                                                <td class="border">
                                                    <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['id']; ?>" />
                                                </td>
                                                <!-- 商品名稱 -->
                                                <td class="border"><?php echo $arr[$i]['aucName']; ?></td>
                                                <!-- 商品數量 -->
                                                <td class="border"><?php echo $arr[$i]['aucQty']; ?></td>
                                                <!-- 商品起始價格-->
                                                <td class="border"><?php echo $arr[$i]['aucPriceStart']; ?></td>
                                                <!-- 商品最新價格-->
                                                <td class="border"><?php echo $arr[$i]['aucPriceNow']; ?></td>
                                                <!-- 商品描述 -->
                                                <td class="border"><?php echo $arr[$i]['aucDes']; ?></td>
                                                <!-- 商品照片路徑 -->
                                                <td class="border"><img class="itemImg w200px" src="./images/items/<?php echo $arr[$i]['aucImg']; ?>" /></td>
                                                <!-- 下面是顯示圖片檔案 -->
                                                <!-- <td class="border"><?php echo $arr[$i]['aucImg']; ?></td> -->
                                                <!-- 新增,更新時間 -->
                                                <td class="border"><?php echo $arr[$i]['created_at']; ?></td>
                                                <td class="border"><?php echo $arr[$i]['updated_at']; ?></td>
                                                <td class="border">
                                                    <div class="d-flex flex-column text-center">
                                                        <!-- 編輯使用 -->
                                                        <a class="btn-sm btn-primary" href="./edit.php?id=<?php echo $arr[$i]['id']; ?>">編輯</a>
                                                        <a class="btn-sm btn-info mt-1" href="./delete.php?id=<?php echo $arr[$i]['id']; ?>">刪除</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td class="border" colspan="5"> 沒有資料</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            <button class="button_style" type="submit" name="smb" value="刪除">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                        <td class="border" colspan="9">
                                            <?php for ($i = 1; $i <= $totalPages; $i++) {
                                                if (!isset($_GET['categoryId']) && !isset($_GET['search'])) {  ?>
                                                    <a class="page_size" href="?page=<?php echo $i ?>"><?php echo $i ?></a>
                                                    <?php } else {
                                                    if (isset($_GET['search'])) { ?>
                                                        <a class="page_size" href="?page=<?php echo $i ?>&search=<?php echo $_GET['search'] ?>"><?php echo $i ?></a>
                                                    <?php } else { ?>
                                                        <a class="page_size" href="?page=<?php echo $i ?>&categoryId=<?php echo $_GET['categoryId'] ?>"><?php echo $i ?></a>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                    </div>
                    </form>
                </div>
            </div>
        </div>



        <footer class="bg-dark text-white">
            <div class="container py-4">
                <div class="row py-5">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <h6 class="text-uppercase mb-3">Customer services</h6>
                        <ul class="list-unstyled mb-0">
                            <li><a class="footer-link" href="#">Help &amp; Contact Us</a></li>
                            <li><a class="footer-link" href="#">Returns &amp; Refunds</a></li>
                            <li><a class="footer-link" href="#">Online Stores</a></li>
                            <li><a class="footer-link" href="#">Terms &amp; Conditions</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <h6 class="text-uppercase mb-3">Company</h6>
                        <ul class="list-unstyled mb-0">
                            <li><a class="footer-link" href="#">What We Do</a></li>
                            <li><a class="footer-link" href="#">Available Services</a></li>
                            <li><a class="footer-link" href="#">Latest Posts</a></li>
                            <li><a class="footer-link" href="#">FAQs</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-uppercase mb-3">Social media</h6>
                        <ul class="list-unstyled mb-0">
                            <li><a class="footer-link" href="#">Twitter</a></li>
                            <li><a class="footer-link" href="#">Instagram</a></li>
                            <li><a class="footer-link" href="#">Tumblr</a></li>
                            <li><a class="footer-link" href="#">Pinterest</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-top pt-4" style="border-color: #1d1d1d !important">
                    <div class="row">
                        <div class="col-lg-6">
                            <p class="small text-muted mb-0">&copy; 2020 All rights reserved.</p>
                        </div>
                        <div class="col-lg-6 text-lg-right">
                            <p class="small text-muted mb-0">Template designed by <a class="text-white reset-anchor" href="https://bootstraptemple.com/p/bootstrap-ecommerce">Bootstrap Temple</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- JavaScript files-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/lightbox2/js/lightbox.min.js"></script>
        <script src="vendor/nouislider/nouislider.min.js"></script>
        <script src="vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
        <script src="vendor/owl.carousel2/owl.carousel.min.js"></script>
        <script src="vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
        <script src="js/front.js"></script>
        <script>
            // ------------------------------------------------------- //
            //   Inject SVG Sprite - 
            //   see more here 
            //   https://css-tricks.com/ajaxing-svg-sprite/
            // ------------------------------------------------------ //
            function injectSvgSprite(path) {

                var ajax = new XMLHttpRequest();
                ajax.open("GET", path, true);
                ajax.send();
                ajax.onload = function(e) {
                    var div = document.createElement("div");
                    div.className = 'd-none';
                    div.innerHTML = ajax.responseText;
                    document.body.insertBefore(div, document.body.childNodes[0]);
                }
            }
            // this is set to BootstrapTemple website as you cannot 
            // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
            // while using file:// protocol
            // pls don't forget to change to your domain :)
            injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
        </script>
        <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </div>
</body>

</html>