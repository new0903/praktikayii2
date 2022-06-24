-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 18 2022 г., 07:18
-- Версия сервера: 8.0.27
-- Версия PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `student1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1654665335),
('m140506_102106_rbac_init', 1654665344),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1654665344),
('m180523_151638_rbac_updates_indexes_without_prefix', 1654665345),
('m200409_110543_rbac_update_mssql_trigger', 1654665345);

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `data` datetime NOT NULL,
  `file` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`id`, `name`, `phone`, `email`, `text`, `data`, `file`) VALUES
(12, 'админ', '123123', 'mail@mail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et\r\n                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip\r\n                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu\r\n                    fugiat nulla pariatur.', '2022-05-31 13:24:49', 'Характеристика(1).docx'),
(13, 'Гость', '89999999999', 'mail@mail.com', 'If you have business inquiries or other questions, please fill out the following form to contact us.\r\n            Thank you. Площадка для разработки\r\n\r\nHTTP\r\n\r\nhttp://student1-test.2204535.ru\r\n\r\nFTP\r\n\r\n95.213.131.52student1\r\nT9u4U#6y2$\r\n\r\nMysql\r\n\r\nHost: localhost\r\nUser: student1\r\nDbname: student1\r\nPassword: 4E3l5F9y$\r\n\r\n\r\nЗадача\r\n\r\nРеализация на Yii2-basic.\r\n\r\nДокументация в помощь https://www.yiiframework.com/doc/guide/2.0/ru\r\n\r\nЗадача модуль Обратной связи\r\n\r\n\r\nАдминистративный раздел:\r\n\r\n\r\nВ административном разделе сделать разделение не модули разделы: Настройки, Администраторы, Обращения\r\n\r\n1) Вход по логину и паролю\r\n\r\n2) Список обращений:\r\n\r\n- В списке ФИО и телефон и дата и время обращения\r\n\r\n- Постраничная навигация, 10 элементов на странице по умолчанию  (возможность изменить на 10/20/50/100 элементов), сортировка по дате / фио / телефону в обе стороны- Поиск по ФИО и email и телефону\r\n\r\n3) Просмотр обращения (без редактирования):\r\n- Дата и время создания обращения\r\n- ФИО\r\n- Телефон\r\n- Email\r\n- Текст обращения\r\n- Файл приложенный\r\n4) Настройки\r\nРедактирование логина / пароля входа в админку\r\nТребование к логину - только англ прописные буквы и цифры\r\nТребования  к паролю - должен быть не менее 10  символов в длину и обязательно  состоять из строчных и прописных  латинских букв, символов подчеркивания  и цифр\r\nEmail куда отправлять сообщения\r\nПубличный раздел:\r\n\r\n1) Форма обратного обращения:\r\n- ФИО\r\n- Телефон (валидация на фронте и бэкендк на то, что это точно телефон)\r\n- Email (валидация на фронте и бэкенде на то, что это точно email)\r\n- Приложить файл (формат doc, pdf, zip, размер не более 1 Мб, проверка на бэке)\r\n- Текст обращения\r\n- Captcha любая\r\n- Отправка сообщения на почту из настроек вместе с вложенным файлом\r\nДополнительное задание\r\nВ административном разделе вместо настроек сделать модуль управления пользователями.\r\n3. Список пользователей\r\nАдминистративный раздел:\r\n1) Вход по логину и паролю пользователя.\r\n2) В шапке если пользователь не авторизован показывать - Гость, а если авторизован - ФИО пользователя.\r\n2) Список пользователей:\r\n- В списке ФИО и логин\r\n- Постраничная навигация\r\n- Поиск по ФИО и логину\r\n3) Изменение детального пользователь:\r\n- Дата и время создания пользователя\r\n- email (валидация с бэкенда на то, что это точно email)\r\n- логин (валидация с бэкенда на то, что это точно логин и он корректен)\r\n-  пароль (при открытие страницы пуст. Если сохраняют в таком виде -  пароль не должен записывать пустоту. Если заполняют - проверять  идентичен ли он с подтверждением пароля)\r\n- подтверждение пароля\r\n- ФИО\r\n', '2022-06-01 06:14:16', 'задание 2.docx'),
(14, 'тест', '89998887755', 'mail@mail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et\r\n                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip\r\n                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu\r\n                    fugiat nulla pariatur.', '2022-06-03 04:58:36', 'задание(1).docx'),
(15, 'Тест123', '89998887755', 'mail@mail.com', 'Тестовое сообщение на почту', '2022-06-09 07:31:17', ''),
(16, 'Тест123', '89998887755', 'mail@mail.com', 'Тестовое сообщение', '2022-06-09 07:37:57', 'Характеристика(2).docx'),
(17, 'Тест123', '89998887755', 'mail@mail.com', '1232134432 ткст', '2022-06-09 07:46:26', ''),
(18, 'Тест123', '89998887755', 'mail@mail.com', 'бла бла бла', '2022-06-09 07:48:55', ''),
(19, 'обращение от пользователя', '89998887755', 'mail@mail.com', 'я жалуюсь на что то там', '2022-06-15 07:31:00', 'Индивидуальное задание.docx'),
(20, 'Новое обращение от пользователя', '89998887755', 'mail@mail123.com', '28 что то там перенесли на 26 ', '2022-06-17 04:59:47', 'Характеристика(4).docx');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `name`, `email`, `created_at`) VALUES
(0, 'admin3', 'admin', 'Жмышенко Валерий Альбертович', NULL, '2022-06-06'),
(1, 'demo', '$2y$13$oQZqTIS/kMjiNuoOO2O9Gu.vNOrqTwWHPSyO9JVdMaVgqqeQgRaEW', 'Тест1234', 'mail@mail123.com', '2022-06-17'),
(2, 'admin1', 'MagicU1scale', 'тест', 'mail@mail.com', '2022-06-06'),
(3, 'Guest', 'Guest', 'Гость', NULL, '2022-06-06');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
