<?php


namespace app\controllers;

use app\models\Order;
use app\models\OrderItem;
use yii\base\BaseObject;
use yii\db\Expression;
use yii\helpers\Url;
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
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.cost');
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }
    public function actionDelItem()
    {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
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
        if ($order->load(Yii::$app->request->post()))
        {
            $order->user_id = Yii::$app->user->id;
            if ($order->user_id == null)
            {
                Yii::$app->session->setFlash('need_auth', 'Для продолжения необходимо <a href="' . URl::toRoute(['auth/signup']) . '">зарегистрироваться</a> или <a href="' . URl::toRoute(['auth/login']) . '">войти</a> под своей учётной записью');
                $this->refresh();
            }
            $order->date = new Expression('NOW()');
            $order->quantity = $session['cart.qty'];
            $order->sum = $session['cart.cost'];
            if ($order->save())
            {
                $this->saveOrderItems($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Ваш заказ принят, менеджер свяжется с вами в ближайшее время');
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.cost');
                return $this->refresh();
            }
            else
            {
                Yii::$app->session->setFlash('error', 'Произошла ошибка');
            }
        }
        return $this->render('/cart/view', compact('session', 'order'));
    }

    protected function saveOrderItems($items, $order_id)
    {
        foreach ($items as $id => $item)
        {
            $orderItems = new OrderItem();
            $orderItems->order_id = $order_id;
            $orderItems->product_id = $id;
            $orderItems->title = $item['title'];
            $orderItems->product_count = $item['qty'];
            $orderItems->product_price = $item['cost'];
            $orderItems->order_sum = $item['qty'] * $item['cost'];
            $orderItems->save();
        }
    }
}