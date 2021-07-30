<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Url;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $address
 * @property string $date
 * @property int $user_id
 * @property int|null $confirm
 * @property string|null $status_id
 *
 * @property OrderItem[] $orderItems
 * @property User $user0
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address', 'date', 'user_id', 'quantity', 'sum'], 'required'],
            [['date'], 'safe'],
            [['user_id', 'confirm', 'quantity', 'sum'], 'integer'],
            [['address', 'status_id'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'Адрес доставки',
            'date' => 'Дата заказа',
            'quantity' => 'Количество',
            'sum' => 'Сумма',
            'user_id' => 'Покупатель',
            'confirm' => 'Подтверждён',
            'status_id' => 'Статус',
        ];
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }

    public function saveOrder($user_id, $session)
    {
        $this->user_id = $user_id;
        if ($this->user_id == null)
        {
            Yii::$app->session->setFlash('need_auth', 'Для продолжения необходимо <a href="' . URl::toRoute(['auth/signup']) . '">зарегистрироваться</a> или <a href="' . URl::toRoute(['auth/login']) . '">войти</a> под своей учётной записью');
            $this->refresh();
        }
        $this->date = new Expression('NOW()');
        $this->quantity = $session['cart.qty'];
        $this->sum = $session['cart.cost'];
        if ($this->save())
        {
            OrderItem::saveOrderItems($session['cart'], $this->id);
            Yii::$app->session->setFlash('success', 'Ваш заказ принят, менеджер свяжется с вами в ближайшее время');
            $session->remove('cart');
            $session->remove('cart.qty');
            $session->remove('cart.cost');
            return $this->refresh();
        }
    }
}
