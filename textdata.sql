-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 
-- サーバのバージョン： 10.4.6-MariaDB
-- PHP のバージョン: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `project2019`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `textdata`
--

CREATE TABLE `textdata` (
  `id` int(11) NOT NULL,
  `imageurl` varchar(100) DEFAULT NULL,
  `position` varchar(10) DEFAULT 'left',
  `name` varchar(20) DEFAULT NULL,
  `serif` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `textdata`
--

INSERT INTO `textdata` (`id`, `imageurl`, `position`, `name`, `serif`) VALUES
(1, 'mrhc.png', 'left', '碧棺 左馬刻', '耳かっぽじってよく聴いとけ！！'),
(2, 'mrhc.png', 'left', '碧棺 左馬刻', 'そこのお前……'),
(3, 'mrhc.png', 'left', '碧棺 左馬刻', 'Do you know \"ちゅーる\"？'),
(4, 'illdoc.png', 'right', '神宮寺 寂雷', '命は有限……故に……'),
(5, 'illdoc.png', 'right', '神宮寺 寂雷', 'その意味のない問いに答える刹那が惜しい……'),
(6, 'mrhc.png', 'left', '碧棺 左馬刻', '\"仔猫ちゃん\"すら救えない男に'),
(7, 'mrhc.png', 'left', '碧棺 左馬刻', 'ちゅーるを知る資格もねぇよ KILL KILL KILL ！！');
--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `textdata`
--
ALTER TABLE `textdata`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
