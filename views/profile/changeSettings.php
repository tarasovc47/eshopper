<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

?>
<div class="container">
    <?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'password')->passwordInput();?>
    <?= $form->field($model, 'login')->textInput()?>
    <?= $form->field($model, 'email')->textInput();?>
    <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
        'mask' => '79999999999',
    ]) ?>
    <div class="form-group">
        <?= Html::submitButton('Сменить', ['class' => 'btn btn-success'])?>
        <?= Html::a('Отмена', ['/profile/index'], ['class' => 'btn btn-default'])?>
    </div>
    <?php ActiveForm::end() ?>
</div>