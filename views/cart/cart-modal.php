<?php

use yii\helpers\Html;
use yii\helpers\Url;

if (!empty($session['cart'])) : ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
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
<?php else:?>
    <h3>Корзина пуста</h3>
<?php endif ?>
