<?php
require_once('./checkSession.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線

//預設訊息
$objResponse = [];
$objResponse['success'] = false;
$objResponse['info'] = "刪除失敗";


header("Refresh: 1; url=./admin.php");

//刪除商品類別
if(isset($_GET['id'])){
    //刪掉那個categoryId 是deleteCategoryId的商品
    $sql="DELETE FROM `items` WHERE `id` =?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([(int)$_GET['id']]);
    if($stmt->rowCount() > 0) {
        $objResponse['success'] = true;
        $objResponse['info'] = "刪除成功";

    }
}

echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);