<?php

use app\models\Product;
use yii\helpers\Url;

?>

<div class="brands_products">
<<<<<<< HEAD
    <h2>Бренды</h2>
=======
    <h2>Brands</h2>
>>>>>>> fc42bcf9d16c544b745798457a39eb32726f751e
    <div class="brands-name">
        <ul class="nav nav-pills nav-stacked">
            <?php
            foreach ($brands as $brand): ?>
                <li><a href="<?= Url::to(['brands/view', 'id' => $brand->id]) ?>">
                    <span class="pull-right">(
                        <?php
                        Product::brandCount($brand->id);
                        ?> )
                    </span><span class="pull-right"></span><?= $brand->title ?></a></li>
            <?php endforeach;?>
        </ul>
    </div>
</div>