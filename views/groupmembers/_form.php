<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Groupmembers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="groupmembers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userid')->dropDownList(
    	ArrayHelper::map(User::find()->where(['role' => 400])->all(), 'id', 'name')
    ) ?>

    <?= $form->field($model, 'grouprole')->dropDownList(['0' => 'Leader', '1' => 'Member']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
