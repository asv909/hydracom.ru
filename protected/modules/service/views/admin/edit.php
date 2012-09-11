<?php
$this->pageTitle = Yii::app()->name . ' - Редактирование элемента справочника';
$this->breadcrumbs = array('Редактировать элемент');
?>

<h1>Редактировать элемент</h1>

<p>Отредактируйте данные:</p>

<div class="form">

    <!-- Render with the layout /modules/views/layouts/login.php -->
    <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => $formName,
            'action' => Helpers::createUrl('/service/admin/edit/item/' . $item . '/id/' . $id),
            'enableAjaxValidation'=>true,
            'focus'=>array($data, 'name'),
    ))?>

    <div class="row">
        <?php echo $form->labelEx($data, 'name'); ?>
        <?php echo $form->textField($data, 'name'); ?>
        <?php echo $form->error($data, 'name'); ?>
        <label for="check">Проверить</label>
    </div>
   
    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить изменения', array('id' => 'edit_item')) ?>
    </div>
    
    <div>
        <?php echo $form->errorSummary($data, 'При заполнении формы были допущены следующие ошибки:'); ?>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->