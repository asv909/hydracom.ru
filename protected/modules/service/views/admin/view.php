<?php
$this->breadcrumbs = array($dataProvider->model->title);

$this->menu=array(
	array('label'=>'Добавить новый', 'url'=>array('admin/add_new', 'item' => $dataProvider->model->tableName())),
	array('label'=>'Редактировать', 'url'=>array('admin/edit', 'item' => $dataProvider->model->tableName())),
);
?>

<h1><?php echo $dataProvider->model->title ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView'     => '_view',
)); ?>