<?php
//資料庫主機設定
$db_host = "localhost";
$db_username = "test";
$db_password = "T1st@localhost";
$db_name = "ARTDDICT";
$db_charset = "utf8mb4";
$db_collate = "utf8mb4_unicode_ci";

//錯誤處理
try {
    //設定 PDO 屬性
    //PDO（PHP Data Objects）是一種PHP連接資料庫的使用方法
    // 主要的好處可以避免發生SQL injection相關的問題
    // 同時也優化了許多存取資料庫的性能
    $options = [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$db_charset} COLLATE {$db_collate}"
    ];

    //PDO 連線
    $pdo = new PDO(
        "mysql:host={$db_host};dbname={$db_name};charset={$db_charset}", 
        $db_username , 
        $db_password, 
        $options
    );
} catch (PDOException $e) {
    echo "資料庫連結失敗，訊息: " . $e->getMessage();
    exit();
}