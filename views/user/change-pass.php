<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

$this->title = $model->name;

?>
<div class="card">
    <div class="card-header">
    <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="card-content">
    <?php $form = ActiveForm::begin(); ?>
        
        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])->label('New Password') ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])->label('Confirm Password') ?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
    </div>
</div>
