-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 07 2023 г., 20:01
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `musicnow`
--

-- --------------------------------------------------------

--
-- Структура таблицы `albums`
--

CREATE TABLE `albums` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year NOT NULL,
  `artist_id` int NOT NULL,
  `genre_id` int UNSIGNED DEFAULT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `albums`
--

INSERT INTO `albums` (`id`, `name`, `year`, `artist_id`, `genre_id`, `cover`) VALUES
(1, 'Suffer', 2020, 1, 1, 'first.png'),
(2, 'ESI', 2021, 2, 2, 'second.jfif'),
(3, 'SHAMELESS $UICIDE', 2023, 3, 1, 'third.jfif'),
(4, 'Freddie\'s Inferno', 2022, 1, 1, 'fourth.jfif'),
(5, 'Spy on the Wall', 2022, 2, 2, 'fifth.jfif'),
(6, 'Stop Staring at the Shadows', 2020, 3, 1, 'sixth.jfif'),
(7, 'FromBeyondTheGrave', 2020, 4, 2, 'seventh.jfif'),
(8, 'Starboy', 2016, 5, 3, 'eighth.jfif'),
(9, 'Are You Afraid of the Danger Boys?', 2016, 6, 2, 'ninth.jfif'),
(15, 'FORGOTTEN', 2022, 12, 7, 'album_6457d3669b8025.94217759.png'),
(16, 'Co\'N\'Dorn', 2012, 13, 8, 'album_6457d6b6c04218.51777489.png');

-- --------------------------------------------------------

--
-- Структура таблицы `artists`
--

CREATE TABLE `artists` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `artist_cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `artists`
--

INSERT INTO `artists` (`id`, `name`, `artist_cover`) VALUES
(1, 'Freddie Dredd', 'first.jpg'),
(2, 'Slater', 'second.png'),
(3, '$uicideboy$', 'third.jpg'),
(4, 'BONES', 'fourth.png'),
(5, 'The Weeknd', 'fifth.jfif'),
(6, 'Danger Incorporated', 'sixth.jfif'),
(12, 'LXST CXNTURY', 'image 2 (1).png'),
(13, 'Иван Дорн', '8e342a0c7602b7b370349f33e1643ba0.webp');

-- --------------------------------------------------------

--
-- Структура таблицы `favorite_tracks`
--

CREATE TABLE `favorite_tracks` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `track_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `favorite_tracks`
--

INSERT INTO `favorite_tracks` (`id`, `user_id`, `track_id`) VALUES
(80, 16, 55),
(83, 16, 2),
(84, 16, 3),
(85, 16, 10),
(86, 16, 8),
(87, 16, 7),
(88, 16, 6),
(89, 16, 5),
(90, 16, 4),
(91, 16, 9),
(92, 16, 1),
(94, 17, 24),
(95, 17, 25),
(96, 17, 26),
(97, 17, 27),
(98, 17, 28);

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Hip Hop'),
(2, 'Rap'),
(3, 'R&B'),
(7, 'Phonk'),
(8, 'Pop');

-- --------------------------------------------------------

--
-- Структура таблицы `playlists`
--

CREATE TABLE `playlists` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `playlists`
--

