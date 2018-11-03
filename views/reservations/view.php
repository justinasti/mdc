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
        <?php if (User::findIdentity(Yii::$app->user->identity->id)->getRole()===100) : ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Cancel', ['cancel', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php elseif (User::findIdentity(Yii::$app->user->identity->id)->getRole()===100) : ?>
            
        <?php else : ?>
            <?= $model->status===0 ? Html::a('Cancel', ['cancel', 'id' => $model->id], ['class' => 'btn btn-warning']) : '' ?>
        <?php endif ?>
        <button onclick="printContent('div1')" class="btn btn-info btn-pdfprint"><i class="glyphicon glyphicon-print" style="font-size: 20px"></i></button>
    </p>
    <div id="div1">
    <div>
        <h3 class="<?= Reservations::findOne(['id' => $model->id])->status===1 ? 'text-primary' : 'text-danger' ?>"><?php 
            if (Reservations::find(['id' => $model->id])->where(['status' => 0, 'confirmation_level' => 0])->one()) { 
                echo 'Pending';
            } else if (Reservations::find(['id' => $model->id])->where(['status' => 0, 'confirmation_level' => 1])->one()) {
                echo 'Pending' ;
            } else if (Reservations::findOne(['id' => $model->id])->where(['status' => 1, 'confirmation_level' => 2])->one()) {
                echo 'Confirmed' ;
            } else {
                echo 'Cancelled';
            } ?></h3>

        <p><strong>Facility requested:</strong> <?= Facilities::findOne(['id' => $model->facility_id])->name ?></p>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
         document.title = " ";
         document.body.innerHTML = printcontent;
         window.print();
         document.body.innerHTML = restorepage;
     }
   </script>
