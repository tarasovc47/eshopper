<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
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
            'email' => 'E-mail',
            'password' => 'Пароль',
            'phone' => 'Мобильный телефон',
            'confirm' => 'Подтверждённая учётная запись',
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
        return $this->hasMany(Order::className(), ['user_id' => 'id']);
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

    public static function findByUsername($username,$email)
    {
        return User::find()->where(['login' => $username])->andWhere(['email' => $email])->one();
    }

    public function validatePassword($password)
    {
        return ($this->password == $password) ? true : false;
    }
    public function validateEmail($email)
    {
        return ($this->email == $email) ? true : false;
    }

    public function create()
    {
        return $this->save(false);
    }

    public static function findIdentityByLoginOrEmail($identity)
    {
        if ($user = static::findOne(['login' => $identity]))
        {
            return $user;
        }

        if ($user = static::findOne(['email' => $identity]))
        {
            return $user;
        }
        return null;
    }

    public function changePassword($data)
    {
        $newPassword = ArrayHelper::getValue($data, 'User.password');
        if($newPassword != null)
        {
            $query = Yii::$app->db;
            $query->createCommand('UPDATE `users` SET `password`="' . $newPassword . '" WHERE `id`=' . Yii::$app->user->id)->execute();
            return true;
        }
    }

    public function changeLogin($data)
    {
        $newLogin = ArrayHelper::getValue($data, 'User.login');
        if($newLogin != null)
        {
            $query = Yii::$app->db;
            if ( $query->createCommand('UPDATE `users` SET `login`="' . $newLogin . '" WHERE `id`=' . Yii::$app->user->id)->execute())
            {
                return true;
            }
        }
    }

    public function changeEmail($data)
    {
        $newEmail = ArrayHelper::getValue($data, 'User.email');
        if($newEmail != null)
        {
            $query = Yii::$app->db;
            if ( $query->createCommand('UPDATE `users` SET `email`="' . $newEmail . '" WHERE `id`=' . Yii::$app->user->id)->execute())
            {
                return true;
            }
        }
    }

    public function changePhone($data)
    {
        $newPhone = ArrayHelper::getValue($data, 'User.phone');
        if($newPhone != null)
        {
            $query = Yii::$app->db;
            if ( $query->createCommand('UPDATE `users` SET `phone`="' . $newPhone . '" WHERE `id`=' . Yii::$app->user->id)->execute())
            {
                return true;
            }
        }
    }
}
