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
