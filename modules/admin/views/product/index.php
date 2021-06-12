<?php

use app\models\Category;
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
            'gender' =>
                [
                    'format' => 'text',
                    'label' => 'Пол',
                    'value' => function($data){
                        return $data['gender'] == 'М' ? 'Мужское' : 'Женское';
                    },
                ],
            'brand_id' =>
                [
                    'value' => 'brand.title',
                    'label' => 'Бренд',
                ],
            'category_id' =>
                [
                    'value' => 'category.title',
                    'label' => 'Категория',
                ],
            [
                'format' => 'html',
                'label' => 'Image',
                'value' => function($data){
                    return Html::img($data->showImage(), ['width' => 200]);
                }
            ],
            [
                'format' => 'text',
                'label' => 'Новинка',
                'value' => function($data){
                    return ($data['new'] == '0') ? 'Нет' :  'Да';
                }
            ],
            //'hidden',
            //'new',
            //'sale',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
