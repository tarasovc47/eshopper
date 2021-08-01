<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\base\BaseObject;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'] // разрешаем доступ в контроллер только авторизованным, остальных выкидывает на страницу логина
                    ]
                ]
            ]
        ];
    }

    public $model;
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionChangeSettings()
    {
        $user = User::findOne(Yii::$app->user->identity->id); // находим пользователя и кладём в $user
        if ($user->load(Yii::$app->request->post())) // если в юзера загружаем что-то ПОСТом
        {
            if ($user->save(false)) // то сохраняем в БД
            {
                Yii::$app->session->setFlash('successChange', 'Success'); // задаём флеш-сообщение
                return $this->render('index'); // и возвращаем главную страницу личного кабинета
            }
        }
        return $this->render('changeSettings', ['model' => $user]); // отрисовываем страницу изменения настроек
    }
}