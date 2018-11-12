<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReservationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reservations';

?>
<div class="card">
    <div class="card-header">
    <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="card-content">
    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Reservation', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('My Reservation', ['my-reservations'], ['class' => 'btn btn-info']) ?>
    </p>
    <div class="card">
        <div class="card-content">
        <!-- <table class="table table-stripped">
        <tr>
            <th>Occassion</th>
            <th>No. of Participants</th>
            <th>Reserve Date</th>
            <th>Date</th>
            <th>Status</th>
            <th>User</th>
            <th>Options</th>
        </tr>

        <?php foreach ($model as $item) : ?>
            <tr>
                <td><?= $item->occasion ?></td>
                <td><?= $item->no_of_participants ?></td>
                <td><?= $item->reservedatetime ?></td>
                <td><?= $item->datetime_start ?></td>
                <td class="<?php if ($item->status==0) { echo 'text-warning'; } elseif ($item->status==1) { echo 'text-primary'; } else { echo 'text-danger'; } ?>">
                    <?php if ($item->status==0) { echo 'Pending'; } elseif ($item->status==1) { echo 'Confirmed'; } else { echo 'Cancelled'; } ?>
                </td>
                <td><?= $item->user->name ?></td>
                <td>
                    <?= Html::a('Details', ['view', 'id' => $item->id], ['class' => 'btn btn-sm btn-success']) ?>        
                </td>
            </tr>
        <?php endforeach ?>
    </table> -->


    <br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => [
            'class' => 'table table-stripped',
        ],
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            'occasion',
            'no_of_participants',
            'reservedatetime',
            'datetime_start',
            'statusName',
            'user.name',
            //'created_at',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{myButton}',  // the default buttons + your custom button
                'buttons' => [
                    'myButton' => function($url, $model, $key) {     // render your custom button
                        return Html::a('DETAILS', ['view', 'id' => $model->id], ['class' => 'btn btn-sm btn-success']);
                    }
                ]
            ],
        ],
    ]); ?>
        </div>
    </div>
        
    <?php Pjax::end(); ?>
</div>
</div>