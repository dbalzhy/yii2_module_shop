<?php

namespace app\console\controllers;

use Yii;
use yii\console\Controller;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitmqController extends Controller
{
    public function actionConsume()
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        // Подписываемся на очередь
        $channel->queue_declare('payment_notifications', false, true, false, false);

        echo " [*] Ожидание сообщений. Для выхода нажмите CTRL+C\n";

        $callback = function ($msg) {
            echo ' [x] Получено сообщение ', $msg->body, "\n";
            $data = json_decode($msg->body, true);

            // Обработка уведомления о платеже
            $this->processPaymentNotification($data);

            $msg->ack(); // Подтверждаем, что сообщение обработано
        };

        $channel->basic_consume('payment_notifications', '', false, false, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }

    private function processPaymentNotification($data)
    {
        // Получаем информацию о платеже
        $paymentId = $data['object']['id'];
        $status = $data['object']['status'];

        // Обновляем статус заказа на основе полученной информации
        $order = \app\modules\shop\models\Order::findOne(['payment_id' => $paymentId]);
        if ($order) {
            if ($status == 'succeeded') {
                $order->status = 1; // статус "оплачен"
            } else {
                $order->status = 0; // статус "не оплачен"
            }
            $order->save();
        }
    }
}