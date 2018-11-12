<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EquipmentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Equipments';
?>
<div class="card">
    <div class="card-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="card-content">
    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Equipment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
</div>