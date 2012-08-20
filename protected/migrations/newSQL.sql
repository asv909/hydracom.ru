SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `hydracom` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `hydracom` ;

-- -----------------------------------------------------
-- Table `hydracom`.`mangroup`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`mangroup` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`mangroup` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID Набора прав доступа' ,
  `name` VARCHAR(15) NOT NULL ,
  `select` TINYINT(1) NOT NULL COMMENT 'Права на просмотр данных' ,
  `insert` TINYINT(1) NOT NULL COMMENT 'Права на ввод новых данных' ,
  `update` TINYINT(1) NOT NULL COMMENT 'Права на изменение данных' ,
  `delete` TINYINT(1) NOT NULL COMMENT 'Права на удаление данных' ,
  `comment` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`manager`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`manager` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`manager` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID Менеджера' ,
  `surname` VARCHAR(25) NOT NULL COMMENT 'Фамилия' ,
  `name` VARCHAR(25) NOT NULL COMMENT 'Имя' ,
  `middlename` VARCHAR(25) NULL COMMENT 'Отчество' ,
  `login` VARCHAR(20) NOT NULL COMMENT 'Логин' ,
  `hash` CHAR(40) NOT NULL ,
  `salt` CHAR(23) NOT NULL ,
  `skey` CHAR(23) NULL COMMENT 'Additional security' ,
  `mangroup_id` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `login_UNIQUE` (`login` ASC) ,
  INDEX `fk_manager_mangroup` (`mangroup_id` ASC) ,
  CONSTRAINT `fk_manager_mangroup`
    FOREIGN KEY (`mangroup_id` )
    REFERENCES `hydracom`.`mangroup` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`group1`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`group1` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`group1` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID Группы (1)' ,
  `name` VARCHAR(45) NOT NULL COMMENT 'Название Группы (1)' ,
  `imgref` VARCHAR(45) NULL COMMENT 'Ссылка на изображение' ,
  `manager_id` TINYINT UNSIGNED NOT NULL ,
  `ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  INDEX `fk_group1_manager` (`manager_id` ASC) ,
  CONSTRAINT `fk_group1_manager`
    FOREIGN KEY (`manager_id` )
    REFERENCES `hydracom`.`manager` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`group2`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`group2` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`group2` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID Группы (2)' ,
  `name` VARCHAR(45) NOT NULL COMMENT 'Название Группы (2)' ,
  `imgref` VARCHAR(45) NULL COMMENT 'Ссылка на изображение' ,
  `group1_id` TINYINT UNSIGNED NOT NULL ,
  `manager_id` TINYINT UNSIGNED NOT NULL ,
  `ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  INDEX `fk_group2_manager` (`manager_id` ASC) ,
  INDEX `fk_group2_group1` (`group1_id` ASC) ,
  CONSTRAINT `fk_group2_manager`
    FOREIGN KEY (`manager_id` )
    REFERENCES `hydracom`.`manager` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_group2_group1`
    FOREIGN KEY (`group1_id` )
    REFERENCES `hydracom`.`group1` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`group3`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`group3` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`group3` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID Группы (3)' ,
  `name` VARCHAR(45) NOT NULL COMMENT 'Название Группы (3)' ,
  `comment` VARCHAR(255) NULL COMMENT 'Комментарий' ,
  `imgref` VARCHAR(45) NULL COMMENT 'Ссылка на изображение' ,
  `group2_id` TINYINT UNSIGNED NOT NULL ,
  `manager_id` TINYINT UNSIGNED NOT NULL ,
  `ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  INDEX `fk_group3_manager` (`manager_id` ASC) ,
  INDEX `fk_group3_group2` (`group2_id` ASC) ,
  CONSTRAINT `fk_group3_manager`
    FOREIGN KEY (`manager_id` )
    REFERENCES `hydracom`.`manager` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_group3_group2`
    FOREIGN KEY (`group2_id` )
    REFERENCES `hydracom`.`group2` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`group4`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`group4` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`group4` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID Группы (4)' ,
  `name` VARCHAR(45) NOT NULL COMMENT 'Название Группы (4)' ,
  `comment` VARCHAR(255) NULL COMMENT 'Комментарий' ,
  `imgref` VARCHAR(45) NULL COMMENT 'Ссылка на изображение' ,
  `group3_id` SMALLINT UNSIGNED NOT NULL ,
  `manager_id` TINYINT UNSIGNED NOT NULL ,
  `ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  INDEX `fk_group4_manager` (`manager_id` ASC) ,
  INDEX `fk_group4_group3` (`group3_id` ASC) ,
  CONSTRAINT `fk_group4_manager`
    FOREIGN KEY (`manager_id` )
    REFERENCES `hydracom`.`manager` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_group4_group3`
    FOREIGN KEY (`group3_id` )
    REFERENCES `hydracom`.`group3` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`group5`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`group5` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`group5` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID Группы (5)' ,
  `name` VARCHAR(45) NOT NULL COMMENT 'Название Группы (5)' ,
  `comment` VARCHAR(255) NULL COMMENT 'Комментарий' ,
  `imgref` VARCHAR(45) NULL COMMENT 'Ссылка на изображение' ,
  `group4_id` SMALLINT UNSIGNED NOT NULL ,
  `manager_id` TINYINT UNSIGNED NOT NULL ,
  `ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  INDEX `fk_group5_manager` (`manager_id` ASC) ,
  INDEX `fk_group5_group4` (`group4_id` ASC) ,
  CONSTRAINT `fk_group5_manager`
    FOREIGN KEY (`manager_id` )
    REFERENCES `hydracom`.`manager` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_group5_group4`
    FOREIGN KEY (`group4_id` )
    REFERENCES `hydracom`.`group4` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`group6`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`group6` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`group6` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID Группы (6)' ,
  `name` VARCHAR(45) NOT NULL COMMENT 'Название Группы (6)' ,
  `comment` VARCHAR(255) NULL COMMENT 'Комментарий' ,
  `imgref` VARCHAR(45) NULL COMMENT 'Ссылка на изображение' ,
  `group5_id` SMALLINT UNSIGNED NOT NULL ,
  `manager_id` TINYINT UNSIGNED NOT NULL ,
  `ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  INDEX `fk_group6_manager` (`manager_id` ASC) ,
  INDEX `fk_group6_group5` (`group5_id` ASC) ,
  CONSTRAINT `fk_group6_manager`
    FOREIGN KEY (`manager_id` )
    REFERENCES `hydracom`.`manager` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_group6_group5`
    FOREIGN KEY (`group5_id` )
    REFERENCES `hydracom`.`group5` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`measure`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`measure` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`measure` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID ед.изм.' ,
  `name` VARCHAR(9) NOT NULL COMMENT 'Единица измерения' ,
  `manager_id` TINYINT UNSIGNED NOT NULL ,
  `ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `unite_UNIQUE` (`name` ASC) ,
  INDEX `fk_measure_manager` (`manager_id` ASC) ,
  CONSTRAINT `fk_measure_manager`
    FOREIGN KEY (`manager_id` )
    REFERENCES `hydracom`.`manager` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`country`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`country` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`country` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID Страны' ,
  `name` VARCHAR(45) NOT NULL DEFAULT 'ЕС' COMMENT 'Страна' ,
  `manager_id` TINYINT UNSIGNED NOT NULL ,
  `ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  INDEX `fk_country_manager` (`manager_id` ASC) ,
  CONSTRAINT `fk_country_manager`
    FOREIGN KEY (`manager_id` )
    REFERENCES `hydracom`.`manager` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`pname`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`pname` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`pname` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(75) NOT NULL ,
  `group1_id` TINYINT UNSIGNED NOT NULL ,
  `group2_id` TINYINT UNSIGNED NOT NULL ,
  `group3_id` SMALLINT UNSIGNED NOT NULL ,
  `group4_id` SMALLINT UNSIGNED NULL ,
  `group5_id` SMALLINT UNSIGNED NULL ,
  `group6_id` SMALLINT UNSIGNED NULL ,
  `manager_id` TINYINT UNSIGNED NOT NULL ,
  `ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_pname_group1` (`group1_id` ASC) ,
  INDEX `fk_pname_group2` (`group2_id` ASC) ,
  INDEX `fk_pname_group3` (`group3_id` ASC) ,
  INDEX `fk_pname_group4` (`group4_id` ASC) ,
  INDEX `fk_pname_group5` (`group5_id` ASC) ,
  INDEX `fk_pname_group6` (`group6_id` ASC) ,
  INDEX `fk_pname_manager` (`manager_id` ASC) ,
  CONSTRAINT `fk_pname_group1`
    FOREIGN KEY (`group1_id` )
    REFERENCES `hydracom`.`group1` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pname_group2`
    FOREIGN KEY (`group2_id` )
    REFERENCES `hydracom`.`group2` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pname_group3`
    FOREIGN KEY (`group3_id` )
    REFERENCES `hydracom`.`group3` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pname_group4`
    FOREIGN KEY (`group4_id` )
    REFERENCES `hydracom`.`group4` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pname_group5`
    FOREIGN KEY (`group5_id` )
    REFERENCES `hydracom`.`group5` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pname_group6`
    FOREIGN KEY (`group6_id` )
    REFERENCES `hydracom`.`group6` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pname_manager`
    FOREIGN KEY (`manager_id` )
    REFERENCES `hydracom`.`manager` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`product`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`product` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`product` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID Товара' ,
  `pname_id` MEDIUMINT UNSIGNED NOT NULL ,
  `param` VARCHAR(255) NULL COMMENT 'Характеристика Товара' ,
  `id_measure` TINYINT UNSIGNED NOT NULL COMMENT 'ID ед.изм.' ,
  `price` FLOAT(7,2) UNSIGNED NULL COMMENT 'Цена €' ,
  `id_country` TINYINT UNSIGNED NOT NULL DEFAULT 1 COMMENT 'ID Страны' ,
  `manager_id` TINYINT UNSIGNED NOT NULL ,
  `ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_product_unite` (`id_measure` ASC) ,
  INDEX `fk_product_country` (`id_country` ASC) ,
  INDEX `fk_product_manager` (`manager_id` ASC) ,
  INDEX `fk_product_pname` (`pname_id` ASC) ,
  CONSTRAINT `fk_product_unite`
    FOREIGN KEY (`id_measure` )
    REFERENCES `hydracom`.`measure` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_product_country`
    FOREIGN KEY (`id_country` )
    REFERENCES `hydracom`.`country` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_product_manager`
    FOREIGN KEY (`manager_id` )
    REFERENCES `hydracom`.`manager` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_product_pname`
    FOREIGN KEY (`pname_id` )
    REFERENCES `hydracom`.`pname` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`brand`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`brand` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`brand` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID Бренда' ,
  `name` VARCHAR(45) NOT NULL COMMENT 'Бренд' ,
  `manager_id` TINYINT UNSIGNED NOT NULL ,
  `ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  INDEX `fk_brand_manager` (`manager_id` ASC) ,
  CONSTRAINT `fk_brand_manager`
    FOREIGN KEY (`manager_id` )
    REFERENCES `hydracom`.`manager` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`org`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`org` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`org` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID огр.-прав. формы' ,
  `name` VARCHAR(4) NOT NULL COMMENT 'Орг.-прав. форма' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `form_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`post`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`post` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`post` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID почт.индекса' ,
  `name` CHAR(6) NOT NULL COMMENT 'Почтовый индекс' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `index_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hydracom`.`region`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`region` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`region` (
  `id` TINYINT UNSIGNED NOT NULL COMMENT 'ID Региона' ,
  `name` VARCHAR(45) NOT NULL COMMENT 'Регион' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`city`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`city` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`city` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID Города' ,
  `name` VARCHAR(45) NOT NULL COMMENT 'Город' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`customer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`customer` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`customer` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID Клиента' ,
  `customer` VARCHAR(45) NOT NULL COMMENT 'Название Фирмы' ,
  `org_id` TINYINT UNSIGNED NOT NULL ,
  `inn` VARCHAR(12) NOT NULL COMMENT 'ИНН' ,
  `kpp` CHAR(9) NOT NULL COMMENT 'КПП' ,
  `post_id` SMALLINT UNSIGNED NOT NULL ,
  `region_id` TINYINT UNSIGNED NOT NULL ,
  `city_id` SMALLINT UNSIGNED NOT NULL ,
  `address` VARCHAR(75) NOT NULL COMMENT 'Юр.Адрес' ,
  `phone` CHAR(11) NOT NULL COMMENT 'Телефон' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `inn_UNIQUE` (`inn` ASC, `customer` ASC) ,
  INDEX `fk_customer_org` (`org_id` ASC) ,
  INDEX `fk_customer_post` (`post_id` ASC) ,
  INDEX `fk_customer_region` (`region_id` ASC) ,
  INDEX `fk_customer_city` (`city_id` ASC) ,
  CONSTRAINT `fk_customer_org`
    FOREIGN KEY (`org_id` )
    REFERENCES `hydracom`.`org` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_customer_post`
    FOREIGN KEY (`post_id` )
    REFERENCES `hydracom`.`post` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_customer_region`
    FOREIGN KEY (`region_id` )
    REFERENCES `hydracom`.`region` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_customer_city`
    FOREIGN KEY (`city_id` )
    REFERENCES `hydracom`.`city` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`user` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`user` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID Пользователя' ,
  `surname` VARCHAR(25) NOT NULL COMMENT 'Фамилия' ,
  `name` VARCHAR(25) NOT NULL COMMENT 'Имя' ,
  `middlename` VARCHAR(25) NULL COMMENT 'Отчество' ,
  `email` VARCHAR(45) NOT NULL COMMENT 'Эл.почта' ,
  `login` VARCHAR(20) NOT NULL COMMENT 'Логин' ,
  `passwd` CHAR(40) NOT NULL COMMENT 'Пароль' ,
  `lastvisit` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  UNIQUE INDEX `login_UNIQUE` (`login` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`orderstatus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`orderstatus` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`orderstatus` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID Состояния заказа' ,
  `name` VARCHAR(75) NOT NULL COMMENT 'Состояние заказа' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hydracom`.`usercust`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`usercust` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`usercust` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID связи:= Пользователь системы<->Организация-клиент ' ,
  `customer_id` SMALLINT UNSIGNED NOT NULL ,
  `user_id` MEDIUMINT UNSIGNED NOT NULL ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_usercust_customer` (`customer_id` ASC) ,
  INDEX `fk_usercust_user` (`user_id` ASC) ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_usercust_customer`
    FOREIGN KEY (`customer_id` )
    REFERENCES `hydracom`.`customer` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_usercust_user`
    FOREIGN KEY (`user_id` )
    REFERENCES `hydracom`.`user` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`order`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`order` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`order` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID Заказа' ,
  `usercust_id` MEDIUMINT UNSIGNED NOT NULL ,
  `amount` FLOAT(9,2) UNSIGNED NOT NULL COMMENT 'Сумма заказа' ,
  `invoice` VARCHAR(45) NOT NULL COMMENT 'Реквизиты Счета' ,
  `orderstatus_id` TINYINT UNSIGNED NOT NULL ,
  `manager_id` TINYINT UNSIGNED NOT NULL ,
  `ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата заказа' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `invoice_UNIQUE` (`invoice` ASC) ,
  INDEX `fk_order_orderstatus` (`orderstatus_id` ASC) ,
  INDEX `fk_order_usercust` (`usercust_id` ASC) ,
  INDEX `fk_order_manager` (`manager_id` ASC) ,
  CONSTRAINT `fk_order_orderstatus`
    FOREIGN KEY (`orderstatus_id` )
    REFERENCES `hydracom`.`orderstatus` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_order_usercust`
    FOREIGN KEY (`usercust_id` )
    REFERENCES `hydracom`.`usercust` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_order_manager`
    FOREIGN KEY (`manager_id` )
    REFERENCES `hydracom`.`manager` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`orderitems`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`orderitems` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`orderitems` (
  `order_id` SMALLINT UNSIGNED NOT NULL ,
  `product_id` SMALLINT UNSIGNED NOT NULL ,
  `quantity` SMALLINT UNSIGNED NOT NULL COMMENT 'Количество' ,
  INDEX `fk_orderitems_product` (`product_id` ASC) ,
  INDEX `fk_orderitems_order` (`order_id` ASC) ,
  PRIMARY KEY (`order_id`, `product_id`) ,
  CONSTRAINT `fk_orderitems_product`
    FOREIGN KEY (`product_id` )
    REFERENCES `hydracom`.`product` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_orderitems_order`
    FOREIGN KEY (`order_id` )
    REFERENCES `hydracom`.`order` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hydracom`.`pcode`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`pcode` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`pcode` (
  `id_product` SMALLINT UNSIGNED NOT NULL COMMENT 'ID Товара' ,
  `value` VARCHAR(75) NOT NULL COMMENT 'Артикул' ,
  `id_brand` TINYINT UNSIGNED NOT NULL COMMENT 'ID Бренда' ,
  `manager_id` TINYINT UNSIGNED NOT NULL ,
  `ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменено' ,
  UNIQUE INDEX `value_UNIQUE` (`value` ASC) ,
  INDEX `fk_pcode_brand` (`id_brand` ASC) ,
  INDEX `fk_pcode_product` (`id_product` ASC) ,
  PRIMARY KEY (`id_product`, `value`) ,
  INDEX `fk_pcode_manager` (`manager_id` ASC) ,
  CONSTRAINT `fk_item_code_brand`
    FOREIGN KEY (`id_brand` )
    REFERENCES `hydracom`.`brand` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_item_code_item`
    FOREIGN KEY (`id_product` )
    REFERENCES `hydracom`.`product` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pcode_manager`
    FOREIGN KEY (`manager_id` )
    REFERENCES `hydracom`.`manager` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hydracom`.`url`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`url` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`url` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `url` VARCHAR(25) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `url_UNIQUE` (`url` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`menu_item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`menu_item` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`menu_item` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(10) NOT NULL ,
  `label` VARCHAR(25) NOT NULL ,
  `url_id` TINYINT NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  INDEX `fk_mainmenu_item_url` (`url_id` ASC) ,
  CONSTRAINT `fk_mainmenu_item_url`
    FOREIGN KEY (`url_id` )
    REFERENCES `hydracom`.`url` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `hydracom`.`submenu_item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hydracom`.`submenu_item` ;

CREATE  TABLE IF NOT EXISTS `hydracom`.`submenu_item` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(10) NOT NULL ,
  `label` VARCHAR(45) NOT NULL ,
  `url_id` TINYINT UNSIGNED NOT NULL ,
  `menu_item_id` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  INDEX `fk_submenu_item_url` (`url_id` ASC) ,
  INDEX `fk_submenu_item_menu_item` (`menu_item_id` ASC) ,
  CONSTRAINT `fk_submenu_item_url`
    FOREIGN KEY (`url_id` )
    REFERENCES `hydracom`.`url` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_submenu_item_menu_item`
    FOREIGN KEY (`menu_item_id` )
    REFERENCES `hydracom`.`menu_item` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `hydracom`.`mangroup`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`mangroup` (`id`, `name`, `select`, `insert`, `update`, `delete`, `comment`) VALUES (1, 'banned', 0, 0, 0, 0, 'Доступ запрещен');
INSERT INTO `hydracom`.`mangroup` (`id`, `name`, `select`, `insert`, `update`, `delete`, `comment`) VALUES (2, 'viewer', 1, 0, 0, 0, 'Только просмотр');
INSERT INTO `hydracom`.`mangroup` (`id`, `name`, `select`, `insert`, `update`, `delete`, `comment`) VALUES (3, 'operator', 1, 1, 0, 0, 'Просмотр и ввод новых данных');
INSERT INTO `hydracom`.`mangroup` (`id`, `name`, `select`, `insert`, `update`, `delete`, `comment`) VALUES (4, 'redactor', 1, 1, 1, 0, 'Просмотр, ввод новых данных и редактирование');
INSERT INTO `hydracom`.`mangroup` (`id`, `name`, `select`, `insert`, `update`, `delete`, `comment`) VALUES (5, 'administrator', 1, 1, 1, 1, 'Полный набор прав');

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`manager`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`manager` (`id`, `surname`, `name`, `middlename`, `login`, `hash`, `salt`, `skey`, `mangroup_id`) VALUES (1, 'Алексеев', 'Сергей ', 'Владимирович', 'asv909', '4cf5851e865de75a151698d81d3629af', NULL, NULL, 5);
INSERT INTO `hydracom`.`manager` (`id`, `surname`, `name`, `middlename`, `login`, `hash`, `salt`, `skey`, `mangroup_id`) VALUES (2, 'Система', 'Данные', 'Менеджер', 'system', 'ce6e9bd1b21deeb2dab95d41a10b1278', NULL, NULL, 3);
INSERT INTO `hydracom`.`manager` (`id`, `surname`, `name`, `middlename`, `login`, `hash`, `salt`, `skey`, `mangroup_id`) VALUES (3, 'Бондарев', 'Александр', 'Александрович', 'alexandr', 'ce6e9bd1b21deeb2dab95d41a10b1278', NULL, NULL, 4);
INSERT INTO `hydracom`.`manager` (`id`, `surname`, `name`, `middlename`, `login`, `hash`, `salt`, `skey`, `mangroup_id`) VALUES (4, 'Славин', 'Сергей', 'Николаевич', 'sergey', 'ce6e9bd1b21deeb2dab95d41a10b1278', NULL, NULL, 4);
INSERT INTO `hydracom`.`manager` (`id`, `surname`, `name`, `middlename`, `login`, `hash`, `salt`, `skey`, `mangroup_id`) VALUES (5, 'Бондарева', 'Марина', 'Владимировна', 'marina', 'ce6e9bd1b21deeb2dab95d41a10b1278', NULL, NULL, 3);
INSERT INTO `hydracom`.`manager` (`id`, `surname`, `name`, `middlename`, `login`, `hash`, `salt`, `skey`, `mangroup_id`) VALUES (6, 'Найдина', 'Елена', 'Владимировна', 'nev', 'ce6e9bd1b21deeb2dab95d41a10b1278', NULL, NULL, 2);

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`group1`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`group1` (`id`, `name`, `imgref`, `manager_id`, `ts`) VALUES (1, 'Компоненты гидравлических систем', NULL, 1, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`group2`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`group2` (`id`, `name`, `imgref`, `group1_id`, `manager_id`, `ts`) VALUES (1, 'Трубы гидравлические по DIN 2391', NULL, 1, 1, NULL);
INSERT INTO `hydracom`.`group2` (`id`, `name`, `imgref`, `group1_id`, `manager_id`, `ts`) VALUES (2, 'Соединения гидравлические', NULL, 1, 1, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`group3`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`group3` (`id`, `name`, `comment`, `imgref`, `group2_id`, `manager_id`, `ts`) VALUES (1, 'Оцинкованные', 'Марка стали: ST 37,4; D - внешний диаметр; t - толщина стенки; Pmax -  максимальное рабочее давление;', NULL, 1, 1, NULL);
INSERT INTO `hydracom`.`group3` (`id`, `name`, `comment`, `imgref`, `group2_id`, `manager_id`, `ts`) VALUES (2, 'Из нержавеющей стали', NULL, NULL, 1, 1, NULL);
INSERT INTO `hydracom`.`group3` (`id`, `name`, `comment`, `imgref`, `group2_id`, `manager_id`, `ts`) VALUES (3, 'Фосфатированные (черные)', NULL, NULL, 1, 1, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`measure`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`measure` (`id`, `name`, `manager_id`, `ts`) VALUES (1, 'м', 1, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`country`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`country` (`id`, `name`, `manager_id`, `ts`) VALUES (1, 'ЕС', 1, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`pname`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`pname` (`id`, `name`, `group1_id`, `group2_id`, `group3_id`, `group4_id`, `group5_id`, `group6_id`, `manager_id`, `ts`) VALUES (1, 'Труба гидравлическая оцинкованная', 1, 1, 1, NULL, NULL, NULL, 1, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`product`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`product` (`id`, `pname_id`, `param`, `id_measure`, `price`, `id_country`, `manager_id`, `ts`) VALUES (1, 1, 'D=6 mm; t=1 mm; Pmax=509 bar;', 1, 2.79, 1, 1, NULL);
INSERT INTO `hydracom`.`product` (`id`, `pname_id`, `param`, `id_measure`, `price`, `id_country`, `manager_id`, `ts`) VALUES (2, 1, 'D=8 mm; t=1 mm; Pmax=365 bar;', 1, 2.96, 1, 1, NULL);
INSERT INTO `hydracom`.`product` (`id`, `pname_id`, `param`, `id_measure`, `price`, `id_country`, `manager_id`, `ts`) VALUES (3, 1, 'D=8 mm; t=1,5 mm; Pmax=583 bar;', 1, 3.3, 1, 1, NULL);
INSERT INTO `hydracom`.`product` (`id`, `pname_id`, `param`, `id_measure`, `price`, `id_country`, `manager_id`, `ts`) VALUES (4, 1, 'D=10 mm; t=1 mm; Pmax=287 bar;', 1, 2.97, 1, 1, NULL);
INSERT INTO `hydracom`.`product` (`id`, `pname_id`, `param`, `id_measure`, `price`, `id_country`, `manager_id`, `ts`) VALUES (5, 1, 'D=10 mm; t=1,5 mm; Pmax=450 bar;', 1, 3.52, 1, 1, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`brand`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`brand` (`id`, `name`, `manager_id`, `ts`) VALUES (1, 'Hiflex', 1, NULL);
INSERT INTO `hydracom`.`brand` (`id`, `name`, `manager_id`, `ts`) VALUES (2, 'Polarputki', 1, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`org`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`org` (`id`, `name`) VALUES (1, 'ООО');
INSERT INTO `hydracom`.`org` (`id`, `name`) VALUES (2, 'ЗАО');
INSERT INTO `hydracom`.`org` (`id`, `name`) VALUES (3, 'ОАО');

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`post`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`post` (`id`, `name`) VALUES (1, '188800');

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`region`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`region` (`id`, `name`) VALUES (47, 'Ленинградская обл.');

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`city`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`city` (`id`, `name`) VALUES (1, 'Выборг');

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`customer`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`customer` (`id`, `customer`, `org_id`, `inn`, `kpp`, `post_id`, `region_id`, `city_id`, `address`, `phone`) VALUES (1, 'АЛНЭТ', 1, '4704042269', '470401001', 1, 47, 1, 'ул.Большая каменная, д.7, кв.29', '813-7852037');

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`user`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`user` (`id`, `surname`, `name`, `middlename`, `email`, `login`, `passwd`, `lastvisit`) VALUES (1, 'Алексеев', 'Сергей', 'Владимирович', 'asv909@gmail.com', 'asv909', 'ce6e9bd1b21deeb2dab95d41a10b1278', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`orderstatus`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`orderstatus` (`id`, `name`) VALUES (1, 'Выставлен Счет на оплату, ожидается поступление денежных средств ...');
INSERT INTO `hydracom`.`orderstatus` (`id`, `name`) VALUES (2, 'Оплата поступила, заказ направлен в работу ...');
INSERT INTO `hydracom`.`orderstatus` (`id`, `name`) VALUES (3, 'Товар заказан, ожидается поступление на финский склад ...');
INSERT INTO `hydracom`.`orderstatus` (`id`, `name`) VALUES (4, 'Товар находится на финском складе, готовится отправка в РФ ...');
INSERT INTO `hydracom`.`orderstatus` (`id`, `name`) VALUES (5, 'Товар находится на российском складе, идет подготовка к отгрузке ...');
INSERT INTO `hydracom`.`orderstatus` (`id`, `name`) VALUES (6, 'Товар отгружен Грузополучателю (передан Грузоперевозчику).');

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`usercust`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`usercust` (`id`, `customer_id`, `user_id`) VALUES (1, 1, 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`order`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`order` (`id`, `usercust_id`, `amount`, `invoice`, `orderstatus_id`, `manager_id`, `ts`) VALUES (1, 1, 1000, './orders/test.pdf', 1, 1, '2012-03-01');

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`orderitems`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`orderitems` (`order_id`, `product_id`, `quantity`) VALUES (1, 1, 20);
INSERT INTO `hydracom`.`orderitems` (`order_id`, `product_id`, `quantity`) VALUES (1, 2, 30);
INSERT INTO `hydracom`.`orderitems` (`order_id`, `product_id`, `quantity`) VALUES (1, 3, 10);

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`pcode`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`pcode` (`id_product`, `value`, `id_brand`, `manager_id`, `ts`) VALUES (1, '28-STP-06X1', 1, 1, NULL);
INSERT INTO `hydracom`.`pcode` (`id_product`, `value`, `id_brand`, `manager_id`, `ts`) VALUES (1, 'TKPZ0610', 1, 1, NULL);
INSERT INTO `hydracom`.`pcode` (`id_product`, `value`, `id_brand`, `manager_id`, `ts`) VALUES (2, '28-STP-08X1', 1, 1, NULL);
INSERT INTO `hydracom`.`pcode` (`id_product`, `value`, `id_brand`, `manager_id`, `ts`) VALUES (2, 'TKPZ0810', 1, 1, NULL);
INSERT INTO `hydracom`.`pcode` (`id_product`, `value`, `id_brand`, `manager_id`, `ts`) VALUES (3, '28-STP-08X1,5', 1, 1, NULL);
INSERT INTO `hydracom`.`pcode` (`id_product`, `value`, `id_brand`, `manager_id`, `ts`) VALUES (3, 'TKPZ0815', 1, 1, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`url`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`url` (`id`, `url`) VALUES (1, 'admin/index');
INSERT INTO `hydracom`.`url` (`id`, `url`) VALUES (2, 'admin/view');
INSERT INTO `hydracom`.`url` (`id`, `url`) VALUES (3, 'manager/login');
INSERT INTO `hydracom`.`url` (`id`, `url`) VALUES (4, 'manager/logout');
INSERT INTO `hydracom`.`url` (`id`, `url`) VALUES (5, '#');

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`menu_item`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`menu_item` (`id`, `name`, `label`, `url_id`) VALUES (1, 'home', 'Главная', 1);
INSERT INTO `hydracom`.`menu_item` (`id`, `name`, `label`, `url_id`) VALUES (2, 'product', 'Номенклатура', 2);
INSERT INTO `hydracom`.`menu_item` (`id`, `name`, `label`, `url_id`) VALUES (3, 'customer', 'Клиенты', 2);
INSERT INTO `hydracom`.`menu_item` (`id`, `name`, `label`, `url_id`) VALUES (4, 'order', 'Заказы', 2);
INSERT INTO `hydracom`.`menu_item` (`id`, `name`, `label`, `url_id`) VALUES (5, 'reference', 'Справочники', 5);
INSERT INTO `hydracom`.`menu_item` (`id`, `name`, `label`, `url_id`) VALUES (6, 'login', 'Вход', 3);
INSERT INTO `hydracom`.`menu_item` (`id`, `name`, `label`, `url_id`) VALUES (7, 'logout', 'Выход', 4);

COMMIT;

-- -----------------------------------------------------
-- Data for table `hydracom`.`submenu_item`
-- -----------------------------------------------------
START TRANSACTION;
USE `hydracom`;
INSERT INTO `hydracom`.`submenu_item` (`id`, `name`, `label`, `url_id`, `menu_item_id`) VALUES (1, 'brand', 'Производители товара', 2, 5);
INSERT INTO `hydracom`.`submenu_item` (`id`, `name`, `label`, `url_id`, `menu_item_id`) VALUES (2, 'country', 'Страны', 2, 5);
INSERT INTO `hydracom`.`submenu_item` (`id`, `name`, `label`, `url_id`, `menu_item_id`) VALUES (3, 'measure', 'Единицы измерения', 2, 5);
INSERT INTO `hydracom`.`submenu_item` (`id`, `name`, `label`, `url_id`, `menu_item_id`) VALUES (4, 'post', 'Почтовые индексы РФ', 2, 5);
INSERT INTO `hydracom`.`submenu_item` (`id`, `name`, `label`, `url_id`, `menu_item_id`) VALUES (5, 'region', 'Регионы РФ', 2, 5);
INSERT INTO `hydracom`.`submenu_item` (`id`, `name`, `label`, `url_id`, `menu_item_id`) VALUES (6, 'city', 'Города РФ', 2, 5);
INSERT INTO `hydracom`.`submenu_item` (`id`, `name`, `label`, `url_id`, `menu_item_id`) VALUES (7, 'org', 'Орг.-правовые формы', 2, 5);

COMMIT;
