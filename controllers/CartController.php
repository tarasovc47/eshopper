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
        $id = Yii::$app->request->get('id'); // записываем в переменную $id переданное ГЕТом значение id
        $qty = (int)Yii::$app->request->get('qty'); // записываем в переменную $qty переданное ГЕТом значение qty с преобразованием в int
        $qty = !$qty ? 1 : $qty; // если qty пуст, то по дефолту значение 1, если не пуст - то тогда записываем в qty то, что передано
        $product = Product::findOne($id); // находим товар по id
        if (empty ($product)) // если не нашли - возвращаем ЛОЖЬ
        {
            return false;
        }
        $session = Yii::$app->session;
        $session->open(); // открываем сессию
        $cart = new Cart(); // инициализируем новый экземпляр класса Корзина
        $cart->changeCart($product, $qty); // передаём в функцию товар и количество
        $this->layout = false; // убираем шаблон main из модального окна
        return $this->render('cart-modal', compact('session'));// отрисовываем модальное окно
    }
    public function actionClear()
    {
        $session = Yii::$app->session; // объявляю сессию и открываю её
        $session->open();
        Cart::clearCart($session); // очищаем корзину
        $this->layout = false; // отменяем шаблон main для модального окна
        return $this->render('cart-modal', compact('session')); // отрисовываем модальное окно и передаём туда сессию
    }
    public function actionDelItem()
    {
        $id = Yii::$app->request->get('id'); // записываем в переменную $id переданное ГЕТом значение id
        $session = Yii::$app->session; // объявляю сессию и открываю её
        $session->open();
        Cart::recalc($id); // вызываем пересчёт стоимости в корзине
        $this->layout = false; // отменяем шаблон main
        return $this->render('cart-modal', compact('session')); // отрисовываем окно и передаём сессию
    }
    public function actionShow() // просто отрисовка модального окна и передача в него сессии
    {
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionView() // переход на страницу "Корзина"
    {
        $session = Yii::$app->session; // объявляю сессию и открываю её
        $session->open();
        $order = new Order(); // инициализируем новый экземпляр класса Заказ
        if ($order->load(Yii::$app->request->post())) // если заказ передаётся с ПОСТом
        {
            $order->saveOrder(Yii::$app->user->id, $session);  // то сохраняем его, передав юзер-ид и сессию
        }
        return $this->render('view', compact('session', 'order')); // отрисовываем страницу "Корзина"
    }

    public function actionChangeQty($id, $change, $currentQty)
    {
        $session = Yii::$app->session; // объявляю сессию и открываю её
        $session->open();
        $order = new Order(); // новый экземпляр заказа
        $product = Product::findOne($id); // находим товар по id
        $cart = new Cart(); // новый экземпляр корзины
        $cart->changeCart($product, $currentQty, $change); // передаём всё в функцию
        return $this->goBack('/cart/view' ,compact('session', 'order')); // возвращаем корзину
    }
}