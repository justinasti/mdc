<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FacilitiesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="facilities-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'facilitySearch') ?>

    <!-- <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'capacity') ?>

    <?= $form->field($model, 'managed_by') ?> -->

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <!-- <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?> -->
    </div>

    <?php ActiveForm::end(); ?>

</div>
