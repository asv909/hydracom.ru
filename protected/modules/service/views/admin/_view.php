<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
        
        <b><?php if ($id === 'measure') {
                    echo CHtml::encode($data->getAttributeLabel('unite'));
                    echo ':</b> ' . CHtml::encode($data->unite);
                 } else {
                    echo CHtml::encode($data->getAttributeLabel('name')); 
                    echo ':</b> ' . CHtml::encode($data->name);
                 }
            ?>
	<br />
        
</div>
