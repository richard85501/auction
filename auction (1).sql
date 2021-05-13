-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-05-10 01:26:27
-- 伺服器版本： 10.4.18-MariaDB
-- PHP 版本： 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `auction`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '使用者帳號',
  `pwd` char(40) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '使用者密碼',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '管理者姓名',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理者帳號';

--
-- 傾印資料表的資料 `admin`
--

INSERT INTO `admin` (`id`, `username`, `pwd`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '優質賣家', '2021-05-03 00:16:57', '2021-05-03 00:16:57');

-- --------------------------------------------------------

--
-- 資料表結構 `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(11) NOT NULL COMMENT '流水號',
  `categoryName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '類別名稱',
  `categoryParentId` int(11) NOT NULL COMMENT '上層編號',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '修改時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`, `categoryParentId`, `created_at`, `updated_at`) VALUES
(1, '股票類', 0, '2021-05-08 18:05:49', '2021-05-08 21:42:44'),
(2, '電腦類書籍', 0, '2021-05-08 14:33:10', '2021-05-08 14:33:10'),
(3, '餅乾類', 0, '2021-05-08 18:05:33', '2021-05-09 09:50:25'),
(4, '文書類', 0, '2021-05-08 18:05:39', '2021-05-09 01:35:08');

-- --------------------------------------------------------

--
-- 資料表結構 `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `aucClass` int(20) NOT NULL COMMENT '競拍產品類別',
  `aucName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名稱',
  `aucQty` tinyint(3) NOT NULL COMMENT '商品數量',
  `aucDes` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '競拍產品描述',
  `aucId` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '競拍產品編號',
  `aucPriceStart` int(11) NOT NULL COMMENT '商品價格',
  `aucPriceNow` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '初始價格',
  `aucImg` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品照片路徑',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商品列表';

--
-- 傾印資料表的資料 `items`
--

INSERT INTO `items` (`id`, `aucClass`, `aucName`, `aucQty`, `aucDes`, `aucId`, `aucPriceStart`, `aucPriceNow`, `aucImg`, `created_at`, `updated_at`) VALUES
(6, 2, '長鬍子的尾巴', 1, '漂亮的髮夾', '', 5, '', 'auc_20210509035007.jpg', '2021-05-08 10:57:21', '2021-05-09 09:50:07'),
(8, 1, '奔跑吧', 1, '不可告人的祕密', '', 66, '', 'auc_20210508074126.jpg', '2021-05-08 13:41:26', '2021-05-08 15:13:27'),
(11, 2, '覺醒的你', 5, '暢銷書及', '', 69, '', 'auc_20210508075950.jpg', '2021-05-08 13:59:50', '2021-05-08 15:13:27'),
(12, 2, '長鬍子的尾巴', 1, '漂亮的髮夾', '', 5, '', 'auc_20210508104436.jpg', '2021-05-08 16:44:36', '2021-05-08 16:44:36'),
(13, 3, '羅技喇叭', 1, '好吃', '', 5, '', 'auc_20210508155834.jpg', '2021-05-08 21:58:34', '2021-05-08 21:58:34'),
(14, 4, '天啊好難', 1, '我在幹嘛', '', 99, '', 'auc_20210508155906.jpg', '2021-05-08 21:59:06', '2021-05-08 21:59:06'),
(15, 3, '水壺好喝', 1, '甚至可以喝到牛肉湯', '', 99, '', 'auc_20210508160003.jpg', '2021-05-08 22:00:03', '2021-05-08 22:00:03'),
(16, 3, '我好想睡覺', 1, '可是為什麼跑不動', '', 5, '', 'auc_20210508192625.jpg', '2021-05-09 01:26:25', '2021-05-09 01:26:25'),
(17, 3, '是不是要成功了?', 1, '漂亮的髮夾', '', 666, '', 'auc_20210508192803.jpg', '2021-05-09 01:28:03', '2021-05-09 01:28:03'),
(18, 3, '拜託讓我成功吧', 1, '漂亮的髮夾', '', 5, '', 'auc_20210508192821.jpg', '2021-05-09 01:28:21', '2021-05-09 01:28:21'),
(19, 3, '一定要成功阿', 1, '漂亮的髮夾', '', 6, '', 'auc_20210508192838.jpg', '2021-05-09 01:28:38', '2021-05-09 01:28:38');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '使用者名稱',
  `pwd` char(40) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '使用者密碼',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '姓名',
  `gender` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '性別',
  `phoneNumber` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '手機號碼',
  `birthday` date NOT NULL COMMENT '出生年月日',
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '地址',
  `isActivated` tinyint(1) NOT NULL DEFAULT 1 COMMENT '開通狀況',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='使用者資料表';

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `username`, `pwd`, `name`, `gender`, `phoneNumber`, `birthday`, `address`, `isActivated`, `created_at`, `updated_at`) VALUES
(2, '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '123', '', NULL, '0000-00-00', '', 1, '2021-05-04 03:12:39', '2021-05-04 03:12:39');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 資料表索引 `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- 資料表索引 `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=20;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
