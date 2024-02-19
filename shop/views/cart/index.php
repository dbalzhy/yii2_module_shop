<h1>Корзина</h1>
<?php if (!empty($cart)): ?>
    <table>
        <tr>
            <th>Товар</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Итого</th>
        </tr>
        <?php foreach ($cart as $id => $item): ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= $item['price'] ?></td>
                <td><?= $item['quantity'] ?></td>
                <td><?= $item['price'] * $item['quantity'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p>Общая сумма: <?= $total ?> руб.</p>
    <a href="<?= \yii\helpers\Url::to(['order/index']) ?>">Оформить заказ</a>
    <a href="<?= \yii\helpers\Url::to(['cart/clear']) ?>">Очистить корзину</a>
<?php else: ?>
    <p>Корзина пуста</p>
<?php endif; ?>