<?php $this->beginContent('/layouts/main'); ?>
<div style="float:left;margin-right:10px;">
    <div style="padding: 20px;">
        <?php echo $content; ?>
    </div><!-- content -->
</div>
<div style="float:left;width:220px;margin-right:0;padding-right:0;">
    <div style="padding: 20px 20px 20px 0;">
<?php
//		$this->beginWidget('zii.widgets.CPortlet', array(
//			'title'=>'Operations',
//		));
//		$this->widget('zii.widgets.CMenu', array(
//			'items'=>$this->menu,
//			'htmlOptions'=>array('class'=>'operations'),
//		));
//		$this->endWidget();
?>
        <ul>
            <li>Справочники для номенклатуры
                <ul>
                    <li><a href='/service/admin/look/id/brand'>Бренды</a></li>
                    <li><a href='/service/admin/look/id/country'>Страны</a></li>
                    <li><a href='/service/admin/look/id/measure'>Единицы измерения</a></li>
                </ul>
            </li>
            <li>Справочники для контрагентов
                <ul>
                    <li><a href='/service/admin/look/id/post'>Индексы</a></li>
                    <li><a href='/service/admin/look/id/region'>Регионы</a></li>
                    <li><a href='/service/admin/look/id/city'>Города</a></li>
                    <li><a href='/service/admin/look/id/org'>ОПФ</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>