<?php

namespace app\modules\shop\controllers;

use yii\web\Controller;
use app\modules\shop\models\Order;
use app\modules\shop\models\Cart;
use Yii;

class OrderController extends Controller
{
    /**
     * Summary of actionIndex
     * @return string|Yii\web\Response
     */
    public function actionIndex()
    {
        $order = new Order();
        if ($order->load(Yii::$app->request->post()) && $order->save()) {
            // Перенаправляем на страницу оплаты
            return $this->redirect(['payment', 'id' => $order->id]);
        }

        $cart = Cart::getCart();
        $total = Cart::getTotal();

        return $this->render('index', ['order' => $order, 'cart' => $cart, 'total' => $total]);
    }

    /**
     * Оплата заказа
     * @param mixed $id
     * @throws \yii\web\NotFoundHttpException
     * @return Yii\web\Response
     */
    public function actionPayment($id)
    {
        $order = Order::findOne($id);
        if (!$order) {
            throw new \yii\web\NotFoundHttpException('Заказ не найден');
        }

        // Создаем платеж через YooKassa
        $payment = Yii::$app->yookassa->createPayment($order->total, $order->id, 'Оплата заказа #' . $order->id);

        // Перенаправляем пользователя на страницу подтверждения оплаты
        return $this->redirect($payment->getConfirmation()->getConfirmationUrl());
    }

    /**
     * Обработка успешного платежа
     * @return string
     */
    public function actionSuccess()
    {
        return $this->render('success');
    }
}