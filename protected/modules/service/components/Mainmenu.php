<?php
/**
 * Mainmenu class file 
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @link http://www.eurotrade-et.ru/
 * @copyright Copyright &#169; 2012 RGK LLC
 * @license proprietary software, property of RGK LLC
 */

/**
 * The <var>Mainmenu</var> class is implementing 'on-fly' method of configuring 
 * CMenu's widget for general layout of service module (/layouts/main.php).
 * 
 * @author Sergey Alekseev <asv909@gmail.com>
 * @version $Id: Mainmenu.php v 1.0 2012-07-12 12:00:00 asv909 $
 * @package HYDRACOM application.
 * @subpackage modules.service.
 * @since 1.0
 */
class Mainmenu 
{
    /**
     * Used in service module main.php layout for main menu generation.
     * Get necessary data from DB and generate configuration of main menu for 
     * the CMenu widget.
     * 
     * @param string $activeItem is name (alias) for menu item to be active at 
     * the moment. This is AdminControllers property which defined in actions.
     * 
     * @return array <var>$items</var> value for 'items' key in CMenu widget 
     * configuration
     */
    public static function getConf($activeItem) 
    {  
        $mainMenuData = Menu_item::model()->with('url')->findAll();
        $rows[0] = count($mainMenuData);
        for ($i = 0; $i < $rows[0]; $i++) {
        /* label */
            $item['label'] = $mainMenuData[$i]->label;
        /* url */                                                                // Note: fill the $item['url'], it is an array('controller/action', 'item' => 'name')
            $url = NULL;                                                         // obligatorily need clear $url every time before continue,
            $url[0] = $mainMenuData[$i]->url->url;                                 // otherwise items link (url) will be generated wrong!!!
            $id = $mainMenuData[$i]->name;
            if (($id !== 'home') && ($id !== 'login') && ($id !== 'logout')       // if currently name is 'home','login','logout' or '#'  
                && ($url[0] !== '#')                                             // then $url['item'] should not exist!!!
            ) {
                $url['item'] = $id;
            } 
            $item['url'] = $url;
            if ($url[0] === '#') {                                               // if currently url is '#' then menu item has submenu and
                $item['url'] = '';                                               // therefore item must not have own link (url)!!!
            }
        /* active */
            if ($activeItem === $mainMenuData[$i]->name) {
                $item['active'] = TRUE;
            } else {
                $item['active'] = FALSE;
            }
        /* visible */
            $item['visible'] = TRUE;
            if (Yii::app()->user->isGuest) {
                $item['visible'] = FALSE;
            }
            if (($mainMenuData[$i]->name === 'login')
                && (!Yii::app()->user->isGuest)
                || (Yii::app()->params['testenv'])                              // this condition need for unit-test's
            ) {
                $item['visible'] = FALSE;
            } 
            if (($mainMenuData[$i]->name === 'logout')
                && (Yii::app()->user->isGuest)
            ) {
                $item['visible'] = FALSE;
            }
        /* generate submenu items */
            $item['items'] = NULL;                                               // obligatorily need clear $item['items'], otherwise followings
            if ($url[0] === '#') {                                               // items also will be have submenu with previous items
                $subMenuData = Submenu_item::model()->with('url')->findAll(
                    'menu_item_id=:menu_item_id', 
                    array(':menu_item_id' => $i+1)                               // obligatorily $i+1, because for DB records id value start from 1
                );
                $rows[1] = count($subMenuData);
                if ($rows[1] !== 0) {
                    for ($j = 0; $j < $rows[1]; $j++) {
                    /* label */
                        $subitem['label'] = $subMenuData[$j]->label;
                    /* url */
                        $url[0] = $subMenuData[$j]->url->url;
                        $url['item'] = $subMenuData[$j]->name;
                        $subitem['url'] = $url;
                    /* active */
                        if ($activeItem === $url['item']) {
                            $item['active'] = TRUE;
                            $subitem['active'] = TRUE;
                        } else {
                            $subitem['active'] = FALSE;
                        }
                    /* visible */
                        $subitem['visible'] = TRUE;
                    /* saving tune-up of current submenu's item */
                        $subitems[$j] = $subitem;
                    }
                /* saving current set of submenu items tune-up */
                    $item['items'] = $subitems;
                }
            }
        /* saving tune-up of current main menu's item */
            $items[$i] = $item;
        }
        return $items;
    }
}