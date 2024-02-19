<h1>Управление товарами</h1>

<a href="<?= \yii\helpers\Url::to(['create']) ?>" class="btn btn-success">Создать товар</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product->id ?></td>
                <td><?= $product->name ?></td>
                <td><?= $product->price ?> руб.</td>
                <td>
                    <a href="<?= \yii\helpers\Url::to(['update', 'id' => $product->id]) ?>"
                        class="btn btn-primary">Редактировать</a>
                    <a href="<?= \yii\helpers\Url::to(['delete', 'id' => $product->id]) ?>" class="btn btn-danger"
                        data-method="post" data-confirm="Вы уверены?">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>