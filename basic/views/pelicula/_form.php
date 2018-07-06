<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pelicula */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelicula-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->textInput() ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Sinopsis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Trailer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Director')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Imagen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Estreno')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
