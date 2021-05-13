<?php
require_once('./checkSession.php');//引入判斷是否登入機制
require_once('./db.inc.php');//引用資料庫連線

//預設訊息
$objResponse = [];
$objResponse['success'] = false;
$objResponse['info'] = "沒有任何更新";

//因為有圖片不確定需不需要繫結
// 所以需要在這邊先有一個陣列,一個個放進去
$arrParam=[];

//先加寫sql前面開頭的部分
$sql="UPDATE `auctionitems` SET";

//itemName SQL 語句和資料繫結的部分補上
$sql.= "`aucName` = ?,
        `aucClass`=?, ";
$arrParam[] = $_POST['aucName'];
$arrParam[] = $_POST['itemCategoryId'];

//如果檔案上傳沒有問題,就執行以下動作
if( $_FILES["aucImg"]["error"] === 0 ) {

    //為上傳檔案命名
    $strDatetime = "auc_".date("YmdHis");
        
    //找出副檔名
    $extension = pathinfo($_FILES["aucImg"]["name"], PATHINFO_EXTENSION);

    //建立完整名稱
    $aucImg = $strDatetime.".".$extension;

     //若上傳成功 (有夾帶檔案上傳)，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑
     $isSuccess = move_uploaded_file($_FILES["aucImg"]["tmp_name"], "./images/items/{$aucImg}");
    
     if( $isSuccess ) {
         //先查詢出特定 id (itemId) 資料欄位中的大頭貼檔案名稱
         $sqlGetImg = "SELECT `aucImg` FROM `items` WHERE `id` = ? ";
         $stmtGetImg = $pdo->prepare($sqlGetImg);
 
         //加入繫結陣列
         $arrGetImgParam = [
             (int)$_POST['id']
         ];

          //執行 SQL 語法
        $stmtGetImg->execute($arrGetImgParam);

        //若有找到 itemImg 的資料
        if($stmtGetImg->rowCount() > 0) {
            //取得指定 id 的商品資料 (1筆)
            $arrImg = $stmtGetImg->fetchAll()[0];

            //若是 itemImg 裡面不為空值，代表過去有上傳過
            if($arrImg['aucImg'] !== NULL){
                //刪除實體檔案
                @unlink("../images/items/".$arrImg['aucImg']);
            } 

            //itemImg SQL 語句字串
            $sql.= "`aucImg` = ? ,";

            //僅對 itemImg 進行資料繫結
            $arrParam[] = $aucImg;
            
        }
    }
}

//itemPrice SQL 語句和資料繫結
$sql.= "`aucPriceStart` = ? , 
        `aucQty` = ? 
        WHERE `id` = ? ";
$arrParam[] = $_POST['aucPriceStart'];
$arrParam[] = $_POST['aucQty'];
$arrParam[] = (int)$_POST['id'];
$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

header("Refresh: 2; url=./edit.php?id={$_POST['id']}");

if( $stmt->rowCount()> 0 ){
    $objResponse['success'] = true;
    $objResponse['info'] = "更新成功";
}

echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);