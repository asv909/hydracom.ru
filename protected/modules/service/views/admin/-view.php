<div class="view">
        <b><?php echo CHtml::link(CHtml::encode($data->name),  array(
            'admin/look', 
            'item' => $data->tableName(), 
            'id' => $data->id,
        )); ?></b>
	<br />
</div>
