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
        if (Yii::$app->request->isPost)
        {
            if ($model->changePassword($_POST))
            {
                Yii::$app->session->setFlash('successChangePassword', 'Пароль успешно изменён!');
                return $this->render('index');
            }
        }
        return $this->render('changePassword', ['model' => $model]);
    }
}