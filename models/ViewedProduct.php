<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "viewed_products".
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $user_id
 */
class ViewedProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'viewed_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'user_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'user_id' => 'User ID',
        ];
    }
}
