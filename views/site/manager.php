<?php 
use yii\helpers\Html;

$this->title = 'Dashboard';

?>
<div class="card">
    <div class="card-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>    
    <div class="card-content">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <a href="<?= \yii\helpers\Url::to(['/requests/index']) ?>">
                    <div class="card-header" data-background-color="red">
                        <i class="glyphicon glyphicon-ok"></i>
                    </div>
                    <div class="card-content">
                        <p class="category">Requests</p>
                        <h3 class="title"><?= app\models\Reservations::find()->where(['status' => 0, 'confirmation_level' => 1])->count(); ?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="glyphicon glyphicon-check"></i> Requests
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <a href="<?= \yii\helpers\Url::to(['/facilities/manage-facility']) ?>">
                    <div class="card-header" data-background-color="purple">
                        <i class="glyphicon glyphicon-list-alt"></i>
                    </div>
                    <div class="card-content">
                        <p class="category">Facility Reservations</p>
                        <h3 class="title"><?php 
                        $ps = app\models\Facilities::findOne(['managed_by' => Yii::$app->user->identity->id]);
                        echo app\models\Reservations::find()->where(['facility_id' => $ps->id])->count(); 
                        ?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="glyphicon glyphicon-check"></i> Reservations
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>