<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array('Login');
?>

<h1>Аутентификация менеджера</h1>

<p>Введите Ваши регистрационные данные:</p>

<div class="form">

    <!-- Render with the layout /modules/views/layouts/login.php -->
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => $form_id,
        'action' => Helpers::createUrl('/manager'),
        'enableAjaxValidation'=>true,
        'focus'=>array($login_form, 'username'),
    ))?>

    <p class="note">Поля с пометкой <span class="required">*</span> являются обязательными.</p>

    <div class="row">
        <?php echo $form->labelEx($login_form, 'username'); ?>
        <?php echo $form->textField($login_form, 'username'); ?>
        <?php echo $form->error($login_form, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($login_form, 'password'); ?>
        <?php echo $form->passwordField($login_form, 'password'); ?>
        <?php echo $form->error($login_form, 'password'); ?>
    </div>

    <div class="row rememberMe">
        <?php echo $form->checkBox($login_form,'rememberMe'); ?>
        <?php echo $form->label($login_form,'rememberMe'); ?>
        <?php echo $form->error($login_form,'rememberMe'); ?>
    </div>

    <div class="row">
        <?php if(extension_loaded('gd') && Yii::app()->user->isGuest): ?>
            <?php echo $form->labelEx($login_form, 'verifyCode') ?>
            <div>
                <?php $this->widget('CCaptcha', array('clickableImage' => TRUE, 'showRefreshButton' => FALSE)) ?>
                <?php echo $form->textField($login_form, 'verifyCode') ?>
            </div>
		<div class="hint">Введите буквы изобарженные на рисунке.</div>        
            <?php echo $form->error($login_form,'verifyCode'); ?>
        <?php endif ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Войти в систему', array('id' => 'login_manager_button')) ?>
    </div>

<div>
<?php echo $form->errorSummary($login_form, 'При заполнении формы были допущены следующие ошибки:'); ?>
</div>
<?php $this->endWidget(); ?>
</div><!-- form -->