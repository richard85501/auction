<?php
require_once('./checkSession.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線

$totalCatogories = $pdo->query("SELECT count(1) AS `count` FROM `auctionitems`")->fetchAll()[0]['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增商品</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style>
        .border{
        border:1px #aaaaff solid;
        text-align:center;
        }
        .w200px{
            width: 100px;
        }
        .whitewordcolor{
            background-color:#1E90FF;
            color:#ffffff;
        }
        .inputstyle{
            display:flex;
        }

        .bg_color{
            padding:5px;
        }
    </style>
</head>
<body>
    <?php
    require_once("./templates/titles.php");
    ?>
    <div class="container-fluid">
        <div class="d-flex">
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
                <h3>新增商品</h3>
                <div>
                    <form action="./add.php" name="myForm" method="POST" enctype="multipart/form-data"">
                        <table class="border">
                            <thead>
                                <tr >
                                    <th class="border bg_color whitewordcolor">商品名稱</th>
                                     <td class="inputstyle">
                                        <input type="text" name = "aucName" value="" maxlength="100"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="border bg_color whitewordcolor">初始價格</th>
                                    <td  class="border inputstyle">
                                        <input type="text" name="aucPriceStart" value="" maxlength="20" />
                                    </td>
                                </tr>
                                <tr>
                                    <th class="border bg_color whitewordcolor">商品分類</th>
                                    <td class="border inputstyle">
                                        <select name="itemCategoryId">
                                        <?php
                                        //顯示所有商品種類
                                        $sql = "SELECT `categoryId`, `categoryName` FROM `categories` ";
                                        $stmt = $pdo->query($sql);
                                        if($stmt->rowCount() > 0) {
                                            $arr = $stmt->fetchAll();
                                            for($i = 0; $i < count($arr); $i++) {
                                        ?>
                                            <option value="<?php echo $arr[$i]['categoryId'] ?>"><?php echo $arr[$i]['categoryName'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="border bg_color whitewordcolor">商品數量</th>
                                    <td  class="border inputstyle">
                                        <input type="text" name="aucQty" value="" maxlength="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <th class="border bg_color whitewordcolor">商品描述</th>
                                    <td  class="border inputstyle">
                                        <input type="text" name="aucDes" value="" maxlength="500" />
                                    </td>
                                </tr>
                                <tr>
                                    <th class="border bg_color whitewordcolor">商品照片</th>
                                    <td  class="border inputstyle">
                                        <input type="file" name="aucImg" value=""/>
                                    </td>
                                </tr>
                            </thead>
                            
                            <tfoot>
                                <tr>
                                    <td class="border" colspan="6"><input type="submit" name="smb" value="新增"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>