<?php foreach ($products as $product): ?>
    <div>
        <h2><?= $product->name ?></h2>
        <p><?= $product->price ?> руб.</p>
        <p><?= $product->description ?></p>
        <a href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $product->id]) ?>">Добавить в корзину</a>
    </div>
<?php endforeach; ?>