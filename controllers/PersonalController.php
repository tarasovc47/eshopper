<?php

namespace app\controllers;

use yii\web\Controller;

class PersonalController extends Controller
{
    public function actionView()
    {
        return $this->render('/personal/view');
    }
}