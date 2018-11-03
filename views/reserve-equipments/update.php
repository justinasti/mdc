<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReserveEquipments */

$this->title = 'Update Reserve Equipments: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reserve Equipments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card">
    <div class="card-header">
    <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="card-content">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
