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
            <li><a href='/service/admin/lookup/id/brand'>Производители</a></li>
            <li><a href='/service/admin/lookup/id/country'>Страны</a></li>
            <li><a href='/service/admin/lookup/id/measure'>Единицы измерения</a></li>
        </ul>
    </div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>