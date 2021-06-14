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

    public function signup()
    {
        if ($this->validate())
        {
            $user = new User();
            $user->attributes = $this->attributes;
            return $user->create();
        }
    }
}