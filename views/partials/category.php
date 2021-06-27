<?php

use yii\helpers\Url;

?>

<h2>Категории</h2>
<div class="panel-group category-products" id="accordian">
    <?php foreach ($categories as $category): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a href="<?= Url::to(['site/category', 'id' => $category->id]) ?>" ><?= $category->title  ?></a>
                </h4>
            </div>
        </div>
    <?php endforeach; ?>
</div>