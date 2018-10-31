<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Groupmembers */

$this->title = 'Add Group Member';
$this->params['breadcrumbs'][] = ['label' => 'Group Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groupmembers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'groupid' => $groupid
    ]) ?>

</div>
