<?php
require_once('./checkSession.php'); //引入判斷是否登入機制
require_once('./db.inc.php'); //引用資料庫連線
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
    <div class="container-fluid ">
        <!-- 設定標頭 -->
        <?php require_once('./templates/titles.php') ?>
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
            <div class="col-md-10 col-sm-9 proList pt-5">
                
            </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>

</html>