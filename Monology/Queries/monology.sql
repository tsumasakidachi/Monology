-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018 年 2 朁E13 日 23:59
-- サーバのバージョン： 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monology`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `monology`
--

CREATE TABLE `monology` (
  `id` bigint(20) NOT NULL,
  `user_number` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_time` datetime NOT NULL,
  `body` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `monology`
--

INSERT INTO `monology` (`id`, `user_number`, `created_time`, `body`) VALUES
(2, '4f34b3df2cb75', '2016-11-26 16:00:00', '見慣れた道でさえ\r\n季節の光で揺らめく'),
(4, '4f34b3df2cb75', '2016-11-26 17:30:59', '星さえない夜空も夢を描けば\r\n熱いドキドキに不安は消えちゃうから'),
(5, '4f34b3df2cb75', '2016-11-27 18:17:12', 'もっと素晴らしくなれ世界'),
(6, '4f34b3df2cb75', '2016-11-27 18:17:21', '輝きを胸に宿したいから'),
(7, '4f34b3df2cb75', '2016-11-28 17:03:40', '吹きかける命は勝利へのアルペジオ'),
(8, '4f34b3df2cb75', '2016-12-03 19:30:35', 'もう止められない\r\n情熱の勝ちだね\r\n悔やむより走り続けよう\r\n不意に見た空\r\nこんなにも青いよ\r\n大丈夫\r\n諦めないで走るんだ'),
(10, '4f34b3df2cb75', '2016-12-03 21:40:14', '夢を初めて願って今日までどの位経っただろう'),
(11, '4f34b3df2cb75', '2016-12-06 19:25:02', 'もう二度と歩むこと止めない\r\nあなたたちがくれた私だけの道'),
(13, '4f34b3df2cb75', '2016-12-10 00:17:13', '音もなく\r\n気配もなく\r\n静かに運命は変わる'),
(14, '4f34b3df2cb75', '2016-12-12 22:09:00', 'だってその苦しさも未来'),
(15, '4f34b3df2cb75', '2016-12-17 00:17:33', 'いちばんめに大切なことだけを明日も信じて'),
(16, '4f34b3df2cb75', '2017-01-20 23:56:06', '明日よ変われ\r\n希望に変われ\r\n眩しい光に照らされて変われ'),
(17, '4f34b3df2cb75', '2017-02-03 21:35:13', '夢が大きくなるほど試されるだろう\r\n胸の熱さで乗り切れ\r\n僕の温度は熱いから\r\n熱すぎて止まらない\r\n無謀な賭け\r\n勝ちに行こう'),
(18, '4f34b3df2cb75', '2017-02-09 21:00:08', '夢の扉\r\nずっと探し続けて\r\n君と僕とで旅立ったあの季節\r\n青春のプロローグ'),
(19, '4f34b3df2cb75', '2017-02-09 23:57:56', '捜していたのは十二時過ぎの魔法\r\nそれはこの自分の靴で今進んでゆける勇気でしょう'),
(20, '4f34b3df2cb75', '2017-02-12 22:43:13', '悲しみに閉ざされて泣くだけの君じゃない\r\n熱い胸\r\nきっと未来を切り開くはずさ'),
(21, '4f34b3df2cb75', '2017-02-24 15:01:25', '終わらない my song'),
(22, '4f34b3df2cb75', '2017-02-24 19:20:49', '風に乗って流れる私たちの今は\r\nどんな国\r\nどんな世界へ行けるんだろう'),
(23, '4f34b3df2cb75', '2017-05-06 00:34:20', '狙い定めた指先がさす運命は\r\n絶望それとも希望'),
(24, '4f34b3df2cb75', '2017-05-18 20:46:18', '悔しくて寝れなくて暗い夜の\r\n夜明けは近い'),
(25, '4f34b3df2cb75', '2017-05-29 21:58:46', '生きてゆくことの果てしない不安に身を震わせる僕の傍らで\r\n透明な君の言葉と笑顔が静かに答える'),
(26, '4f34b3df2cb75', '2017-05-29 22:15:09', '月日の流れに\r\n何もかもが形を変えていくけど\r\n信じあう\r\nこの気持ちだけは変わらない\r\nいつまでも'),
(27, '4f34b3df2cb75', '2017-06-19 20:51:57', '悔しさを受け止めて描いた世界への旅はやっと青春の始まり'),
(28, '4f34b3df2cb75', '2017-06-19 23:35:37', 'かけがえない僕と似た君は\r\n一人でも大丈夫だから\r\nただ前を見て広がる道を走るんだ'),
(29, '4f34b3df2cb75', '2017-07-14 00:29:02', '未完成な昨日から始まる今日は\r\n何にでもなれる未来へとつながってる'),
(31, '4f34b3df2cb75', '2017-07-18 15:44:52', '月曜日が町にやってくる\r\nみんなと一緒にやってくる\r\n\r\nニューストーリー携えて\r\nニューフェイスな私に\r\nさあアップデート'),
(32, '4f34b3df2cb75', '2017-07-18 16:54:42', '月日の流れに何もかもが形を変えていくけど\r\n信じあう\r\nこの気持ちだけは変わらない\r\nいつまでも'),
(33, '4f34b3df2cb75', '2017-07-18 19:15:12', '時が経つのは早いもので\r\n別れの季節が顔を出す\r\n積み上げてきたものがやけに涙を誘うんだ\r\n\r\n青い春が今幕を閉じ\r\n桜が散る音は静かで\r\n切ない思いが押し寄せた\r\nさよならの夕焼け'),
(34, '4f34b3df2cb75', '2017-07-19 11:57:52', '努力はそんなに実らない\r\nでもちょっぴりいいことありそう'),
(35, '4f34b3df2cb75', '2017-07-19 18:25:48', '目が前に付いてるのは前だけを見て生きろと与えられた使命に違いない'),
(36, '4f34b3df2cb75', '2017-07-19 20:33:08', '今というこの瞬間\r\n何だって音楽にできたらいいのに'),
(37, '4f34b3df2cb75', '2017-07-20 00:43:29', '曇りない\r\n濁りのない\r\nあたしのサウンドスケープ'),
(38, '4f34b3df2cb75', '2017-08-13 01:30:10', '今はまだちっぽけなつぼみだから\r\nいつの日かたとえ名もない花としても咲き誇るつもりさ\r\n愛する君のために'),
(39, '4f34b3df2cb75', '2017-08-17 01:16:22', '拝啓\r\nちょっと未来の私\r\nちゃんと夢は叶ったかい\r\n答えなくたって知ってるよ\r\nだから進め\r\n前に'),
(40, '4f34b3df2cb75', '2017-09-07 17:57:36', '夢よりも綺麗に\r\nさあ咲け'),
(41, '4f34b3df2cb75', '2017-10-21 00:41:54', '熱い熱い期待の中で僕たちは喜びを歌おう\r\n同じ思い感じてみてよ\r\n限られた時間を楽しもうよ\r\nもう止められない\r\n情熱の勝ちだね\r\n悔やむより走り続けよう\r\n不意に見た空\r\nこんなにも青いよ\r\n大丈夫\r\n諦めないで走るんだ'),
(42, '4f34b3df2cb75', '2017-10-21 01:04:33', '夢を追えばいつも傷つくことばかり\r\n置き去りにしたままどこか遠く逃げてしまえば\r\nだけど君が信じてくれた\r\nきっとできると\r\nだからもう僕はもう迷わない'),
(43, '4f34b3df2cb75', '2017-12-23 21:08:12', '夢は消えない\r\n夢は消えない'),
(44, '4f34b3df2cb75', '2018-01-02 00:33:40', 'たとえ雨降りで花は散って\r\n緑の葉色づいて\r\n冬の風に凍えそうでも\r\n辛いこと\r\nやめたいこと\r\n数えきれない涙も\r\n次の春を待つ\r\nつぼみに変わる\r\nほら負けないで'),
(45, '4f34b3df2cb75', '2018-01-02 01:16:52', 'そうさ\r\nday by day 少しずつ\r\none by one 花開く\r\n新しい期待が膨らんでゆく\r\nday by day いつの日か\r\ngo my way 私色\r\n夢よりも綺麗に\r\nさあ咲け'),
(46, '4f34b3df2cb75', '2018-01-07 16:41:25', '輝く命燃やしてかざす想い sympathy'),
(47, '4f34b3df2cb75', '2018-02-04 21:07:35', '素晴らしい世界…\r\n素晴らしき世界');

