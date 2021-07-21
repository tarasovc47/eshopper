<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="container">
    <?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'password')->passwordInput();?>
    <div class="form-group">
        <?= Html::submitButton('Сменить', ['class' => 'btn btn-success'])?>
        <?= Html::a('Отмена', ['/profile/index'], ['class' => 'btn btn-default'])?>
    </div>
    <?php ActiveForm::end() ?>
</div>