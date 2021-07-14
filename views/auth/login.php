<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-comment mr0">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="site-login">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>Введите логин/e-mail и пароль от своей учётной записи</p>

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-2 control-label'],
                    ],
                ]); ?>
                    <?= $form->field($model,'identity')->textInput() ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    ])?>
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->getCsrfToken(); ?>" />

                    <div class="form-group">
                        <div class="col-lg-offset-1 col-lg-11">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>