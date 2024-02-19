<?php $form = \yii\widgets\ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'price')->textInput() ?>
<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

<div class="form-group">
    <?= \yii\helpers\Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php \yii\widgets\ActiveForm::end(); ?>