<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends  Model
{
    public $name;
    public $surname;
    public $gender;
    public $login;
    public $email;
    public $password;
    public $phone;

    public function rules()
    {
        return [
            [['name','surname','gender','login','email','password','phone'], 'required'],
            [['name','surname','login'],'string'],
            [['email'],'email'],
            [['email'], 'unique', 'targetClass'=>'app\models\User','targetAttribute'=>'email'],
            [['login'], 'unique', 'targetClass'=>'app\models\User','targetAttribute'=>'login'],
        ];
    }

    public function attributeLabels()
    {
        return [
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

    public function signup()
    {
        if ($this->validate()) // если валидацию прошли
        {
            $user = new User(); //создаём новый экземпляр класса Юзер
            $user->attributes = $this->attributes; // добавляем ему все аттрибуты из формы
            return $user->create(); // и создаём пользователя
        }
    }
}