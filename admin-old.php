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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="./fontawesome-free-5.15.2-web/css/all.css">
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
        background-color: #1E90FF;
        color: #ffffff;
    }
</style>
</head>

<body>

    <?php require_once('./templates/titles.php') ?>
    <div class="container-fluid ">
        <!-- 設定標頭 -->
        <div class="d-flex">
            <!-- 樹狀商品種類連結  -->
            <div class="col-md-2 col-sm-3 categories mt-4 whitewordcolor pt-3" style="height:700px">
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
            <div class="col-md-10 col-sm-9 proList pt-5">
                <!-- 方法使用post 來傳遞資料 -->
                <div>
                    <h3 class="mb-0">商品列表</h3>
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
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>




</body>

</html>