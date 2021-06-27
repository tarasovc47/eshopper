<?php

use app\models\Product;
use yii\helpers\Url;

?>

<div class="brands_products">
    <h2>Бренды</h2>
    <div class="brands-name">
        <ul class="nav nav-pills nav-stacked">
            <?php
            foreach ($brands as $brand): ?>
                <li><a href="<?= Url::to(['site/brand', 'id' => $brand->id]) ?>">
                    <span class="pull-right">( <?php Product::brandCount($brand->id); ?> )
                    </span><span class="pull-right"></span><?= $brand->title ?></a></li>
            <?php endforeach;?>
        </ul>
    </div>
</div>