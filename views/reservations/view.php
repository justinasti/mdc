<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Reservations;
use app\models\Facilities;
use app\models\ReserveEquipments;
use app\models\Equipments;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Reservations */

$this->title = $model->occasion;
if (User::findIdentity(Yii::$app->user->identity->id)->getRole()===100) {
    $this->params['breadcrumbs'][] = ['label' => 'Reservations', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}
?>
<div class="reservations-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (User::findIdentity(Yii::$app->user->identity->id)->getRole()===300) : ?>
            <?= User::findIdentity(Yii::$app->user->identity->id)->getRole()===300 ? 
                    $model->status==0 && $model->confirmation_level==0 ? Html::a('Confirm', ['confirm', 'id' => $model->id], ['class' => 'btn btn-success']) : '' : '' ?>
            <?= User::findIdentity(Yii::$app->user->identity->id)->getRole()===300 ? 
                    Html::a('Cancel', ['cancel', 'id' => $model->id], ['class' => 'btn btn-warning']) : '' ?>
            <?= User::findIdentity(Yii::$app->user->identity->id)->getRole()===200 ? 
                    $model->status==0 && $model->confirmation_level==1 ? Html::a('Confirm', ['confirm', 'id' => $model->id], ['class' => 'btn btn-success']) : '' : '' ?>
            <?= User::findIdentity(Yii::$app->user->identity->id)->getRole()===200 ? 
                    Html::a('Cancel', ['cancel', 'id' => $model->id], ['class' => 'btn btn-warning']) : '' ?>
            <?= User::findIdentity(Yii::$app->user->identity->id)->getRole()===100 ? 
                    $model->status==1 && $model->confirmation_level==1 ? Html::a('Confirm', ['confirm', 'id' => $model->id], ['class' => 'btn btn-success']) : '' : '' ?>
            <?= User::findIdentity(Yii::$app->user->identity->id)->getRole()===100 ? 
                    Html::a('Cancel', ['cancel', 'id' => $model->id], ['class' => 'btn btn-warning']) : '' ?>
        
        <?php elseif (User::findIdentity(Yii::$app->user->identity->id)->getRole()===100) : ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>

            <?= User::findIdentity(Yii::$app->user->identity->id)->getRole()===100 ? 
                    $model->status===0 ? Html::a('Confirm', ['confirm', 'id' => $model->id], ['class' => 'btn btn-success']) : '' : '' ?>
            <?= User::findIdentity(Yii::$app->user->identity->id)->getRole()===100 ? 
                    Html::a('Cancel', ['cancel', 'id' => $model->id], ['class' => 'btn btn-warning']) : '' ?>
        <?php else : ?>
            <?= $model->status===0 ? Html::a('Cancel', ['cancel', 'id' => $model->id], ['class' => 'btn btn-warning']) : '' ?>
        <?php endif ?>
    </p>

    <div>
        <h3 class="<?= Reservations::findOne(['id' => $model->id])->status===1 ? 'text-primary' : 'text-danger' ?>"><?php 
            if (Reservations::find(['id' => $model->id])->andWhere(['confirmation_level' => 0])->andWhere(['status' => 0])->one()) { 
                echo 'Pending';
            } else if (Reservations::find(['id' => $model->id])->andWhere(['confirmation_level' => 1])->andWhere(['status' => 1])->one()) {
                echo 'Partially Confirmed' ;
            } else if (Reservations::findOne(['id' => $model->id])->confirmation_level===1 && status==1) {
                echo 'Confirmed' ;
            } else {
                echo 'Cancelled';
            } ?></h3>

        <p><strong>Facility requested:</strong> <?= Facilities::findOne(['id' => $model->facility_id])->name ?></p>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'no_of_participants',
            'datetime_start',
            'datetime_end',
        ],
    ]) ?>

    <br>
    <p><strong>Equipments involved:</strong></p>

    <table class="table table-stripped">
        <tr>
            <th>Name</th>
            <th>Description</th>
        </tr>
        <?php 
            $equipments = ReserveEquipments::find()->where(['reservation_id' => $model->id])->all();
            foreach ($equipments as $equipment) {
                echo '<tr>
                        <td> ' . Equipments::findOne($equipment->equipment_id)->name . ' </td>
                        <td> ' . Equipments::findOne($equipment->equipment_id)->description . ' </td>
                    </tr>';
            }
        ?>
    </table>
</div>