-- --------------------------------------------------------

--
-- テーブルの構造 `sessions`
--

CREATE TABLE `sessions` (
  `user_number` varchar(13) CHARACTER SET utf8 NOT NULL,
  `created_time` datetime DEFAULT NULL,
  `session` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_lifetime` datetime NOT NULL,
  `refresh_token` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refresh_token_lifetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `sessions`
--

INSERT INTO `sessions` (`user_number`, `created_time`, `session`, `session_lifetime`, `refresh_token`, `refresh_token_lifetime`) VALUES
('4f34b3df2cb75', '2018-02-13 23:34:16', '601af17c3380e3620e2b43b5b9295d1cd8edfa234d3c0dec88dad2bf6482b5831cb1376f41a2b87c423a355c61a7c44bf8d9ea4d09eb3b2732c96786c6acfb18', '2018-02-13 23:39:16', '2426115f0e27eade073a5d05337516e0a692c5b86940419c516d60a8f072c53369cdaa43b473eeb2d2553c618e3f89579ee541842ee994a898fc82e86e8b9e79', '2018-02-20 23:34:16');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `number` varchar(13) CHARACTER SET utf8 NOT NULL,
  `id` varchar(20) CHARACTER SET utf8 NOT NULL,
  `display_name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `mail_address` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `registrated_day` datetime DEFAULT NULL,
  `pass` varchar(128) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`number`, `id`, `display_name`, `mail_address`, `registrated_day`, `pass`) VALUES
('4f34b3df2cb75', 'mzzww', 'Mizuiro Andante', NULL, NULL, 'c164f9ad5492be16d10428a711f4c25b5260e38e5c06f1cff0075ad8f5be904b1d3953b7b936fbf5389cddd346950d2717527f570664a19fdec834ff4e042dab');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `monology`
--
ALTER TABLE `monology`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `monology`
--
ALTER TABLE `monology`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
