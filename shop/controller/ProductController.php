<?php

namespace app\modules\shop\controllers;

use yii\web\Controller;
use app\modules\shop\models\Product;

class ProductController extends Controller
{
    /**
     * Summary of actionIndex
     * @return string
     */
    public function actionIndex()
    {
        $products = Product::find()->all();

        return $this->render('index', ['products' => $products]);
    }

    /**
     * Summary of actionView
     * @param mixed $id
     * @throws \yii\web\NotFoundHttpException
     * @return string
     */
    public function actionView($id)
    {
        $product = Product::findOne($id);

        if (!$product) {
            throw new \yii\web\NotFoundHttpException('Товар не найден');
        }

        return $this->render('view', ['product' => $product]);
    }
}