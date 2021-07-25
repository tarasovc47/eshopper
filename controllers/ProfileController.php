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
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

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

    public function actionChangeSettings()
    {
        $user = User::findOne(Yii::$app->user->identity->id);
        $request = Yii::$app->request;
        if (Yii::$app->request->post() != null)
        {
            $user->password = $request->post()['User']['password'];
            $user->login = $request->post()['User']['login'];
            $user->email = $request->post()['User']['email'];
            $user->phone = $request->post()['User']['phone'];
            if ($user->save(false))
            {
                Yii::$app->session->setFlash('successChange', 'Success');
                return $this->render('index');
            }
        }
        Yii::$app->session->setFlash('noChange', 'No change');
        return $this->render('changeSettings', ['model' => $user]);
    }
}