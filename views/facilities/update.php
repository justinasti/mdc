<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Facilities */

$this->title = 'Update Facility: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Facilities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
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
