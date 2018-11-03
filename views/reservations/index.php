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

$JSEventClick = <<<EOF
function(calEvent, jsEvent, view) {
    window.location.href = "reservations/view?id=" + calEvent.id
}
EOF;

?>
<div class="card">
    <div class="card-header">
    <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="card-content">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Reservation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="card">
        <div class="card-content">
        <div class="container">
        <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
          'events'=> $events,
          'clientOptions' => [
                'selectable' => true,
                'eventClick' => new JsExpression($JSEventClick),
            ]
        )); ?>
        </div>
        </div>
    </div>
        
    <?php Pjax::end(); ?>
</div>
</div>