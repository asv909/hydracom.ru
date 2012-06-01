<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'login_form',
    'action' => Helpers::createUrl('/service/manager/login'), 
))?>

<p>Для входа в систему введите в поля формы <br/>Ваши логин, пароль и нажмите кнопку <br/>"Войти в систему"</p>
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
    <?php echo CHtml::submitButton('Войти в систему', array('id' => 'login_manager_button')) ?>
</p>

<?php $this->endWidget(); ?>