INSERT INTO `playlists` (`id`, `user_id`, `name`, `description`, `image`) VALUES
(112, 16, 'chill.', 'relax tracks', 'assets/playlists/122ejt.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `playlists_tracks`
--

CREATE TABLE `playlists_tracks` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `track_id` int NOT NULL,
  `playlist_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `playlists_tracks`
--

INSERT INTO `playlists_tracks` (`id`, `user_id`, `track_id`, `playlist_id`) VALUES
(35, 16, 19, 112),
(37, 16, 20, 112),
(39, 16, 23, 112),
(40, 16, 9, 112),
(41, 16, 22, 112),
(42, 16, 91, 112);

-- --------------------------------------------------------

--
-- Структура таблицы `tracks`
--

CREATE TABLE `tracks` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `album_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tracks`
--

INSERT INTO `tracks` (`id`, `name`, `duration`, `file_path`, `album_id`) VALUES
(1, 'Darko', '1:49', 'FreddieDredd_Darko.mp3', 1),
(2, 'Speak Up', '1:54', 'FreddieDredd_SpeakUp.mp3', 1),
(3, 'Necklace', '1:51', 'FreddieDredd_Necklace.mp3', 1),
(4, 'Tool', '1:37', 'FreddieDredd_Tool.mp3', 1),
(5, 'Blow', '1:41', 'FreddieDredd_Blow.mp3', 1),
(6, 'Stunna', '1:28', 'FreddieDredd_Stunna.mp3', 1),
(7, 'Delete', '1:04', 'FreddieDredd_Delete.mp3', 1),
(8, 'Devil\'s Work', '2:06', 'FreddieDredd_Devils_Work.mp3', 1),
(9, 'WTH', '1:40', 'FreddieDredd_WTH.mp3', 1),
(10, 'Knot Myself', '1:48', 'FreddieDredd_Knot_Myself.mp3', 1),
(11, 'ESI', '2:28', 'Slater_ESI.mp3', 2),
(12, 'Sp33din\'', '2:34', 'Slater_Sp33din\'.mp3', 2),
(13, 'Swallowed My Key', '2:24', 'Slater_Swallowed_My_Key.mp3', 2),
(14, 'Skittle on my Wrist', '1:58', 'Slater_Skittle_on_my_Wrist.mp3', 2),
(15, 'My Craft', '2:15', 'Slater_My_Craft.mp3', 2),
(16, 'Brainiac', '2:43', 'Slater_Brainiac.mp3', 2),
(17, 'Trix', '2:30', 'Slater_(feat. Enjoy)_Trix.mp3', 2),
(18, 'SHAMELESS $UICIDE', '4:03', '$uicideboy$_SHAMELESS_$UICIDE.mp3', 3),
(19, 'Whole Lotta Grey', '3:06', '$uicideboy$_Whole_Lotta_Grey.mp3', 3),
(20, 'Gutter Bravado', '2:27', '$uicideboy$_Gutter_Bravado.mp3', 3),
(21, 'Went to Rehab and All I Got Was This Lousy T-Shirt', '2:03', '$uicideboy$_Went_to_Rehab_and_All_I_Got_Was_This_Lousy_T_Shirt.mp3', 3),
(22, 'Six Lines, Two Dragons, and a Messiah', '2:46', '$uicideboy$_Six_Lines_Two_Dragons_and_a_Messiah.mp3', 3),
(23, 'Big Shot Cream Soda', '3:16', '$uicideboy$_Big_Shot_Cream_Soda.mp3', 3),
(24, 'Limbo', '2:50', 'FreddieDredd_Limbo.mp3', 4),
(25, 'Lust', '2:02', 'FreddieDredd_Lust.mp3', 4),
(26, 'Gluttony', '1:53', 'FreddieDredd_Gluttony.mp3', 4),
(27, 'Greed', '2:22', 'FreddieDredd_Greed.mp3', 4),
(28, 'Wrath', '1:54', 'FreddieDredd_Wrath.mp3', 4),
(29, 'Pull The Trigger', '1:45', 'FreddieDredd_Pull_The_Trigger.mp3', 4),
(30, 'Hersey', '1:05', 'Freddie_Dredd_Heresy.mp3', 4),
(31, 'Violence', '1:55', 'FreddieDredd_Violence.mp3', 4),
(32, 'Fraud', '1:52', 'FreddieDredd_Fraud.mp3', 4),
(33, 'Treachery', '2:01', 'FreddieDredd_Treachery.mp3', 4),
(34, 'Regardless', '2:17', 'FreddieDredd_Regardless.mp3', 4),
(35, 'Tip Toe', '2:01', 'FreddieDredd_Tip_Toe.mp3', 4),
(36, 'Want', '1:48', 'FreddieDredd_Want.mp3', 4),
(37, 'Kick Rocks', '2:52', 'FreddieDredd_Kick_Rocks.mp3', 4),
(38, 'I Don\'t Really Care', '2:17', 'Slater_I_Don\'t_Really_Care.mp3', 5),
(39, 'Dancefloor (Full of Nothing)', '2:16', 'Slater_Dancefloor_Full_of_Nothing.mp3', 5),
(40, 'LA Dystopian NPC Vibes', '3:06', 'Slater_LA_Dystopian_NPC_Vibes.mp3', 5),
(41, 'Some Like it Cold', '3:02', 'Slater_Some_Like_it_Cold.mp3', 5),
(42, 'City-State', '2:40', 'Slater_City_State.mp3', 5),
(43, 'All Dogs Go To Heaven', '2:34', '$uicideboy$_All_Dogs_Go_To_Heaven.mp3', 6),
(44, 'I Wanna Be Romanticized', '2:13', '$uicideboy$_I_Wanna_Be_Romanticized.mp3', 6),
(45, 'One Last Look at the Damage', '1:37', '$uicideboy$_One_Last_Look_at_the_Damage.mp3', 6),
(46, '[whispers Indistinctly]', '2:44', '$uicideboy$_whispers_Indistinctly.mp3', 6),
(47, 'Mega Zeph', '1:41', '$uicideboy$_Mega_Zeph.mp3', 6),
(48, 'Putrid Pride', '1:47', '$uicideboy$_Putrid_Pride.mp3', 6),
(49, 'That Just Isn\'t Empirically Possible', '2:03', '$uicideboy$_That_Just_Isn\'t_Empirically_Possible.mp3', 6),
(50, 'What the Fuck is Happening', '1:46', '$uicideboy$_What_the_Fuck_is_Happening.mp3', 6),
(51, 'Bizarro', '3:34', '$uicideboy$_Bizarro.mp3', 6),
(52, 'Scope Set', '1:59', '$uicideboy$_Scope_Set.mp3', 6),
(53, 'Fuck Your Culture', '1:42', '$uicideboy$_Fuck_Your_Culture.mp3', 6),
(54, '...And to Those I Love, Thanks for Sticking Around', '2:48', '$uicideboy$_And_to_Those_I_Love_Thanks_for_Sticking_Around.mp3', 6),
(55, 'FromBeyondTheGrave', '0:50', 'Bones_FromBeyondTheGrave.mp3', 7),
(56, 'Ashes', '2:00', 'Bones_Ashes.mp3', 7),
(57, '2Stroke', '1:52', 'Bones_2Stroke.mp3', 7),
(58, 'Equipped', '1:54', 'Bones_Equipped.mp3', 7),
(59, '.223', '2:10', 'Bones_223.mp3', 7),
(60, 'WhoGoesThere', '2:20', 'Bones_WhoGoesThere.mp3', 7),
(61, 'BarbwireRibCage', '2:48', 'Bones_BarbwireRibCage.mp3', 7),
(62, 'TombstoneKiller', '2:04', 'Bones_TombstoneKiller.mp3', 7),
(63, 'SkeletonRaps', '2:10', 'Bones_SkeletonRaps.mp3', 7),
(64, 'RedAlert', '2:12', 'Bones_RedAlert.mp3', 7),
(65, 'Cement', '1:57', 'Bones_Cement.mp3', 7),
(66, 'DarkShadowBlunts', '2:08', 'Bones_DarkShadowBlunts.mp3', 7),
(67, 'Starboy', '3:50', 'The_Weeknd_Daft_Punk_Starboy.mp3', 8),
(68, 'Party Monster', '4:09', 'The_Weeknd_Party_Monster.mp3', 8),
(69, 'False Alarm', '3:40', 'The_Weeknd_False_Alarm.mp3', 8),
(70, 'Reminder', '3:38', 'The_Weeknd_Reminder.mp3', 8),
(71, 'Rockin\'', '3:52', 'The_Weeknd_Rockin.mp3', 8),
(72, 'Secrets', '4:25', 'The_Weeknd_Secrets.mp3', 8),
(73, 'True Colors', '3:26', 'The_Weeknd_True_Colors.mp3', 8),
(74, 'Stargirl Interlude', '1:51', 'Lana_Del_Rey_The_Weeknd_Stargirl_Interlude.mp3', 8),
(75, 'Sidewalks', '3:51', 'The_Weeknd_Kendrick_Lamar_Sidewalks.mp3', 8),
(76, 'Six Feet Under', '3:57', 'The_Weeknd_Six_Feet_Under.mp3', 8),
(77, 'Love To Lay', '3:43', 'The_Weeknd_Love_To_Lay.mp3', 8),
(78, 'A Lonely Night', '3:40', 'The_Weeknd_A_Lonely_Night.mp3', 8),
(79, 'Attention', '3:17', 'The_Weeknd_Attention.mp3', 8),
(80, 'Ordinary Life', '3:41', 'The_Weeknd_Ordinary_Life.mp3', 8),
(81, 'Nothing Without You', '3:18', 'The_Weeknd_Nothing_Without_You.mp3', 8),
(82, 'All I Know', '5:21', 'The_Weeknd_Future_All_I_Know.mp3', 8),
(83, 'Die For You', '4:20', 'The_Weeknd_Die_For_You.mp3', 8),
(84, 'I Feel It Coming', '4:29', 'The_Weeknd_Daft_Punk_I_Feel_It_Coming.mp3', 8),
(85, 'Lay Down', '1:14', 'danger-incorporated-lay-down.mp3', 9),
(86, 'Diamonds', '4:11', 'danger-incorporated-diamonds.mp3', 9),
(87, 'Graveyard', '2:47', 'danger-incorporated-graveyard-ft-yung-ghoul.mp3', 9),
(88, 'Forever', '3:40', 'danger-incorporated-forever.mp3', 9),
(89, 'Love on the Internet', '3:23', 'danger-incorporated-love-on-the-internet-ft-larry-league.mp3', 9),
(90, 'Golden', '3:09', 'danger-incorporated-golden.mp3', 9),
(91, 'A Danger Boy Never Dies', '3:30', 'danger-incorporated-a-danger-boy-never-dies.mp3', 9),
(99, 'CATHARSIS', '2:38', 'LXST CXNTURY - CATHARSIS.mp3', 15),
(100, 'LIBERTY', '3:25', 'LXST CXNTURY - LIBERTY.mp3', 15),
(101, 'GRIM', '2:56', 'LXST CXNTURY - GRIM.mp3', 15),
(102, 'VHS', '2:00', 'LXST CXNTURY - VHS.mp3', 15),
(103, 'BULLET', '2:35', 'LXST CXNTURY - BULLET.mp3', 15),
(104, 'DIRTY PLANET', '2:15', 'LXST CXNTURY - DIRTY PLANET.mp3', 15),
(105, 'LOOK AT THE DEVIL', '2:02', 'LXST CXNTURY - LOOK AT THE DEVIL.mp3', 15),
(106, 'NO HOPE', '1:31', 'LXST CXNTURY - NO HOPE.mp3', 15),
(107, 'EXECUTIONER', '1:55', 'LXST CXNTURY - EXECUTIONER.mp3', 15),
(108, 'GRAVE', '2:24', 'LXST CXNTURY - GRAVE.mp3', 15),
(109, 'Оуе пахатам', '1:23', 'Ivan_Dorn_Oue_pakhatam.mp3', 16),
(110, 'Бигуди', '4:51', 'Ivan_Dorn_-_Bigudi_(ru.muzikavsem.org).mp3', 16),
(111, 'Тем Более', '2:45', 'Ivan_Dorn_-_Tem_bolee_(ru.muzikavsem.org).mp3', 16),
(112, 'Ненавижу', '3:40', 'Ivan_Dorn_-_Nenavizhu_(ru.muzikavsem.org).mp3', 16),
(113, 'Школьное окно', '3:27', 'Ivan_Dorn_-_SHkolnoe_okno_(ru.muzikavsem.org).mp3', 16),
(114, 'Северное сияние', '4:47', 'Ivan_Dorn_-_Severnoe_siyanie_(ru.muzikavsem.org).mp3', 16),
(115, 'Так сильно', '3:58', 'Ivan_Dorn_-_Tak_silno_(ru.muzikavsem.org).mp3', 16),
(116, 'Кричу', '2:45', 'Ivan_Dorn_-_Krichu_(ru.muzikavsem.org).mp3', 16),
(117, 'Стыцамэн', '3:52', 'Ivan_Dorn_-_Stycamjen_(ru.muzikavsem.org).mp3', 16),
(118, 'СЖК', '3:33', 'Ivan_Dorn_-_SZHK_(ru.muzikavsem.org).mp3', 16),
(119, 'Идолом', '3:43', 'Ivan_Dorn_-_Idolom_(ru.muzikavsem.org).mp3', 16),
(120, '???', '8:03', 'Ivan_Dorn_-__(ru.muzikavsem.org).mp3', 16),
(121, 'Город', '3:41', 'Ivan_Dorn_-_Gorod_(ru.muzikavsem.org).mp3', 16),
(122, 'Стайлооо', '1:30', 'Ivan_Dorn_-_Stajjlooo_(ru.muzikavsem.org).mp3', 16);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `premium` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `avatar`, `premium`) VALUES
(16, 'peter', '$2y$10$HC4g7wk08ZujrZ5DcS76leqbV/zK55D5jGfqoQ9/xxMBsi7ReC.Ne', 'peter@mail.ru', 'fifth.png', 1),
(17, '$2y$10$0H', '$2y$10$0HCdukIp5e9hgMwp5qrT1.R9oVkuY9WciHpYVC1qQcYmUkQitTju2', 'admin@mail.ru', 'user_avatar.svg', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artist_id` (`artist_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Индексы таблицы `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `favorite_tracks`
--
ALTER TABLE `favorite_tracks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `track_id` (`track_id`);

--
-- Индексы таблицы `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `playlists_tracks`
--
ALTER TABLE `playlists_tracks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `track_id` (`track_id`),
  ADD KEY `playlist_id` (`playlist_id`);

--
-- Индексы таблицы `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album_id` (`album_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `favorite_tracks`
--
ALTER TABLE `favorite_tracks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT для таблицы `playlists_tracks`
--
ALTER TABLE `playlists_tracks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT для таблицы `tracks`
--
ALTER TABLE `tracks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`),
  ADD CONSTRAINT `albums_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`);

--
-- Ограничения внешнего ключа таблицы `favorite_tracks`
--
ALTER TABLE `favorite_tracks`
  ADD CONSTRAINT `favorite_tracks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `favorite_tracks_ibfk_2` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`id`);

--
-- Ограничения внешнего ключа таблицы `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `playlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `playlists_tracks`
--
ALTER TABLE `playlists_tracks`
  ADD CONSTRAINT `playlists_tracks_ibfk_1` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`id`),
  ADD CONSTRAINT `playlists_tracks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `playlists_tracks_ibfk_3` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`id`);

--
-- Ограничения внешнего ключа таблицы `tracks`
--
ALTER TABLE `tracks`
  ADD CONSTRAINT `tracks_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
