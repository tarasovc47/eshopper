<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="container">
    <?php if (Yii::$app->session->hasFlash('successChangePassword')): ?>
        <div class="alert alert-success alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('successChangePassword'); ?>
        </div>
    <?php endif; ?>
    <p>Это личный кабинет покупателя</p>
    <p>Здесь Вы можете:</p>
    <?= Html::a('Сменить пароль', ['change-password', 'id' => $model->id])?>
</div>