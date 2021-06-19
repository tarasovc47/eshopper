<?php


namespace app\controllers;

use yii\web\Controller;
use app\models\Product;
use app\models\Cart;
use Yii;
use yii\web\Response;

class CartController extends Controller
{
    public function actionAdd()
    {
        $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        if (empty ($product))
        {
            return false;
        }
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product);
        return $this->render('cart-modal', compact('session'));
    }
}