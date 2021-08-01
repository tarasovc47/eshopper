<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $password;
    public $identity;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            //[['username', 'password', 'email'], 'required'],
            [['identity', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'identity' => 'Логин/Email',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) { // если в валидации нет ошибок
            $user = $this->getUser(); // то кладём в переменную Юзер найденного по логину или емайл пользователя

            if (!$user || !$user->validatePassword($this->password)) { // если пользователя нет ИЛИ пароль не прошёл валидацию
                $this->addError($attribute, 'Неправильный логин/E-Mail или пароль'); // возвращаем ЛОЖЬ
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) { // если валидация пройдена
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0); // возвращаем залогиненого пользователя
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) { //проверяем, что пользователь не залогинен
            $this->_user = User::findIdentityByLoginOrEmail($this->identity); // кладём в пользователя то что нашли по логину и емайлу
        }
        return $this->_user; // или просто возвращаем пользователя
    }
}
