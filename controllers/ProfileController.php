<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller
{
    public $model;
    public function actionIndex()
    {
        $model = new User();
        if ($model === null) {
            throw new NotFoundHttpException;
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionChangePassword()
    {
        $model = new User();
        if ($model->changePassword($_POST))
        {
            Yii::$app->session->setFlash('successChangePassword', 'Пароль успешно изменён!');
            return $this->render('index');
        }
        if ($model->changePassword($_POST) == null)
        {
            Yii::$app->session->setFlash('noChangePassword', 'Пароль не был изменён!');
        }
    return $this->render('changePassword', ['model' => $model]);
    }

    public function actionChangeLogin()
    {
        $model = new User();
        if ($model->changeLogin($_POST))
        {
            Yii::$app->session->setFlash('successChangeLogin', 'Логин успешно изменён!');
            return $this->render('index');
        }
        if ($model->changeLogin($_POST) == null)
        {
            Yii::$app->session->setFlash('noChangeLogin', 'Логин не был изменён!');
        }
        return $this->render('changeLogin', ['model' => $model]);
    }

    public function actionChangeEmail()
    {
        $model = new User();
        if ($model->changeEmail($_POST))
        {
            Yii::$app->session->setFlash('successChangeEmail', 'Email успешно изменён!');
            return $this->render('index');
        }
        if ($model->changeEmail($_POST) == null)
        {
            Yii::$app->session->setFlash('noChangeEmail', 'Email не был изменён!');
        }
        return $this->render('changeEmail', ['model' => $model]);
    }

    public function actionChangePhone()
    {
        $model = new User();
        if ($model->changePhone($_POST))
        {
            Yii::$app->session->setFlash('successChangePhone', 'Телефон успешно изменён!');
            return $this->render('index');
        }
        if ($model->changePhone($_POST) == null)
        {
            Yii::$app->session->setFlash('noChangePhone', 'Телефон не был изменён!');
        }
        return $this->render('changePhone', ['model' => $model]);
    }
}