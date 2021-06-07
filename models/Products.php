<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property int $cost
 * @property string $title
 * @property string $gender
 * @property string|null $brand
 * @property string|null $category
 * @property int|null $hidden
 * @property int|null $new
 * @property int|null $sale
 *
 * @property OrderItems[] $orderItems
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cost', 'title', 'gender'], 'required'],
            [['cost', 'hidden', 'new', 'sale'], 'integer'],
            [['title', 'gender', 'brand', 'category'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cost' => 'Cost',
            'title' => 'Title',
            'gender' => 'Gender',
            'brand' => 'Brand',
            'category' => 'Category',
            'hidden' => 'Hidden',
            'new' => 'New',
            'sale' => 'Sale',
        ];
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['product_id' => 'id']);
    }
}
