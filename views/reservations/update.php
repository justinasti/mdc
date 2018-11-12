<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reservations */

$this->title = 'Update Reservations: ' . $model->id;

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
