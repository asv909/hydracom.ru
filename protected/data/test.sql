-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 30 2012 г., 09:48
-- Версия сервера: 5.5.16
-- Версия PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Бренда',
  `name` varchar(45) NOT NULL COMMENT 'Бренд',
  `manager_id` tinyint(3) unsigned NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_brand_manager` (`manager_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `brand`
--

INSERT INTO `brand` (`id`, `name`, `manager_id`, `ts`) VALUES
(1, 'Hiflex', 1, '2012-04-18 12:16:27'),
(2, 'Polarputki', 1, '2012-04-18 12:16:27');

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Города',
  `name` varchar(45) NOT NULL COMMENT 'Город',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(1, 'Выборг');

-- --------------------------------------------------------

--
-- Структура таблицы `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Страны',
  `name` varchar(45) NOT NULL DEFAULT 'ЕС' COMMENT 'Страна',
  `manager_id` tinyint(3) unsigned NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_country_manager` (`manager_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `country`
--

INSERT INTO `country` (`id`, `name`, `manager_id`, `ts`) VALUES
(1, 'ЕС', 1, '2012-04-18 12:16:27');

-- --------------------------------------------------------

--
-- Структура таблицы `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Клиента',
  `customer` varchar(45) NOT NULL COMMENT 'Название Фирмы',
  `org_id` tinyint(3) unsigned NOT NULL,
  `inn` varchar(12) NOT NULL COMMENT 'ИНН',
  `kpp` char(9) NOT NULL COMMENT 'КПП',
  `post_id` smallint(5) unsigned NOT NULL,
  `region_id` tinyint(3) unsigned NOT NULL,
  `city_id` smallint(5) unsigned NOT NULL,
  `address` varchar(75) NOT NULL COMMENT 'Юр.Адрес',
  `phone` char(11) NOT NULL COMMENT 'Телефон',
  PRIMARY KEY (`id`),
  UNIQUE KEY `inn_UNIQUE` (`inn`,`customer`),
  KEY `fk_customer_org` (`org_id`),
  KEY `fk_customer_post` (`post_id`),
  KEY `fk_customer_region` (`region_id`),
  KEY `fk_customer_city` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `customer`
--

INSERT INTO `customer` (`id`, `customer`, `org_id`, `inn`, `kpp`, `post_id`, `region_id`, `city_id`, `address`, `phone`) VALUES
(1, 'АЛНЭТ', 1, '4704042269', '470401001', 1, 47, 1, 'ул.Большая каменная, д.7, кв.29', '813-7852037');

-- --------------------------------------------------------

--
-- Структура таблицы `group1`
--

CREATE TABLE IF NOT EXISTS `group1` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Группы (1)',
  `name` varchar(45) NOT NULL COMMENT 'Название Группы (1)',
  `imgref` varchar(45) DEFAULT NULL COMMENT 'Ссылка на изображение',
  `manager_id` tinyint(3) unsigned NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_group1_manager` (`manager_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `group1`
--

INSERT INTO `group1` (`id`, `name`, `imgref`, `manager_id`, `ts`) VALUES
(1, 'Компоненты гидравлических систем', NULL, 1, '2012-04-18 12:16:27');

-- --------------------------------------------------------

--
-- Структура таблицы `group2`
--

CREATE TABLE IF NOT EXISTS `group2` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Группы (2)',
  `name` varchar(45) NOT NULL COMMENT 'Название Группы (2)',
  `imgref` varchar(45) DEFAULT NULL COMMENT 'Ссылка на изображение',
  `group1_id` tinyint(3) unsigned NOT NULL,
  `manager_id` tinyint(3) unsigned NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_group2_manager` (`manager_id`),
  KEY `fk_group2_group1` (`group1_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `group2`
--

INSERT INTO `group2` (`id`, `name`, `imgref`, `group1_id`, `manager_id`, `ts`) VALUES
(1, 'Трубы гидравлические по DIN 2391', NULL, 1, 1, '2012-04-18 12:16:27'),
(2, 'Соединения гидравлические', NULL, 1, 1, '2012-04-18 12:16:27');

-- --------------------------------------------------------

--
-- Структура таблицы `group3`
--

CREATE TABLE IF NOT EXISTS `group3` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Группы (3)',
  `name` varchar(45) NOT NULL COMMENT 'Название Группы (3)',
  `comment` varchar(255) DEFAULT NULL COMMENT 'Комментарий',
  `imgref` varchar(45) DEFAULT NULL COMMENT 'Ссылка на изображение',
  `group2_id` tinyint(3) unsigned NOT NULL,
  `manager_id` tinyint(3) unsigned NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_group3_manager` (`manager_id`),
  KEY `fk_group3_group2` (`group2_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `group3`
--

INSERT INTO `group3` (`id`, `name`, `comment`, `imgref`, `group2_id`, `manager_id`, `ts`) VALUES
(1, 'Оцинкованные', 'Марка стали: ST 37,4; D - внешний диаметр; t - толщина стенки; Pmax -  максимальное рабочее давление;', NULL, 1, 1, '2012-04-18 12:16:27'),
(2, 'Из нержавеющей стали', NULL, NULL, 1, 1, '2012-04-18 12:16:27'),
(3, 'Фосфатированные (черные)', NULL, NULL, 1, 1, '2012-04-18 12:16:27');

-- --------------------------------------------------------

--
-- Структура таблицы `group4`
--

CREATE TABLE IF NOT EXISTS `group4` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Группы (4)',
  `name` varchar(45) NOT NULL COMMENT 'Название Группы (4)',
  `comment` varchar(255) DEFAULT NULL COMMENT 'Комментарий',
  `imgref` varchar(45) DEFAULT NULL COMMENT 'Ссылка на изображение',
  `group3_id` smallint(5) unsigned NOT NULL,
  `manager_id` tinyint(3) unsigned NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_group4_manager` (`manager_id`),
  KEY `fk_group4_group3` (`group3_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `group5`
--

CREATE TABLE IF NOT EXISTS `group5` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Группы (5)',
  `name` varchar(45) NOT NULL COMMENT 'Название Группы (5)',
  `comment` varchar(255) DEFAULT NULL COMMENT 'Комментарий',
  `imgref` varchar(45) DEFAULT NULL COMMENT 'Ссылка на изображение',
  `group4_id` smallint(5) unsigned NOT NULL,
  `manager_id` tinyint(3) unsigned NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_group5_manager` (`manager_id`),
  KEY `fk_group5_group4` (`group4_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `group6`
--

CREATE TABLE IF NOT EXISTS `group6` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Группы (6)',
  `name` varchar(45) NOT NULL COMMENT 'Название Группы (6)',
  `comment` varchar(255) DEFAULT NULL COMMENT 'Комментарий',
  `imgref` varchar(45) DEFAULT NULL COMMENT 'Ссылка на изображение',
  `group5_id` smallint(5) unsigned NOT NULL,
  `manager_id` tinyint(3) unsigned NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_group6_manager` (`manager_id`),
  KEY `fk_group6_group5` (`group5_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `manager`
--

CREATE TABLE IF NOT EXISTS `manager` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Менеджера',
  `surname` varchar(25) NOT NULL COMMENT 'Фамилия',
  `name` varchar(25) NOT NULL COMMENT 'Имя',
  `middlename` varchar(25) DEFAULT NULL COMMENT 'Отчество',
  `login` varchar(20) NOT NULL COMMENT 'Логин',
  `hash` char(40) NOT NULL COMMENT 'Пароль',
  `salt` char(23) NOT NULL,
  `mangroup_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  KEY `fk_manager_mangroup` (`mangroup_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `manager`
--

INSERT INTO `manager` (`id`, `surname`, `name`, `middlename`, `login`, `hash`, `salt`, `mangroup_id`) VALUES
(1, 'Алексеев', 'Сергей ', 'Владимирович', 'asv909', 'cf798d919ced9e86f70814173745990e97b09bbd', '4fc5c61db89199.64581532', 5),
(2, 'Система', 'Данные', 'Пользователя', 'system', 'e1fc82b16b49812ed5361a249d8083928bd1786e', '4fc5c7095b3785.65846008', 3),
(3, 'Бондарев', 'Александр', 'Александрович', 'alexandr', '885a39c4546f0b21cab1a60703013828764bb9de', '4fc5c7b94db264.71371932', 4),
(4, 'Славин', 'Сергей', 'Сергей', 'sergey', 'a0b950fe4a57f57ea3f167a5a2207a0228f0e1c9', '4fc5c852cd4166.70027199', 4),
(5, 'Бондарева', 'Марина', 'Владимировна', 'marina', 'b278e9a48d18c5ac45f56da25e9786bb08a0761f', '4fc5cb59dac5e2.49094114', 3),
(6, 'Найдина', 'Елена', 'Владимировна', 'nev', '3ce006113d9257a834930ba56e97f204126a591b', '4fc5cde16dee91.45750134', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `mangroup`
--

CREATE TABLE IF NOT EXISTS `mangroup` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Набора прав доступа',
  `name` varchar(15) NOT NULL,
  `select` tinyint(1) NOT NULL COMMENT 'Права на просмотр данных',
  `insert` tinyint(1) NOT NULL COMMENT 'Права на ввод новых данных',
  `update` tinyint(1) NOT NULL COMMENT 'Права на изменение данных',
  `delete` tinyint(1) NOT NULL COMMENT 'Права на удаление данных',
  `comment` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `mangroup`
--

INSERT INTO `mangroup` (`id`, `name`, `select`, `insert`, `update`, `delete`, `comment`) VALUES
(1, 'banned', 0, 0, 0, 0, 'Доступ запрещен'),
(2, 'viewer', 1, 0, 0, 0, 'Только просмотр'),
(3, 'operator', 1, 1, 0, 0, 'Просмотр и ввод новых данных'),
(4, 'redactor', 1, 1, 1, 0, 'Просмотр, ввод новых данных и редактирование'),
(5, 'administrator', 1, 1, 1, 1, 'Полный набор прав');

-- --------------------------------------------------------

--
-- Структура таблицы `measure`
--

CREATE TABLE IF NOT EXISTS `measure` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID ед.изм.',
  `unite` varchar(9) NOT NULL COMMENT 'Единица измерения',
  `manager_id` tinyint(3) unsigned NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unite_UNIQUE` (`unite`),
  KEY `fk_measure_manager` (`manager_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `measure`
--

INSERT INTO `measure` (`id`, `unite`, `manager_id`, `ts`) VALUES
(1, 'м', 1, '2012-04-18 12:16:27');

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Заказа',
  `usercust_id` mediumint(8) unsigned NOT NULL,
  `amount` float(9,2) unsigned NOT NULL COMMENT 'Сумма заказа',
  `invoice` varchar(45) NOT NULL COMMENT 'Реквизиты Счета',
  `orderstatus_id` tinyint(3) unsigned NOT NULL,
  `manager_id` tinyint(3) unsigned NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата заказа',
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice_UNIQUE` (`invoice`),
  KEY `fk_order_orderstatus` (`orderstatus_id`),
  KEY `fk_order_usercust` (`usercust_id`),
  KEY `fk_order_manager` (`manager_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `usercust_id`, `amount`, `invoice`, `orderstatus_id`, `manager_id`, `ts`) VALUES
(1, 1, 1000.00, './orders/test.pdf', 1, 1, '2012-02-29 20:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `orderitems`
--

CREATE TABLE IF NOT EXISTS `orderitems` (
  `order_id` smallint(5) unsigned NOT NULL,
  `product_id` smallint(5) unsigned NOT NULL,
  `quantity` smallint(5) unsigned NOT NULL COMMENT 'Количество',
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `fk_orderitems_product` (`product_id`),
  KEY `fk_orderitems_order` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orderitems`
--

INSERT INTO `orderitems` (`order_id`, `product_id`, `quantity`) VALUES
(1, 1, 20),
(1, 2, 30),
(1, 3, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `orderstatus`
--

CREATE TABLE IF NOT EXISTS `orderstatus` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Состояния заказа',
  `name` varchar(75) NOT NULL COMMENT 'Состояние заказа',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `orderstatus`
--

INSERT INTO `orderstatus` (`id`, `name`) VALUES
(1, 'Выставлен Счет на оплату, ожидается поступление денежных средств ...'),
(2, 'Оплата поступила, заказ направлен в работу ...'),
(3, 'Товар заказан, ожидается поступление на финский склад ...'),
(5, 'Товар находится на российском складе, идет подготовка к отгрузке ...'),
(4, 'Товар находится на финском складе, готовится отправка в РФ ...'),
(6, 'Товар отгружен Грузополучателю (передан Грузоперевозчику).');

-- --------------------------------------------------------

--
-- Структура таблицы `org`
--

CREATE TABLE IF NOT EXISTS `org` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID огр.-прав. формы',
  `form` varchar(4) NOT NULL COMMENT 'Орг.-прав. форма',
  PRIMARY KEY (`id`),
  UNIQUE KEY `form_UNIQUE` (`form`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `org`
--

INSERT INTO `org` (`id`, `form`) VALUES
(2, 'ЗАО'),
(3, 'ОАО'),
(1, 'ООО');

-- --------------------------------------------------------

--
-- Структура таблицы `pcode`
--

CREATE TABLE IF NOT EXISTS `pcode` (
  `id_product` smallint(5) unsigned NOT NULL COMMENT 'ID Товара',
  `value` varchar(75) NOT NULL COMMENT 'Артикул',
  `id_brand` tinyint(3) unsigned NOT NULL COMMENT 'ID Бренда',
  `manager_id` tinyint(3) unsigned NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено',
  PRIMARY KEY (`id_product`,`value`),
  UNIQUE KEY `value_UNIQUE` (`value`),
  KEY `fk_pcode_brand` (`id_brand`),
  KEY `fk_pcode_product` (`id_product`),
  KEY `fk_pcode_manager` (`manager_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pcode`
--

INSERT INTO `pcode` (`id_product`, `value`, `id_brand`, `manager_id`, `ts`) VALUES
(1, '28-STP-06X1', 1, 1, '2012-04-18 12:16:27'),
(1, 'TKPZ0610', 1, 1, '2012-04-18 12:16:27'),
(2, '28-STP-08X1', 1, 1, '2012-04-18 12:16:27'),
(2, 'TKPZ0810', 1, 1, '2012-04-18 12:16:27'),
(3, '28-STP-08X1,5', 1, 1, '2012-04-18 12:16:27'),
(3, 'TKPZ0815', 1, 1, '2012-04-18 12:16:27');

-- --------------------------------------------------------

--
-- Структура таблицы `pname`
--

CREATE TABLE IF NOT EXISTS `pname` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  `group1_id` tinyint(3) unsigned NOT NULL,
  `group2_id` tinyint(3) unsigned NOT NULL,
  `group3_id` smallint(5) unsigned NOT NULL,
  `group4_id` smallint(5) unsigned DEFAULT NULL,
  `group5_id` smallint(5) unsigned DEFAULT NULL,
  `group6_id` smallint(5) unsigned DEFAULT NULL,
  `manager_id` tinyint(3) unsigned NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_pname_group1` (`group1_id`),
  KEY `fk_pname_group2` (`group2_id`),
  KEY `fk_pname_group3` (`group3_id`),
  KEY `fk_pname_group4` (`group4_id`),
  KEY `fk_pname_group5` (`group5_id`),
  KEY `fk_pname_group6` (`group6_id`),
  KEY `fk_pname_manager` (`manager_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `pname`
--

INSERT INTO `pname` (`id`, `name`, `group1_id`, `group2_id`, `group3_id`, `group4_id`, `group5_id`, `group6_id`, `manager_id`, `ts`) VALUES
(1, 'Труба гидравлическая оцинкованная', 1, 1, 1, NULL, NULL, NULL, 1, '2012-04-18 12:16:27');

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID почт.индекса',
  `index` char(6) NOT NULL COMMENT 'Почтовый индекс',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_UNIQUE` (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`id`, `index`) VALUES
(1, '188800');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Товара',
  `pname_id` mediumint(8) unsigned NOT NULL,
  `param` varchar(255) DEFAULT NULL COMMENT 'Характеристика Товара',
  `id_measure` tinyint(3) unsigned NOT NULL COMMENT 'ID ед.изм.',
  `price` float(7,2) unsigned DEFAULT NULL COMMENT 'Цена €',
  `id_country` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT 'ID Страны',
  `manager_id` tinyint(3) unsigned NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено',
  PRIMARY KEY (`id`),
  KEY `fk_product_unite` (`id_measure`),
  KEY `fk_product_country` (`id_country`),
  KEY `fk_product_manager` (`manager_id`),
  KEY `fk_product_pname` (`pname_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `pname_id`, `param`, `id_measure`, `price`, `id_country`, `manager_id`, `ts`) VALUES
(1, 1, 'D=6 mm; t=1 mm; Pmax=509 bar;', 1, 2.79, 1, 1, '2012-04-18 12:16:27'),
(2, 1, 'D=8 mm; t=1 mm; Pmax=365 bar;', 1, 2.96, 1, 1, '2012-04-18 12:16:27'),
(3, 1, 'D=8 mm; t=1,5 mm; Pmax=583 bar;', 1, 3.30, 1, 1, '2012-04-18 12:16:27'),
(4, 1, 'D=10 mm; t=1 mm; Pmax=287 bar;', 1, 2.97, 1, 1, '2012-04-18 12:16:27'),
(5, 1, 'D=10 mm; t=1,5 mm; Pmax=450 bar;', 1, 3.52, 1, 1, '2012-04-18 12:16:27');

-- --------------------------------------------------------

--
-- Структура таблицы `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id` tinyint(3) unsigned NOT NULL COMMENT 'ID Региона',
  `name` varchar(45) NOT NULL COMMENT 'Регион',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `region`
--

INSERT INTO `region` (`id`, `name`) VALUES
(47, 'Ленинградская обл.');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Пользователя',
  `surname` varchar(25) NOT NULL COMMENT 'Фамилия',
  `name` varchar(25) NOT NULL COMMENT 'Имя',
  `middlename` varchar(25) DEFAULT NULL COMMENT 'Отчество',
  `email` varchar(45) NOT NULL COMMENT 'Эл.почта',
  `login` varchar(20) NOT NULL COMMENT 'Логин',
  `passwd` char(40) NOT NULL COMMENT 'Пароль',
  `lastvisit` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `surname`, `name`, `middlename`, `email`, `login`, `passwd`, `lastvisit`) VALUES
(1, 'Алексеев', 'Сергей', 'Владимирович', 'asv909@gmail.com', 'asv909', 'ce6e9bd1b21deeb2dab95d41a10b1278', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `usercust`
--

CREATE TABLE IF NOT EXISTS `usercust` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID связи:= Пользователь системы<->Организация-клиент ',
  `customer_id` smallint(5) unsigned NOT NULL,
  `user_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_usercust_customer` (`customer_id`),
  KEY `fk_usercust_user` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `usercust`
--

INSERT INTO `usercust` (`id`, `customer_id`, `user_id`) VALUES
(1, 1, 1);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `brand`
--
ALTER TABLE `brand`
  ADD CONSTRAINT `fk_brand_manager` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `country`
--
ALTER TABLE `country`
  ADD CONSTRAINT `fk_country_manager` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_city` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_customer_org` FOREIGN KEY (`org_id`) REFERENCES `org` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_customer_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_customer_region` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `group1`
--
ALTER TABLE `group1`
  ADD CONSTRAINT `fk_group1_manager` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `group2`
--
ALTER TABLE `group2`
  ADD CONSTRAINT `fk_group2_group1` FOREIGN KEY (`group1_id`) REFERENCES `group1` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_group2_manager` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `group3`
--
ALTER TABLE `group3`
  ADD CONSTRAINT `fk_group3_group2` FOREIGN KEY (`group2_id`) REFERENCES `group2` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_group3_manager` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `group4`
--
ALTER TABLE `group4`
  ADD CONSTRAINT `fk_group4_group3` FOREIGN KEY (`group3_id`) REFERENCES `group3` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_group4_manager` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `group5`
--
ALTER TABLE `group5`
  ADD CONSTRAINT `fk_group5_group4` FOREIGN KEY (`group4_id`) REFERENCES `group4` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_group5_manager` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `group6`
--
ALTER TABLE `group6`
  ADD CONSTRAINT `fk_group6_group5` FOREIGN KEY (`group5_id`) REFERENCES `group5` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_group6_manager` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `fk_manager_mangroup` FOREIGN KEY (`mangroup_id`) REFERENCES `mangroup` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `measure`
--
ALTER TABLE `measure`
  ADD CONSTRAINT `fk_measure_manager` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_manager` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_orderstatus` FOREIGN KEY (`orderstatus_id`) REFERENCES `orderstatus` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_usercust` FOREIGN KEY (`usercust_id`) REFERENCES `usercust` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
