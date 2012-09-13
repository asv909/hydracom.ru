<?php
/**
 * used AdminController.actionReview
 */

$this->breadcrumbs = array($model->title);

$this->menu = array(array('label' => 'Добавить новый', 
                          'url'   => array('admin/add_new', 
                                           'item' => $model->tableName())),);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo $model->title ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'           => 'user-grid',
	'dataProvider' => $model->search(),
        'filter'       => $model,
        'summaryText'  => 'Показано {start}-{end} из {count}.',
        'pager'        => array(
            'class'         => 'CLinkPager',
            'header'        => 'Перейти на стр.: ',
            'prevPageLabel' => '&lt',
            'nextPageLabel' => '&gt',
        ),
	'columns' => array(
            array(
                'name'  => 'name',
                'value' => 'CHtml::link($data->name, array(
                    "/service/admin/edit/item/"
                    . $data->tableName()
                    . "/id/"
                    . $data->id))',
                'type'     => 'html',
                'sortable' => TRUE,
            ),
        ),
)); ?>