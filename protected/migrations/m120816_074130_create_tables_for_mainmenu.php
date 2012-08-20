<?php

class m120816_074130_create_tables_for_mainmenu extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('url', array(
            'id'  => 'TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'url' => 'VARCHAR(25) NOT NULL',
        ), 'ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');
        $this->createIndex('url_UNIQUE', 'url', 'url', TRUE);

        $this->createTable('menu_item', array(
            'id'     => 'TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'name'   => 'VARCHAR(10) NOT NULL',
            'label'  => 'VARCHAR(25) NOT NULL',
            'url_id' => 'TINYINT(3) UNSIGNED NOT NULL',
        ), 'ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');
        $this->createIndex('name_UNIQUE', 'menu_item', 'name', TRUE);
        $this->createIndex('fk_mainmenu_item_url', 'menu_item', 'url_id');
        $this->addForeignKey('fk_mainmenu_item_url',
                            'menu_item', 'url_id',
                            'url', 'id',
                            'RESTRICT',
                            'CASCADE');


        $this->createTable('submenu_item', array(
            'id'           => 'TINYINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'name'         => 'VARCHAR(10) NOT NULL',
            'label'        => 'VARCHAR(45) NOT NULL',
            'url_id'       => 'TINYINT(3) UNSIGNED NOT NULL',
            'menu_item_id' => 'TINYINT(3) UNSIGNED NOT NULL',
        ), 'ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');
        $this->createIndex('name_UNIQUE', 'submenu_item', 'name', TRUE);
        $this->createIndex('fk_submenu_item_url', 'submenu_item', 'url_id');
        $this->createIndex('fk_submenu_item_menu_item', 'submenu_item', 'menu_item_id');
        $this->addForeignKey('fk_submenu_item_url',
                            'submenu_item', 'url_id',
                            'url', 'id',
                            'RESTRICT',
                            'CASCADE');
        $this->addForeignKey('fk_submenu_item_menu_item',
                            'submenu_item', 'menu_item_id',
                            'menu_item', 'id',
                            'RESTRICT',
                            'CASCADE');
        
        $this->insert('url', array('id'  => '1', 'url' => 'admin/index'));
        $this->insert('url', array('id'  => '2', 'url' => 'admin/view'));
        $this->insert('url', array('id'  => '3', 'url' => 'manager/login'));
        $this->insert('url', array('id'  => '4', 'url' => 'manager/logout'));
        $this->insert('url', array('id'  => '5', 'url' => '#'));

        $this->insert('menu_item', array(
            'id'     => '1',
            'name'   => 'home',
            'label'  => 'Главная',
            'url_id' => '1',
        ));
        $this->insert('menu_item', array(
            'id'     => '2',
            'name'   => 'product',
            'label'  => 'Номенклатура',
            'url_id' => '2',
        ));
        $this->insert('menu_item', array(
            'id'     => '3',
            'name'   => 'customer',
            'label'  => 'Клиенты',
            'url_id' => '2',
        ));
        $this->insert('menu_item', array(
            'id'     => '4',
            'name'   => 'order',
            'label'  => 'Заказы',
            'url_id' => '2',
        ));
        $this->insert('menu_item', array(
            'id'     => '5',
            'name'   => 'reference',
            'label'  => 'Справочники',
            'url_id' => '5',
        ));
        $this->insert('menu_item', array(
            'id'     => '6',
            'name'   => 'login',
            'label'  => 'Вход',
            'url_id' => '3',
        ));
        $this->insert('menu_item', array(
            'id'     => '7',
            'name'   => 'logout',
            'label'  => 'Выход',
            'url_id' => '4',
        ));
        
        $this->insert('submenu_item', array(
            'id'           => '1',
            'name'         => 'brand',
            'label'        => 'Производители товара',
            'url_id'       => '2',
            'menu_item_id' => '5',
        ));
        $this->insert('submenu_item', array(
            'id'           => '2',
            'name'         => 'country',
            'label'        => 'Страны',
            'url_id'       => '2',
            'menu_item_id' => '5',
        ));
        $this->insert('submenu_item', array(
            'id'           => '3',
            'name'         => 'measure',
            'label'        => 'Единицы измерения',
            'url_id'       => '2',
            'menu_item_id' => '5',
        ));
        $this->insert('submenu_item', array(
            'id'           => '4',
            'name'         => 'post',
            'label'        => 'Почтовые индексы',
            'url_id'       => '2',
            'menu_item_id' => '5',
        ));
        $this->insert('submenu_item', array(
            'id'           => '5',
            'name'         => 'region',
            'label'        => 'Регионы РФ',
            'url_id'       => '2',
            'menu_item_id' => '5',
        ));
        $this->insert('submenu_item', array(
            'id'           => '6',
            'name'         => 'city',
            'label'        => 'Города РФ',
            'url_id'       => '2',
            'menu_item_id' => '5',
        ));
        $this->insert('submenu_item', array(
            'id'           => '7',
            'name'         => 'org',
            'label'        => 'Организационно- правовые формы',
            'url_id'       => '2',
            'menu_item_id' => '5',
        ));
        
    }

    public function safeDown()
    {
        $this->dropTable('submenu_item');
        $this->dropTable('menu_item');
        $this->dropTable('url');
    }
}