<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\controllers\ProfileController;

?>
<div class="container">
    <?php if (Yii::$app->session->hasFlash('successChangePassword')): ?>
        <div class="alert alert-success alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('successChangePassword'); ?>
        </div>
    <?php elseif (Yii::$app->session->hasFlash('noChangePassword')): ?>
        <div class="alert alert-warning alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('noChangePassword'); ?>
        </div>
    <?php elseif (Yii::$app->session->hasFlash('successChangeLogin')): ?>
        <div class="alert alert-success alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('successChangeLogin'); ?>
        </div>
    <?php elseif (Yii::$app->session->hasFlash('noChangeLogin')): ?>
        <div class="alert alert-warning alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('noChangeLogin'); ?>
        </div>
    <?php elseif (Yii::$app->session->hasFlash('successChangeEmail')): ?>
        <div class="alert alert-success alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('successChangeEmail'); ?>
        </div>
    <?php elseif (Yii::$app->session->hasFlash('noChangeEmail')): ?>
        <div class="alert alert-warning alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('noChangeEmail'); ?>
        </div>
    <?php elseif (Yii::$app->session->hasFlash('successChangePhone')): ?>
        <div class="alert alert-success alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('successChangePhone'); ?>
        </div>
    <?php elseif (Yii::$app->session->hasFlash('noChangePhone')): ?>
        <div class="alert alert-warning alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('noChangePhone'); ?>
        </div>
    <?php endif; ?>
    <p>Это личный кабинет покупателя</p>
    <p>Здесь Вы можете:</p>
    <p><?= Html::a('Сменить пароль', ['change-password', 'id' => $model->id])?></p>
    <p><?= Html::a('Сменить логин', ['change-login', 'id' => $model->id])?></p>
    <p><?= Html::a('Сменить e-mail', ['change-email', 'id' => $model->id])?></p>
    <p><?= Html::a('Сменить телефон', ['change-phone', 'id' => $model->id])?></p>
    <?php Yii::$app->session->removeAllFlashes(); ?>
</div>