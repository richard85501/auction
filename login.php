<!-- 作為判定是否可以登入的頁面 -->
<?php
//require_once 是匯入使用 header 是跳轉過去那個頁面
require_once('./db.inc.php');

//isset 用來檢查是否有這筆變數
//檢查input 裡面的name 是否符合post傳過來的值
//變數存在就檢查其他條件,沒有就跳出
if(isset($_POST['username'])&& isset($_POST['pwd'])){
    // switch($_POST['identity']){
    //sql語法,只會回傳一個查詢的結果,還需要用別的方法取的
    // case 'admin':
        $sql = "SELECT `username`, 'pwd'
                FROM `admin`
                WHERE`username` =?
                AND `pwd` =? ";
    //  break;
    //把從前端輸入傳過來的資料,變成一個陣列
    $arrParam =[
        $_POST['username'],
        sha1($_POST['pwd'])
    ];

    //為了預防 sql injection 幫sql語法先加上跳脫字元
    $stmt =$pdo->prepare($sql);
    //執行sql語法
    $stmt->execute($arrParam);

    //查詢到列數大於0,代表有查詢到結果
    if($stmt->rowCount()>0){
        //啟動session
        session_start();

        //將傳送過來的 post 變數資料，放到 session，
        $_SESSION['username'] =$_POST['username'];

        //跳轉頁面
        header('Refresh:1 ;url=./admin.php');
        echo "登入成功…2秒後進入首頁";

        // echo "登入成功!!! 2秒後自動進入後端頁面";
    } else {
        header("Refresh: 1; url=./index.php");
        echo "登入失敗…2秒後自動反回登入頁";
    }

}else{
    //返回登入頁面
    //Refresh 表示幾秒後返回
    header("Refresh: 1;url=./index.php");
    //印出字幕告訴使用者要跳回登入頁面
    echo "請確實登入...2秒後自動返回登入頁面";
}