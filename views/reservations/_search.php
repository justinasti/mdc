<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReservationsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reservations-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <table class="table table-striped">

<tr>
    
    <?php
            $dept_list = array(
                1 => 'Confirmed',
                2 => 'Cancelled',
                0 => 'Pending'
            );
            ?>
    <th style="width: 20%"><?= $form->field($model, 'statusSearch')->dropDownList(
        $dept_list,
        [
            'prompt'=>'Select Status'
            ]   
    );
?></th>
<th> <?= $form->field($model, 'reservationSearch') ?></th>
<tr>
</table>

    <!-- <?= $form->field($model, 'occasion') ?>

    <?= $form->field($model, 'no_of_participants') ?>

    <?= $form->field($model, 'datetime_start') ?>

    <?= $form->field($model, 'datetime_end') ?> -->

    <?php // echo $form->field($model, 'facility_id') ?>

    <?php // echo $form->field($model, 'userid') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <!-- <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?> -->
    </div>

    <?php ActiveForm::end(); ?>

</div>
