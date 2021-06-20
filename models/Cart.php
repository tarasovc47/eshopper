<?php

namespace app\models;

use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public function addToCart($product, $qty = 1)
    {
        if (isset($_SESSION['cart'][$product->id]))
        {
            $_SESSION['cart'][$product->id]['qty'] += $qty;
        }
        else
        {
            $_SESSION['cart'][$product->id] =
                [
                    'qty' => $qty,
                    'title' => $product->title,
                    'cost' => $product->cost,
                    'image' => $product->image,
                ];
        }
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.cost'] = isset($_SESSION['cart.cost']) ? $_SESSION['cart.cost'] + $qty * $product->cost : $qty * $product->cost;
    }

    public function recalc($id)
    {
        if (!isset($_SESSION['cart'][$id])) return false;

        $qtyMinus = $_SESSION['cart'][$id]['qty'];
        $costMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['cost'];
        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.cost'] -= $costMinus;
        unset($_SESSION['cart'][$id]);
    }
}