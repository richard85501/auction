<!-- 刪除分為兩個動作
1.刪除實體照片
2.刪除資料庫裡德資料
 -->

 <?php
require_once('./checkSession.php');//引入判斷是否登入機制
require_once('./db.inc.php');//引用資料庫連線

//將所有 id 透過「,」結合在一起，例如「1,2,3」
$strIds = join(",", $_POST['chk']);

//記錄資料表刪除數量
$count =0;

//FIND_IN_SET() 會給予字串在字串列中的位置
//先查詢出所有 id 資料欄位中的大頭貼檔案名稱
$sqlGetImg = "SELECT `aucImg`FROM `auctionitems`WHERE FIND_IN_SET(`id`,?)";
//加上跳脫字元 並執行
$stmtGetImg = $pdo->prepare($sqlGetImg);
$stmtGetImg->execute([$strIds]);

//如果找到的資料大於0筆
if($stmtGetImg->rowCount()>0){
    //取得所有大頭貼檔案名稱
    $arrImg = $stmtGetImg->fetchAll();
    for($i=0;$i<count($arrImg);$i++){
    //若是 aucImg 裡面不為空值，代表過去有上傳過
        if($arrImg[$i]['aucImg'] !== NULL){
            //刪除實體檔案
            @unlink("./files/".$arrImg[$i]['aucImg']);
        }  
}

    //刪除的sql語法
    $sqlDelete = "DELETE FROM `auctionitems`WHERE FIND_IN_SET(`id`,?)";
    //加上跳脫字元 並執行
    $stmtDelte = $pdo->prepare($sqlDelete);
    $stmtDelte->execute([$strIds]);
    // 紀錄刪除東西的數量
    $count = $stmtDelte ->rowCount();
}

// 只要有刪除到東西 就算成功 要不然就算失敗
if($count > 0) {
    header("Refresh: 1; url=./admin.php");
    echo "刪除成功";
} else {
    header("Refresh: 1; url=./admin.php");
    echo "刪除失敗";
}