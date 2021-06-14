<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

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
class User extends \yii\db\ActiveRecord implements IdentityInterface
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
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'gender' => 'Пол',
            'login' => 'Логин',
            'email' => 'E-Mail',
            'password' => 'Пароль',
            'phone' => 'Телефон',
            'confirm' => 'Подтверждён',
            'isAdmin' => 'Администратор',
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

    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public static function findByUsername($username)
    {
        return User::find()->where(['login' => $username])->one();
    }

    public function validatePassword($password)
    {
        return $this->password == $password;
    }

    public function create()
    {
        return $this->save(false);
    }
}
