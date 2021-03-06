<?php
/**
 * used AdminController.actionAdd_new
 */

$this->pageTitle = Yii::app()->name . ' - Новый элемент справочника';
$this->breadcrumbs = array('Добавить новый элемент');
?>

<h1>Добавить новый элемент</h1>

<p>Введите данные:</p>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
            'id'     => $formName,
            'action' => Helpers::createUrl('/service/admin/add_new/item/' . $item),
            'enableAjaxValidation' => true,
            'focus'  => array($newItem, 'name'),
    ))?>

    <p class="note">Поля с пометкой <span class="required">*</span> являются обязательными.</p>

    <div class="row">
        <?php echo $form->labelEx($newItem, 'name'); ?>
        <?php echo $form->textField($newItem, 'name'); ?>
        <?php echo $form->error($newItem, 'name'); ?>
        <label for="check">Проверить</label>
    </div>
   
    <div class="row buttons">
        <?php echo CHtml::submitButton('Добавить элемент', array('id' => 'add_new_item')) ?>
    </div>
    
    <div>
        <?php echo $form->errorSummary($newItem, 'При заполнении формы были допущены следующие ошибки:'); ?>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->