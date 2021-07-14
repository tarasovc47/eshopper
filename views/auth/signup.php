<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-comment mr0">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="site-login">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>Пожалуйста заполните все поля</p>

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-2 control-label'],
                    ],
                ]); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'surname')->textInput() ?>

                <?= $form->field($model, 'gender')->dropDownList([
                    'М' => 'Мужской',
                    'Ж' => 'Женский'
                ]) ?>

                <?= $form->field($model, 'login')->textInput() ?>

                <?= $form->field($model, 'email')->textInput() ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
                    'mask' => '79999999999',
                ]) ?>

                <div class="form-group">
                    <div class="col-lg-offset-1 col-lg-11">
                        <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

