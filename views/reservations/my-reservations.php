<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ReserveEquipments */

$this->title = "My Reservations";
?>
<div class="card">
    <div class="card-header">
    <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="card-content">
    <p>
        <?= Html::a('Create Reservation', ['create'], ['class' => 'btn btn-success']) ?>        
    </p>
    <br>
    <h4><strong>History</strong></h4>
    <table class="table table-stripped">
        <tr>
            <th>Occassion</th>
            <th>No. of Participants</th>
            <th>Date</th>
            <th>Status</th>
            <th>Options</th>
        </tr>

        <?php foreach ($model as $item) : ?>
            <tr>
                <td><?= $item->occasion ?></td>
                <td><?= $item->no_of_participants ?></td>
                <td><?= $item->datetime_start ?></td>
                <td class="<?php if ($item->status===0) { echo 'text-warning'; } elseif ($item->status===1) { echo 'text-primary'; } else { echo 'text-danger'; } ?>">
                    <?php if ($item->status===0) { echo 'Pending'; } elseif ($item->status===1) { echo 'Confirmed'; } else { echo 'Cancelled'; } ?>
                </td>
                <td>
                    <?= Html::a('Details', ['view', 'id' => $item->id], ['class' => 'btn btn-sm btn-success']) ?>        
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>
</div>