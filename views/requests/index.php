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
            <th>Occassion</th>
            <th>No. of Participants</th>
            <th>Date</th>
            <th>Facility</th>
            <th>Options</th>
        </tr>

        <?php foreach ($model as $item => $rese) : ?>
            <tr>
                <td><?= $model[$item]['id'] ?></td>
                <td><?= $model[$item]['no_of_participants'] ?></td>
                <td><?= $model[$item]['datetime_start']?></td>
                <td><?=  $model[$item]['facility_id'] ?></td>
                
                <td>
                    <?= Html::a('<span class="glyphicon glyphicon-ok"', ['confirm', 'id' => $model[$item]['id']], ['class' => 'btn btn-sm btn-success']) ?>
                    <?= Html::a('<span class="glyphicon glyphicon-remove"', ['cancel', 'id' => $model[$item]['id']], ['class' => 'btn btn-sm btn-danger']) ?>        
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>
</div>