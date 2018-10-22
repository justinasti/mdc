<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Equipments;
use yii\helpers\ArrayHelper;
use yii\db\Query;
use app\models\ReserveEquipments;

/* @var $this yii\web\View */
/* @var $model app\models\ReserveEquipments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reserve-equipments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'equipment_id')->dropDownList(
    	ArrayHelper::map(Equipments::find()
    		->where(['not in', 'id', 
    		(new Query())
    			->select('equipment_id')
    			->from(ReserveEquipments::tableName())
    			->where(['reservation_id' => $id])
    	])->all(), 'id', 'name')
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
