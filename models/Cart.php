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
                    'name' => $product->title,
                    'cost' => $product->cost,
                    'image' => $product->image,
                ];
            $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
            $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $product->cost : $qty * $product->cost;
        }
    }
}