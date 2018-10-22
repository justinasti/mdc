<?php

use yii\helpers\Html;
use app\models\User;


/* @var $this yii\web\View */
/* @var $model app\models\Reservations */

$this->title = 'Create Reservation';
if (User::findIdentity(Yii::$app->user->identity->id)->getRole()===100) {
	$this->params['breadcrumbs'][] = ['label' => 'Reservations', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
}

?>
<div class="reservations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
