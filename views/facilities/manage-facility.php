<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Facilities */

$this->title = 'Manage Facility';
?>
<div class="card">
    <div class="card-header">
    <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="card-content">
        <table class="table table-stripped">
        <tr>
            <th>ID</th>
            <th>Occasion</th>
            <th>No. of Participants</th>
            <th>Date & Time Start</th>
            <th>Date & Time End</th>
            <th>Facility</th>
            <th>User</th>
        </tr>

        <?php foreach ($model as $item => $rese) : ?>
            <tr>
                <td><?= $model[$item]['id'] ?></td>
                <td><?= $model[$item]['occasion'] ?></td>
                <td><?= $model[$item]['no_of_participants'] ?></td>
                <td><?= $model[$item]['datetime_start']?></td>
                <td><?= $model[$item]['datetime_end']?></td>
                <td><?=  $model[$item]['facility_id'] ?></td>
                <td><?= $model[$item]['userid'] ?></td>
                
            </tr>
        <?php endforeach ?>
    </table>
    </div>
</div>