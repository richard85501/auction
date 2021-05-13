<?php
require_once('./checkSession.php');//引入判斷是否登入機制
require_once('./db.inc.php');//引用資料庫連線
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
        .border{
            border:1px #aaaaff solid;
            text-align:center;
            padding:2px;
        }
        .w200px{
            width: 100px;
        }
        .page_size{
            font-size:20px;
        }
        .button_style{
            background-color: #ffffff;
            border:1px solid #ffffff;
        }
        .whitewordcolor{
            background-color:#1E90FF;
            color:#ffffff;
        }
    </style>
</head>
<body>
    <?php require_once('./templates/titles.php')?>
    <div class="container-fluid">
        <!-- 設定標頭 -->
        <div class="d-flex">
                <!-- 樹狀商品種類連結  -->
                <div class="col-md-2 col-sm-3 categories mt-4 whitewordcolor pt-3" style="height:700px">
                    <h4>分類</h4>
                    <?php
                        $sql = "SELECT `categoryId`, `categoryName` FROM `categories` ";
                        $stmt = $pdo->query($sql);
                        if($stmt->rowCount() > 0) {
                            $arr = $stmt->fetchAll();
                        ?>
                            <ul>
                                <?php for($i = 0; $i < count($arr); $i++) { ?>
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
                        if($stmt->rowCount() > 0) {
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
                            <?php if($stmt->rowCount() > 0){ ?>
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

</body>
</head>