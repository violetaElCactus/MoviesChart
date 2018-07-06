<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PeliculaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelicula-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'Nombre') ?>

    <?= $form->field($model, 'Sinopsis') ?>

    <?= $form->field($model, 'Trailer') ?>

    <?= $form->field($model, 'Director') ?>

    <?php // echo $form->field($model, 'Imagen') ?>

    <?php // echo $form->field($model, 'Estreno') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
