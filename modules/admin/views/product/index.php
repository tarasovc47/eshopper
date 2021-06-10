<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cost',
            'title',
            'gender',
            'brand_id',
            [
                'format' => 'html',
                'label' => 'Image',
                'value' => function($data){
                    return Html::img($data->showImage(), ['width' => 200]);
                }
            ],
            //'category',
            //'hidden',
            //'new',
            //'sale',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
