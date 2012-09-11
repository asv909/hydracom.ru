<?php
$this->breadcrumbs = array($dataProvider->model->title);

$this->menu=array(
	array('label'=>'Добавить новый', 'url'=>array('admin/add_new', 'item' => $dataProvider->model->tableName())),
	//array('label'=>'Редактировать', 'url'=>array('admin/edit', 'item' => $dataProvider->model->tableName())),
);
?>

<h1><?php echo $dataProvider->model->title ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $dataProvider,
        //'summaryText' => 'Показано {start}-{end} из {count}.',
	'columns' => array(
            //'id',
            array(
                'class'=>'CLinkColumn',
                'labelExpression' => '$data->name',
                'urlExpression' => '"/service/admin/edit/item/" . $data->tableName() . "/id/" . $data->id',
                'header' => $dataProvider->model->getAttributeLabel('name'),
            ),
        ),
)); ?>