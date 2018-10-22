<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Facilities;
use dosamigos\datetimepicker\DateTimePicker;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Reservations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reservations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'occasion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_of_participants')->textInput() ?>

    <?= $form->field($model, 'datetime_start')->widget(
        DateTimePicker::className(), [
            // inline too, not bad
            'inline' => false, 
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd H:i:s'
            ]
    ]); ?>

    <?= $form->field($model, 'datetime_end')->widget(
        DateTimePicker::className(), [
            // inline too, not bad
            'inline' => false, 
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd H:i:s'
            ]
    ]); ?>

    <?= $form->field($model, 'facility_id')->dropDownList(
        ArrayHelper::map(Facilities::find()->all(), 'id', 'name')
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(User::findIdentity(Yii::$app->user->identity->id)->getRole()===100 ? 'Save' : 'Request Reservation', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
