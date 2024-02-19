<?php

namespace app\components;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use yii\base\Component;

class RabbitMQComponent extends Component
{
    public $host;
    public $port;
    public $user;
    public $password;
    public $queue;

    private $connection;
    private $channel;

    public function init()
    {
        parent::init();
        $this->connection = new AMQPStreamConnection($this->host, $this->port, $this->user, $this->password);
        $this->channel = $this->connection->channel();

        // Объявляем очередь
        $this->channel->queue_declare($this->queue, false, true, false, false);
    }

    // Метод для отправки сообщений в очередь
    public function sendToQueue($data)
    {
        $message = new AMQPMessage(json_encode($data), ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);
        $this->channel->basic_publish($message, '', $this->queue);
    }

    // Закрываем соединение при завершении работы
    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}