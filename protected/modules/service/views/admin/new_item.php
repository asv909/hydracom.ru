<?php
$this->pageTitle = Yii::app()->name . ' - Новый элемент справочника';
$this->breadcrumbs = array('Добавить новый элемент');
?>

<h1>Добавить новый элемент</h1>

<p>Введите данные:</p>

<div class="form">

    <!-- Render with the layout /modules/views/layouts/login.php -->
    <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => $form_id,
            'action' => Helpers::createUrl('/service/admin/add_new/item/' . $item),
            'enableAjaxValidation'=>true,
            'focus'=>array($new_item, 'name'),
    ))?>

    <p class="note">Поля с пометкой <span class="required">*</span> являются обязательными.</p>

    <div class="row">
        <?php echo $form->labelEx($new_item, 'name'); ?>
        <?php echo $form->textField($new_item, 'name'); ?>
        <?php echo $form->error($new_item, 'name'); ?>
        <label for="check">Проверить</label>
    </div>
   
    <div class="row buttons">
        <?php echo CHtml::submitButton('Добавить элемент', array('id' => 'add_new_item')) ?>
    </div>
    
    <div>
        <?php echo $form->errorSummary($new_item, 'При заполнении формы были допущены следующие ошибки:'); ?>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->