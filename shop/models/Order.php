<?php

namespace app\modules\shop\models;

use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    /**
     * Summary of tableName
     * @return string
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * Summary of rules
     * @return array[]
     */
    public function rules()
    {
        return [
            [['customer_name', 'customer_email', 'address'], 'required'],
            [['status'], 'integer'],
            [['total'], 'number'],
            [['customer_name', 'customer_email'], 'string', 'max' => 255],
            [['address'], 'string'],
        ];
    }
}
