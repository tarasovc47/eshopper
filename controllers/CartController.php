<?php


namespace app\controllers;

use app\models\Order;
use yii\base\BaseObject;
use yii\db\Expression;
use yii\web\Controller;
use app\models\Product;
use app\models\Cart;
use Yii;

class CartController extends Controller
{
    public function actionAdd()
    {
        $id = Yii::$app->request->get('id');
        $qty = (int)Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;
        $product = Product::findOne($id);
        if (empty ($product))
        {
            return false;
        }
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }
    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();
        Cart::clearCart($session);
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }
    public function actionDelItem()
    {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        Cart::recalc($id);
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }
    public function actionShow()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionView()
    {
        $session = Yii::$app->session;
        $session->open();
        $order = new Order();
        Cart::viewCart($order, $session);
        return $this->render('/cart/view', compact('session', 'order'));
    }
}