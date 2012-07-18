<?php
/*$this->breadcrumbs=array('Users',);

$this->menu=array(
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
*/?>

<h1><?php echo $title ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView'     => '_view',
        'viewData'     => array('title' => $title),
)); ?>