<?php

namespace app\components;

use YooKassa\Client;
use yii\base\Component;
use yii\base\Exception;

class YooKassaComponent extends Component
{
    public $shopId;
    public $secretKey;

    private $client;

    public function init()
    {
        parent::init();
        $this->client = new Client();
        $this->client->setAuth($this->shopId, $this->secretKey);
    }

    /**
     * Метод создания платежа
     * @param mixed $amount
     * @param mixed $orderId
     * @param mixed $description
     * @throws \yii\base\Exception
     * @return mixed
     */
    public function createPayment($amount, $orderId, $description)
    {
        try {
            $payment = $this->client->createPayment([
                'amount' => [
                    'value' => $amount,
                    'currency' => 'RUB',
                ],
                'confirmation' => [
                    'type' => 'redirect',
                    'return_url' => \Yii::$app->urlManager->createAbsoluteUrl(['shop/order/success']),
                ],
                'capture' => true,
                'description' => $description,
                'metadata' => [
                    'order_id' => $orderId,
                ],
            ], uniqid('', true));

            return $payment;
        } catch (\Exception $e) {
            throw new Exception('Ошибка при создании платежа: ' . $e->getMessage());
        }
    }

    /**
     * Метод для проверки статуса платежа
     * @param mixed $paymentId
     * @throws \yii\base\Exception
     * @return mixed
     */
    public function getPaymentStatus($paymentId)
    {
        try {
            $payment = $this->client->getPaymentInfo($paymentId);
            return $payment->getStatus();
        } catch (\Exception $e) {
            throw new Exception('Ошибка при получении информации о платеже: ' . $e->getMessage());
        }
    }
}