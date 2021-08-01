<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_items".
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $product_count
 * @property int $product_price
 *
 * @property Order $order
 * @property Product $product
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'product_count', 'product_price', 'title', 'order_sum'], 'required'],
            [['order_id', 'product_id', 'product_count', 'product_price', 'order_sum'], 'integer'],
            [['title'], 'string'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'product_count' => 'Product Count',
            'product_price' => 'Product Price',
            'title' => 'Product title',
            'order_sum' => 'Order sum',
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public static function saveOrderItems($items, $order_id) // функция сохранения товаров заказов в отдельной таблице
    {
        foreach ($items as $id => $item)
        {
            $orderItems = new OrderItem(); // инициализируем новый экземпляр класса
            $orderItems->order_id = $order_id; // и передаём ему всё что пришло из заказа
            $orderItems->product_id = $id;
            $orderItems->title = $item['title'];
            $orderItems->product_count = $item['qty'];
            $orderItems->product_price = $item['cost'];
            $orderItems->order_sum = $item['qty'] * $item['cost'];
            $orderItems->save(); // сохраняем
        }
    }
}
