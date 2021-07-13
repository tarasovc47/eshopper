<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<div class="container">

    <?php

    if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?= Yii::$app->session->getFlash('success'); ?>
    </div>
    <?php elseif (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?= Yii::$app->session->getFlash('error'); ?>
    </div>
    <?php endif; ?>

    <?php if (!empty($session['cart'])) : ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="cart-table">
                <thead>
                    <tr>
                        <th>Фото</th>
                        <th>Наименование</th>
                        <th>Количество</th>
                        <th>Цена</th>
                        <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($session['cart'] as $id => $item): ?>
                    <tr>
                        <td><a href="<?= Url::to(['/product/view', 'id' => $id]) ?>"><?= Html::img("@web/uploads/{$item['image']}", ['alt' => $item['title'], 'height' => 100]) ?></a></td>
                        <td><a href="<?= Url::to(['/product/view', 'id' => $id]) ?>"><?= $item['title'] ?></a></td>
                        <td><?= $item['qty'] ?></td>
                        <td><?= $item['cost'] ?></td>
                        <td><span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item" style="cursor: pointer" aria-hidden="true"></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4">Итого</td>
                    <td><?= $session['cart.qty'] ?></td>
                </tr>
                <tr>
                    <td colspan="4">Сумма</td>
                    <td><?= $session['cart.cost'] ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <?php $form = ActiveForm::begin()?>
            <?= $form->field($order, 'address'); ?>
            <?= Html::submitButton('Заказать', ['class' => 'btn btn-success'] ) ?>
        <?php ActiveForm::end()?>
    <?php else:?>
        <h3>Корзина пуста</h3>
    <?php endif ?>
</div>
