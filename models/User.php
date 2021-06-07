<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $gender
 * @property int|null $login
 * @property string $email
 * @property string $password
 * @property int $phone
 * @property int|null $confirm
 * @property int|null $isAdmin
 *
 * @property Order[] $orders
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'gender', 'email', 'password', 'phone'], 'required'],
            [['login', 'phone', 'confirm', 'isAdmin'], 'integer'],
            [['name', 'surname', 'gender', 'email', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'gender' => 'Gender',
            'login' => 'Login',
            'email' => 'Email',
            'password' => 'Password',
            'phone' => 'Phone',
            'confirm' => 'Confirm',
            'isAdmin' => 'Is Admin',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['user' => 'id']);
    }
}
