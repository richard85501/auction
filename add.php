  
<?php
require_once('./checkSession.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線

//預設訊息
$objResponse = [];
$objResponse['success'] = false;
$objResponse['info'] = "新增失敗";


//上傳成功,關於圖片的上傳
if( $_FILES["aucImg"]["error"] === 0 ) {
    //為上傳檔案命名
    $strDatetime = "auc_".date("YmdHis");
        
    //找出副檔名
    $extension = pathinfo($_FILES["aucImg"]["name"], PATHINFO_EXTENSION);

    //建立完整名稱
    $imgFileName = $strDatetime.".".$extension;

    //移動暫存檔案到實際存放位置
    $isSuccess = move_uploaded_file($_FILES["aucImg"]["tmp_name"], "./images/items/".$imgFileName);

    //若上傳失敗，則不會繼續往下執行，回到管理頁面
    if( !$isSuccess ) {
        header("Refresh: 1; url=./admin.php");
        $objResponse['info'] = "圖片上傳失敗";
        exit();
    }
}else{
    $objResponse['success'] = false;
    $objResponse['info'] = "請放置圖片";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    header("Refresh: 1; url=./admin.php");
    exit();
}

// SQL
$sql = "INSERT INTO `auctionitems` (`aucName`,`aucClass`, `aucQty`,`aucDes`,`aucPriceStart`,`aucPriceNow`,`aucImg`) VALUES (?,?,?,?,?,?,?)";

$arrParam = [
    $_POST['aucName'],
    $_POST['itemCategoryId'],
    $_POST['aucQty'],
    $_POST['aucDes'],
    $_POST['aucPriceStart'],
    $_POST['aucPriceStart'],
    $imgFileName,
];

//取得 PDOstatement 物件
$stmt = $pdo->prepare($sql);

//執行預處理後的 SQL 語法
$stmt->execute($arrParam);

header("Refresh:1;url=./admin.php");

//影響列數大於0，代表新增成功
if($stmt->rowCount() > 0) {
    $objResponse['success'] = true;
    $objResponse['info'] = "新增成功";  
}
echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);


