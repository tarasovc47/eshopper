<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use app\models\OrderItem;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
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
    <h2>Это личный кабинет покупателя</h2>
    <h3>Здесь Вы можете:</h3>
    <p><?= Html::a('Сменить пароль', ['change-password', 'id' => $model->id])?></p>
    <p><?= Html::a('Сменить логин', ['change-login', 'id' => $model->id])?></p>
    <p><?= Html::a('Сменить e-mail', ['change-email', 'id' => $model->id])?></p>
    <p><?= Html::a('Сменить телефон', ['change-phone', 'id' => $model->id])?></p>
    <?php Yii::$app->session->removeAllFlashes(); ?>

    <h3>Ваши заказы</h3>
    <?php $orders = new User(Yii::$app->user->identity); ?>
    <?php $userOrders = $orders->orders; ?>
    <table class="table">
        <thead>
        <tr>
            <td>ID Заказа</td>
            <td>Дата заказа</td>
            <td>Адрес доставки</td>
            <td>Заказ подтверждён</td>
            <td>Статус заказа</td>
            <td>Стоимость</td>
            <td>Количество</td>
            <td>Товары</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($userOrders as $userOrder):?>
        <?php $userItem = OrderItem::find()->where(['order_id' => $userOrder->id])->all(); ?>
        <tr>
            <td><?= $userOrder->id ?></td>
            <td><?= $userOrder->date ?></td>
            <td><?= $userOrder->address ?></td>
            <td><?= $userOrder->confirm ?></td>
            <td><?= $userOrder->status ?></td>
            <td><?= $userOrder->sum ?></td>
            <td><?= $userOrder->quantity ?></td>
            <td>
                <?php foreach ($userItem as $item): ?>
                    <p><a href="<?= Url::to(['product/view', 'id'=>$item->product_id]) ?>"> <?= $item->title;?></a>: <?= $item->product_count;?> шт. * <?= $item->product_price;?> руб.</p>
                <?php endforeach; ?>
            </td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>