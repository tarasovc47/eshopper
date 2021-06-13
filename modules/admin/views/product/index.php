<?php

use app\models\BrandSearch;
use app\models\Category;
use app\models\CategorySearch;
use app\models\ProductSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
const MALE = 'Мужское';
const FEMALE = 'Женское';
const NEW_PRODUCT = 'Новинка';
const NOT_NEW_PRODUCT = 'Не новинка';
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
                    'attribute' => 'gender',
                    'filter' => array('М' => MALE, 'Ж' => FEMALE)
                ],
            'brand_id' =>
                [
                    'value' => 'brand.title',
                    'label' => 'Бренд',
                    'attribute' => 'brand_id',
                    'filter' => ArrayHelper::map(BrandSearch::find()->all(), 'id', 'title'),
                ],
            'category_id' =>
                [
                    'value' => 'category.title',
                    'label' => 'Категория',
                    'attribute' => 'category_id',
                    'filter' => ArrayHelper::map(CategorySearch::find()->all(), 'id', 'title'),
                ],
            [
                'format' => 'html',
                'label' => 'Фото',
                'value' => function($data){
                    return Html::img($data->showImage(), ['width' => 200]);
                }
            ],
            [
                'format' => 'text',
                'label' => 'Новинка',
                'value' => function($data){
                    return ($data['new'] == '0') ? 'не новинка' :  'новинка';
                },
                'attribute' => 'new',
                'filter' => array('0' => NOT_NEW_PRODUCT, '1' => NEW_PRODUCT)
            ],
            [
                'format' => 'text',
                'label' => 'Снят с продажи',
                'value' => function($data){
                    return ($data['hidden'] == '0') ? 'в продаже' :  'снят';
                },
                'attribute' => 'hidden',
                'filter' => array('0' => 'в продаже', '1' => 'снят с продажи')
            ],
            [
                'format' => 'text',
                'label' => 'Распродажа',
                'value' => function($data){
                    return ($data['sale'] == '0') ? 'не участвует' :  'распродажа';
                },
                'attribute' => 'sale',
                'filter' => array('0' => 'не участвует', '1' => 'распродажа')
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
