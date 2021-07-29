<?php

use app\models\Order;
use app\models\OrderStatus;
use app\models\User;
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
            'user_id' =>
            [
                'label' => 'Покупатель',
                'attribute' => 'user_id',
                'value' => function($data)
                {
                    $user = User::find()->where(['id' => $data->user_id])->one();
                    return $user->name . ' ' . $user->surname;
                },
                'filter' => ArrayHelper::map(User::find()->all(), 'id', 'email'),
            ],
            'quantity',
            'sum',
            'confirm' =>
            [
                'label' => 'Заказ подтверждён',
                'attribute' => 'confirm',
                'filter' => array('0' => 'Не подтверждён', '1' => 'Подтверждён'),
                'value' => function($data)
                {
                    $confirm = Order::find()->where(['confirm' => $data->confirm])->one();
                    return ($confirm->confirm) ? 'Подтверждён' : 'Не подтверждён';
                }
            ],
            'status_id' =>
                [
                    'label' => 'Статус',
                    'attribute' => 'status_id',
                    'filter' => ArrayHelper::map(OrderStatus::find()->all(), 'id', 'status'),
                    'value' => function($data)
                    {
                        $status = OrderStatus::find()->where(['id' => $data->status_id])->one();
                        return $status->status;
                    }
                ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
