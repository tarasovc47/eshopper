<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public function changeCart($product, $qty, $change = null) // принимаем товар и количество, если количество не передано, то оно по дефолту = 1
    {
        if (isset($_SESSION['cart'][$product->id])) // если есть в сессии корзина и в ней есть товар с данным id
        {
            if ($change == 'plus' || $change == null) // если change не передан или "плюс"
            {
                $_SESSION['cart'][$product->id]['qty'] += 1; // то увеличиваем qty на 1
            }
            elseif ($change == 'minus') // если минус
            {
                $_SESSION['cart'][$product->id]['qty'] -= 1; // то уменьшаем на 1
                if ($_SESSION['cart'][$product->id]['qty'] == 0) // если при этом qty уменьшается до 0
                {
                    unset($_SESSION['cart'][$product->id]); // удаляем из корзины этот товар
                }
            }
        }
        else // если нет
        {
            $_SESSION['cart'][$product->id] = // добавляем товар и фиксируем его параметры
                [
                    'qty' => $qty,
                    'title' => $product->title,
                    'cost' => $product->cost,
                    'image' => $product->image,
                ];
        }
        if ($change == 'plus' || $change == null)
        {
            $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + 1 : $qty; // в "количество товара" в сессии добавляем 1, если такой товар есть, или фиксируем переданный qty
            $_SESSION['cart.cost'] = isset($_SESSION['cart.cost']) ? $_SESSION['cart.cost'] + 1 * $product->cost : $qty * $product->cost; // умножаем количество товара на его цену для формирования суммы ДАННОГО товара
        }
        elseif ($change == 'minus')
        {
            $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] - 1 : $qty; // в "количество товара" в сессии добавляем 1, если такой товар есть, или фиксируем переданный qty
            $_SESSION['cart.cost'] = isset($_SESSION['cart.cost']) ? $_SESSION['cart.cost'] - 1 * $product->cost : $qty * $product->cost; // умножаем количество товара на его цену для формирования суммы ДАННОГО товора
        }
    }

    public static function recalc($id) // функция "пересчитать" принимает id товара
    {
        if (!isset($_SESSION['cart'][$id])) return false; // если такого товара нет возвращаем ЛОЖЬ

        $qtyMinus = $_SESSION['cart'][$id]['qty']; // кладём количество товара с ИД $id в $qtyMinus
        $costMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['cost']; // кладём стоимость товара с ИД $id в $costMinus
        $_SESSION['cart.qty'] -= $qtyMinus; // отнимаем от сессионного количества товара и от стоимости
        $_SESSION['cart.cost'] -= $costMinus;
        unset($_SESSION['cart'][$id]); // извлекаем из корзины товар с ИД $id
    }

    public static function clearCart($session) // функция очистки корзины принимает параметр $session
    {
        $session->remove('cart'); // удаляем из сессии корзину и зависящие от неё стоимость и количество
        $session->remove('cart.qty');
        $session->remove('cart.cost');
        return $session; // и возвращаем обнулённую сессию
    }

    public function testAjax()
    {

    }
}