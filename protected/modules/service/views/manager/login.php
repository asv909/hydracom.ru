<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'login_form',
    'action' => Helpers::createUrl('/manager_login'), 
))?>

<p>Вход в систему:</p>

<p>
    <?php echo $form->labelEx($login_form, 'username'); ?>
    <?php echo $form->textField($login_form, 'username'); ?>
    <?php echo $form->error($login_form, 'username'); ?>
</p>

<p>
    <?php echo $form->labelEx($login_form, 'password'); ?>
    <?php echo $form->passwordField($login_form, 'password'); ?>
    <?php echo $form->error($login_form, 'password'); ?>
</p>

<p>
    <?php echo $form->checkBox($login_form,'rememberMe'); ?>
    <?php echo $form->label($login_form,'rememberMe'); ?>
    <?php echo $form->error($login_form,'rememberMe'); ?>
</p>

<p>
    <?php if(extension_loaded('gd') && Yii::app()->user->isGuest): ?>
        <?php echo $form->labelEx($login_form, 'verifyCode') ?><br/>
        <?php $this->widget('CCaptcha', array('buttonLabel'=>'Обновить код', 'buttonType' => 'button')) ?>
        <?php echo $form->textField($login_form, 'verifyCode') ?>
        <?php echo $form->error($login_form, 'verifyCode');?>
    <?php endif ?>
</p>

<p>
    <?php echo CHtml::submitButton('Войти в систему', array('id' => 'login_manager_button')) ?>
</p>

<?php $this->endWidget(); ?>