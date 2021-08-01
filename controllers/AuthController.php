<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\SignupForm;
use app\models\User;
use Yii;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\IdentityInterface;
use yii\web\Response;

class AuthController extends Controller implements IdentityInterface
{
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) { //если пользователь не гость - возвращаем на главную
            return $this->goHome();
        }

        $model = new LoginForm(); // создаём экземпляр LoginForm
        if ($model->load(Yii::$app->request->post()) && $model->login()) { // если модель передана ПОСТом И пользователь авторизован - возвращаем на предыдущую страницу
            return $this->goBack();
        }

        $model->password = ''; // если пароль в модели пуст - отравляем на авторизацию
        return $this->render('/auth/login', [
            'model' => $model,
        ]);
    }
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout(); //если пользователь вышел - возвращаем на главную
        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm(); // создаём новый экземпляр модели

        if (Yii::$app->request->isPost) // если передано ПОСТом
        {
            $model->load(Yii::$app->request->post()); //загружаем в модель переданное ПОСТом
            if ($model->signup()) // и если регистрация прошла успешно - возвращаем на авторизацию
            {
                return $this->redirect(['auth/login']);
            }
        }

        return $this->render('signup', ['model' => $model]); //возвращаем окно регистрации
    }

    /**
     * @param int|string $id
     * @return IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return User::find($id);
    }

    /**
     * @param mixed $token
     * @param mixed|null $type
     * @return IdentityInterface|null
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * @param string $authKey
     * @return bool|null
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}