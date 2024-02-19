<h1>Оформление заказа</h1>
<?= \yii\widgets\ActiveForm::begin() ?>
<?= $form->field($order, 'customer_name') ?>
<?= $form->field($order, 'customer_email') ?>
<?= $form->field($order, 'address') ?>
<button type="submit">Оформить заказ</button>
<?= \yii\widgets\ActiveForm::end() ?>