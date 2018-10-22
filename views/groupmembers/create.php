<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Groupmembers */

$this->title = 'Create Groupmembers';
$this->params['breadcrumbs'][] = ['label' => 'Groupmembers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groupmembers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
