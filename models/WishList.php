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
class WishList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wish_list';
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

    public function checkWish($user_id = null)
    {
        if ($user_id == null)
        {
            return false;
        }
        else return $this::find()->all();
    }

    public function addToWish($product_id, $user_id)
    {
        $this->user_id = $user_id;
        $this->product_id = $product_id;
        $this->save();
    }

    public function removeWish($product_id, $user_id)
    {
        $wish = $this::find()->where(['user_id' => $user_id])->andWhere(['product_id' => $product_id])->one();
        $wish->delete();
    }
}