<?php

use yii\helpers\Url;

?>

<h2>Категории</h2>
<div class="panel-group category-products" id="accordian"><!--category-productsr-->
    <?php foreach ($categories as $category): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordian" href="#<?= $category->id; ?>">
                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                        <?= $category->title; ?>
                    </a>
                </h4>
            </div>
            <div id="<?= $category->id  ?>" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        <?php foreach ($brands as $brand):?>
                        <li>
                            <a href="<?= Url::to(['category/view', 'id' => $brand->id])  ?>">

                            </a>
                        </li>
                        <?php endforeach; ?>
                        <!--<li><a href="#">Under Armour </a></li>
                        <li><a href="#">Adidas </a></li>
                        <li><a href="#">Puma</a></li>
                        <li><a href="#">ASICS </a></li>-->
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!--<div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                    Mens
                </a>
            </h4>
        </div>
        <div id="mens" class="panel-collapse collapse">
            <div class="panel-body">
                <ul>
                    <li><a href="#">Fendi</a></li>
                    <li><a href="#">Guess</a></li>
                    <li><a href="#">Valentino</a></li>
                    <li><a href="#">Dior</a></li>
                    <li><a href="#">Versace</a></li>
                    <li><a href="#">Armani</a></li>
                    <li><a href="#">Prada</a></li>
                    <li><a href="#">Dolce and Gabbana</a></li>
                    <li><a href="#">Chanel</a></li>
                    <li><a href="#">Gucci</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordian" href="#womens">
                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                    Womens
                </a>
            </h4>
        </div>
        <div id="womens" class="panel-collapse collapse">
            <div class="panel-body">
                <ul>
                    <li><a href="#">Fendi</a></li>
                    <li><a href="#">Guess</a></li>
                    <li><a href="#">Valentino</a></li>
                    <li><a href="#">Dior</a></li>
                    <li><a href="#">Versace</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title"><a href="#">Kids</a></h4>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title"><a href="#">Fashion</a></h4>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title"><a href="#">Households</a></h4>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title"><a href="#">Interiors</a></h4>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title"><a href="#">Clothing</a></h4>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title"><a href="#">Bags</a></h4>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title"><a href="#">Shoes</a></h4>
        </div>
    </div>-->
</div><!--/category-products-->