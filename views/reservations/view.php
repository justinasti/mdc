<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Reservations;
use app\models\Facilities;
use app\models\ReserveEquipments;
use app\models\Equipments;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Reservations */

$this->title = $model->occasion;
if (User::findIdentity(Yii::$app->user->identity->id)->getRole()===100) {
    $this->params['breadcrumbs'][] = ['label' => 'Reservations', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}
?>
<div class="card">
    <div class="card-header">
    <h1><?= Html::encode($this->title) ?></h1>
    </div>
    
       
    <div class="card-content">
    <p>
        <?php if (User::findIdentity(Yii::$app->user->identity->id)->getRole()===400) : ?>
            <?= $model->status===0 ? Html::a('Cancel', ['cancel', 'id' => $model->id], ['class' => 'btn btn-warning']) : '' ?>
            <?php if (Reservations::find()->where(['status' => 1])->andWhere(['id' => $model->id])->one()) {
                if(Yii::$app->user->identity->id == $model->user->id) {
                    echo '<button onclick="printContent(\'div1\')" class="btn btn-info btn-pdfprint"><i class="glyphicon glyphicon-print" style="font-size: 10px"></i> Print</button> ';
                }
            } ?>
        <?php elseif (User::findIdentity(Yii::$app->user->identity->id)->getRole()===300) : ?>
            <?= $model->status===0 ? Html::a('Cancel', ['cancel', 'id' => $model->id], ['class' => 'btn btn-warning']) : '' ?>
            <?php if (Reservations::find()->where(['status' => 1])->andWhere(['id' => $model->id])->one()) {
                if(Yii::$app->user->identity->id == $model->user->id) {
                    echo '<button onclick="printContent(\'div1\')" class="btn btn-info btn-pdfprint"><i class="glyphicon glyphicon-print" style="font-size: 10px"></i> Print</button> ';
                }
            } ?>
        <?php elseif (User::findIdentity(Yii::$app->user->identity->id)->getRole()===200) : ?>
            <?= $model->status===0 ? Html::a('Cancel', ['cancel', 'id' => $model->id], ['class' => 'btn btn-warning']) : '' ?>
            <?php if (Reservations::find()->where(['status' => 1])->andWhere(['id' => $model->id])->one()) {
                if(Yii::$app->user->identity->id == $model->user->id) {
                    echo '<button onclick="printContent(\'div1\')" class="btn btn-info btn-pdfprint"><i class="glyphicon glyphicon-print" style="font-size: 10px"></i> Print</button> ';
                }
            } ?>
        <?php else : ?>
            <?= $model->status===0 ? Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) : '' ?>
            <?= $model->status===0 || $model->status===1 ? Html::a('Cancel', ['cancel', 'id' => $model->id], ['class' => 'btn btn-warning']) : '' ?>
            <?= $model->status===1 || $model->status===2 ? Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) : '' ?>
        <?php endif; ?>
        </p>
        
        
    <div id="div1">
        <h2><strong>Requested by:</strong> <?= User::findOne(['id' => $model->userid])->name ?></h2>
        <h2><strong>Facility requested:</strong> <?= Facilities::findOne(['id' => $model->facility_id])->name ?></h2>
        <h3 class="<?= Reservations::findOne(['id' => $model->id])->status ? 'text-primary' : 'text-danger' ?>"><?php 
            if (Reservations::find()->where(['status' => 1])->andWhere(['id' => $model->id])->one()) { 
                echo 'Confirmed' ;
            } else if (Reservations::find()->where(['status' => 2,'id' => $model->id])->one()) {
                echo 'Cancelled' ;
            } else {
                echo 'Pending';
            } ?>
        </h3>
        <h5 class="<?= Reservations::findOne(['id' => $model->id])->status ? 'text-primary' : 'text-danger' ?>"><?php 
            if (Reservations::find()->where(['confirmation_level' => 0])->andWhere(['id' => $model->id])->one()) { 
                echo 'Needs Adviser Approval' ;
            } else if (Reservations::find()->where(['confirmation_level' => 1,'id' => $model->id])->one()) {
                echo 'Needs Facility Manager Approval' ;
            } else if(Reservations::find()->where(['confirmation_level' => 2,'id' => $model->id,'status' => 0])->one()){
                echo 'Needs Admin Approval';
            } ?>
        </h5>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'occasion',
            'no_of_participants',
            'datetime_start',
            'datetime_end',
        ],
    ]) ?>

    <br>
    <p><strong>Equipments involved:</strong></p>

    <table class="table table-stripped">
        <tr>
            <th>Name</th>
            <th>Description</th>
        </tr>
        <?php 
            $equipments = ReserveEquipments::find()->where(['reservation_id' => $model->id])->all();
            foreach ($equipments as $equipment) {
                echo '<tr>
                        <td> ' . Equipments::findOne($equipment->equipment_id)->name . ' </td>
                        <td> ' . Equipments::findOne($equipment->equipment_id)->description . ' </td>
                    </tr>';
            }
        ?>
    </table>
    </div>
    </div>
</div>
<script>
      function printContent(el)
      {
         var restorepage = document.body.innerHTML;
         var printcontent = document.getElementById(el).innerHTML;
         document.body.innerHTML = printcontent;
         window.print();
         document.body.innerHTML = restorepage;
     }
</script>
