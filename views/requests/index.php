<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ReserveEquipments */

$this->title = "Requests";
?>
<div class="card">
    <div class="card-header">
    <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="card-content">
    <br>
    <table class="table table-stripped">
        <tr>
            <th>Occasion</th>
            <th>No. of Participants</th>
            <th>Date & Time Start</th>
            <th>Date & Time End</th>
            <th>Facility</th>
            <th>User</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($model as $item => $rese) : ?>
            <tr>
                <td><?= $rese['occasion'] ?></td>
                <td><?= $rese['no_of_participants'] ?></td>
                <td><?= $rese['datetime_start']?></td>
                <td><?= $rese['datetime_end'] ?></td>
                <td><?= app\models\Facilities::findOne($rese['facility_id'])->name ?></td>
                <td><?= app\models\User::findOne($rese['userid'])->name ?></td>
                
                <td>
                    <?php if(app\models\User::findIdentity(Yii::$app->user->identity->id)->getRole()===300) : ?>
                       <?= Html::a('Endorse', ['confirm', 'id' => $rese['id']], ['class' => 'btn btn-sm btn-success']) ?>
                    <?php else : ?>
                       <?= Html::a('Approve', ['confirm', 'id' => $rese['id']], ['class' => 'btn btn-sm btn-success']) ?>
                    <?php endif; ?>
                    <?= Html::a('Cancel', ['cancel', 'id' => $rese['id']], ['class' => 'btn btn-sm btn-danger']) ?>        
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>
</div>