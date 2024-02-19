<?php

namespace app\modules\shop\controllers;

use yii\web\Controller;
use app\modules\shop\models\Cart;
use app\modules\shop\models\Product;
use Yii;

class CartController extends Controller
{
    /**
     * Вывод добавленных товаров
     * @return string
     */
    public function actionIndex()
    {
        $cart = Cart::getCart();
        $total = Cart::getTotal();

        return $this->render('index', ['cart' => $cart, 'total' => $total]);
    }

    /**
     * Добавдение в корзину
     * @param mixed $id
     * @return Yii\web\Response
     */
    public function actionAdd($id)
    {
        $product = Product::findOne($id);

        if ($product) {
            Cart::addProduct($product);
        }

        return $this->redirect(['cart/index']);
    }

    /**
     * Очищаем корзину
     * @return Yii\web\Response
     */
    public function actionClear()
    {
        Cart::clearCart();

        return $this->redirect(['cart/index']);
    }
}