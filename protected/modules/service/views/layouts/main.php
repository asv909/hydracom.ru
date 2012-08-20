<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="cache-control" content="no-cache" />

        <meta charset="utf-8" />
        <meta name="language" content="ru" />
        <meta http-equiv="Content-Language" content="ru">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <meta name="copyright" content="RGK LLC.© 2012-2013" />
        <meta name="publisher-url" content="http://www.eurotrade-et.ru/" />
        <meta name="publisher-email" content="mailto:web@eurotrade-et" />
        <meta name="author" content="Sergey Alekseev, mailto:asv909@gmail.com" />

        <meta name="description" content="" />
        <meta name="keywords" content="" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/blueprint/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/blueprint/print.css" media="print" />
        <!--[if lt IE 8]>
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/blueprint/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>
        <div class="container" id="page">

            <div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
            </div><!-- header -->

            <div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
                        'htmlOptions' => array('class' => 'menu',),
                        'items' => array(
                            array('label'   => $this->menuItemData[$this->menuItemAlias[0]]['label'],
                                  'url'     => $this->menuItemData[$this->menuItemAlias[0]]['url'],
                                  'active'  => $this->isActiveItem($this->menuItemAlias[0]),
                                  'visible' => !Yii::app()->user->isGuest),
                            
                            array('label'   => $this->menuItemData[$this->menuItemAlias[1]]['label'],
                                  'url'     => $this->menuItemData[$this->menuItemAlias[1]]['url'],
                                  'active'  => $this->isActiveItem($this->menuItemAlias[1]),
                                  'visible' => !Yii::app()->user->isGuest),
                            
                            array('label'   => $this->menuItemData[$this->menuItemAlias[2]]['label'],
                                  'url'     => $this->menuItemData[$this->menuItemAlias[2]]['url'],
                                  'active'  => $this->isActiveItem($this->menuItemAlias[2]),
                                  'visible' => !Yii::app()->user->isGuest),
                            
                            array('label'   => $this->menuItemData[$this->menuItemAlias[3]]['label'],
                                  'url'     => $this->menuItemData[$this->menuItemAlias[3]]['url'],
                                  'active'  => $this->isActiveItem($this->menuItemAlias[3]),
                                  'visible' => !Yii::app()->user->isGuest),
                            
                            array('label'   => $this->menuItemData[$this->menuItemAlias[4]]['label'],
                                  'url'     => $this->menuItemData[$this->menuItemAlias[4]]['url'],
                                  'active'  => $this->isActiveItem($this->menuItemAlias[4]),
                                  'visible' => !Yii::app()->user->isGuest,
                                  'items'   => array(
                                      array('label' => 'Названия фирм-производителей',
                                            'url'   => array('admin/view', 'id' => 'brand')),
                                      array('label' => 'Страны происхождения',
                                            'url'   => array('admin/view', 'id' => 'country')),
                                      array('label' => 'Единицы измерения',
                                            'url'   => array('admin/view', 'id' => 'measure')),
                                      array('label' => 'Почтовые индексы РФ',
                                            'url'   => array('admin/view', 'id' => 'post')),
                                      array('label' => 'Регионы РФ',
                                            'url'   => array('admin/view', 'id' => 'region')),
                                      array('label' => 'Города РФ',
                                            'url'   => array('admin/view', 'id' => 'city')),
                                      array('label' => 'Орг.-прав. формы',
                                            'url'   => array('admin/view', 'id' => 'org')),
                                  )),
                            
                            array('label'   => $this->menuItemData[$this->menuItemAlias[5]]['label'],
                                  'url'     => $this->menuItemData[$this->menuItemAlias[5]]['url'],
                                  'active'  => $this->isActiveItem($this->menuItemAlias[5]),
                                  'visible' => Yii::app()->user->isGuest),
                            
                            array('label'   => $this->menuItemData[$this->menuItemAlias[6]]['label']
                                               . ' (' . Yii::app()->user->name.')',
                                  'url'     => $this->menuItemData[$this->menuItemAlias[6]]['url'],
                                  'visible' => !Yii::app()->user->isGuest),
			),
		)); ?>
            </div><!-- mainmenu -->
            
            <?php if(isset($this->breadcrumbs)):?>
                    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                            'links' => $this->breadcrumbs,
                    )); ?><!-- breadcrumbs -->
            <?php endif?>
            
            <?php echo $content; ?>
            
            <div class="clear"></div>
            
            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> by <a href='http://www.eurotrade-et.ru'>RGK</a> LLC.<br/>
                All Rights Reserved.<br/>
                <?php echo Yii::powered(); ?>
            </div><!-- footer -->

        </div><!-- page -->
    </body>
</html>