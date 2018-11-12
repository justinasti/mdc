<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
<div class="card-content">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>Please fill out the following fields to change password :</p>
    
    <?php $form = ActiveForm::begin([
        'id'=>'changepassword-form',
        'options'=>['class'=>'form-horizontal'],
    ]); ?>
        <?= $form->field($model,'oldpass')->passwordInput() ?>
        
        <?= $form->field($model,'newpass')->passwordInput() ?>
        
        <?= $form->field($model,'repeatnewpass')->passwordInput() ?>
        
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-11">
                <?= Html::submitButton('Change password',[
                    'class'=>'btn btn-primary'
                ]) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
</div>
