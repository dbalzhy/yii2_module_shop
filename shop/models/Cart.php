<?php

namespace app\modules\shop\models;

use Yii;

class Cart
{
    /**
     * Summary of addProduct
     * @param mixed $product
     * @param mixed $quantity
     * @return void
     */
    public static function addProduct($product, $quantity = 1)
    {
        $cart = Yii::$app->session->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        Yii::$app->session->set('cart', $cart);
    }

    /**
     * Summary of getCart
     * @return mixed
     */
    public static function getCart()
    {
        return Yii::$app->session->get('cart', []);
    }

    public static function clearCart()
    {
        Yii::$app->session->remove('cart');
    }

    /**
     * Summary of getTotal
     * @return float|int
     */
    public static function getTotal()
    {
        $cart = self::getCart();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }
}