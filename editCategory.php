<?php
require_once('./checkSession.php'); //引入判斷是否登入機制
require_once('./db.inc.php'); //引用資料庫連線
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
                            <h1 class="h2 text-uppercase mb-0">editCategory</h1>
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
                    $sql = "SELECT `categoryId`, `categoryName` FROM `categories` ";
                    $stmt = $pdo->query($sql);
                    if ($stmt->rowCount() > 0) {
                        $arr = $stmt->fetchAll();
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

                <div class="col-md-10 col-sm-9 pt-5">
                    <h3>商品種類編輯</h3>
                    <form name="myForm" method="POST" action="updateCategory.php">
                        <table class="border">
                            <thead class="whitewordcolor">
                                <tr>
                                    <th class="border">種類名稱</th>
                                    <th class="border">新增時間</th>
                                    <th class="border">更新時間</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //SQL 敘述
                                $sql = "SELECT `categoryId`, `categoryName`, `created_at`, `updated_at`
                                FROM  `categories`
                                WHERE `categoryId` = ? ";

                                $arrParam = [
                                    (int)$_GET['editCategoryId']
                                ];

                                //查詢
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute($arrParam);

                                //資料數量大於 0，則列出相關資料
                                if ($stmt->rowCount() > 0) {
                                    $arr = $stmt->fetchAll()[0];
                                ?>
                                    <tr>
                                        <td class="border">
                                            <input type="text" name="categoryName" value="<?php echo $arr['categoryName']; ?>" maxlength="100" />
                                        </td>
                                        <td class="border"><?php echo $arr['created_at']; ?></td>
                                        <td class="border"><?php echo $arr['updated_at']; ?></td>
                                    </tr>
                                <?php
                                } else {
                                ?>
                                    <tr>
                                        <td colspan="3">沒有資料</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <?php if ($stmt->rowCount() > 0) { ?>
                                        <td class="border" colspan="3"><input type="submit" name="smb" value="更新"></td>
                                    <?php } ?>
                                </tr>
                            </tfoot>
                        </table>
                        <input type="hidden" name="editCategoryId" value="<?php echo (int)$_GET['editCategoryId']; ?>">
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