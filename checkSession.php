<?php
// session 開啟
session_start();

// 驗證username是否存在
if(!isset($_SESSION['username'])){
    //關閉session
    session_destroy();

    //回到登入頁面
    header('Refresh:1; url=./index.php');
    echo "請確實登入頁面,3秒後自動跳轉";
    exit();
}