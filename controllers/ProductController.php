<?php
namespace app\controllers;

use app\models\Product;
use Yii;
use yii\web\Controller;

class ProductController extends Controller
{
    public function actionView($id)
    {
        $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        return $this->render('view', compact('product'));
    }
}