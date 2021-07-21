<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

?>
<div class="container">
    <?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'email')->textInput();?>
    <div class="form-group">
        <?= Html::submitButton('Сменить', ['class' => 'btn btn-success'])?>
        <?= Html::a('Отмена', ['/profile/index'], ['class' => 'btn btn-default'])?>
    </div>
    <?php ActiveForm::end() ?>
</div>