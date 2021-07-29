<?php

use app\models\OrderStatus;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'address',
            'date',
            'user_id',
            'quantity',
            'sum',
            'confirm',
            'status_id' =>
                [
                    'label' => 'Статус',
                    'attribute' => 'status_id',
                    'filter' => ArrayHelper::map(OrderStatus::find()->all(), 'id', 'status'),
                ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
