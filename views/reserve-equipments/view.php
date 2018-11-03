<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\ReserveEquipments */

$this->title = $model->id;
if (User::findIdentity(Yii::$app->user->identity->id)->getRole()===100) {
    $this->params['breadcrumbs'][] = ['label' => 'Reserve Equipments', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}
?>
<div class="card">
    <div class="card-header">
    <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="card-content">
    <p>
        <?php if (User::findIdentity(Yii::$app->user->identity->id)->getRole()===100) : ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php else : ?>

        <?php endif ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'reservation_id',
            'equipment_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>
    </div>
</div>
