<?php

namespace app\modules\shop\controllers;

use Yii;
use app\modules\shop\models\Product;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class AdminProductController extends Controller
{
    /**
     * Summary of behaviors
     * @return array[]
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Список товаров
     * @return string
     */
    public function actionIndex()
    {
        $products = Product::find()->all();

        return $this->render('index', ['products' => $products]);
    }

    /**
     * Создание нового товара
     * @return string|Yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    /**
     * Редактирование товара по ID
     * @param mixed $id
     * @return string|Yii\web\Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', ['model' => $model]);
    }

    /**
     * Удаление товара по ID
     * @param mixed $id
     * @return Yii\web\Response
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Поиск модели товара по ID
     * @param mixed $id
     * @throws \yii\web\NotFoundHttpException
     * @return Product|null
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Товар не найден.');
    }
}