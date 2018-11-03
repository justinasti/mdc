<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReservationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Calendar';

?>
<div class="card">
    <div class="card-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="card-content">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="container">
        <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
          'events'=> $events,
          'clientOptions' => [
                'selectable' => false,
                
            ]
        )); ?>
    </div>
        
    <?php Pjax::end(); ?>
</div>
</div>