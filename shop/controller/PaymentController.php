<?php

namespace app\modules\shop\controllers;

use Yii;
use yii\web\Controller;
use yii\web\BadRequestHttpException;

class PaymentController extends Controller
{
    public function actionWebhook()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!$data || !isset($data['event'])) {
            throw new BadRequestHttpException('Некорректные данные');
        }

        // Отправляем уведомление в RabbitMQ для асинхронной обработки
        Yii::$app->rabbitmq->sendToQueue($data);

        return 'OK'; // Ответ для YooKassa
    }
}