<?php

namespace app\modules\shop\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    /**
     * Summary of tableName
     * @return string
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * Summary of rules
     * @return array[]
     */
    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }
}