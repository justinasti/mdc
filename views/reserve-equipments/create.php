<?php

use yii\helpers\Html;
use app\models\Equipments;
use app\models\ReserveEquipments;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\ReserveEquipments */

$this->title = 'Create Reserve Equipments';
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
    <?= $this->render('_form', [
        'model' => $model, 'id' => $id
    ]) ?>

    </br>
    </br>
    <h4><strong>Equipments Reserved</strong></h4>
    <table class="table table-stripped">
    	<tr>
    		<th>Name</th>
    		<th>Description</th>
    		<th>Quantity</th>
    	</tr>
    	<?php 
    		$equipments = ReserveEquipments::find()->where(['reservation_id' => $id])->all();
    		foreach ($equipments as $equipment) {
    			echo '<tr>
    					<td> ' . Equipments::findOne($equipment->equipment_id)->name . ' </td>
    					<td> ' . Equipments::findOne($equipment->equipment_id)->description . ' </td>
						<td> ' . $equipment->quantity . ' </td>
    				</tr>';
    		}
    	?>
    </table>

	<?= Html::a('Save', ['/reservations/view', 'id' => $id], ['class' => 'btn btn-primary']) ?>
	</div>
</div>
