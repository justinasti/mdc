<?php 
use yii\helpers\Html;
use app\models\Reservations;

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
                        <h3 class="title"><?php
                        $sql = 'SELECT reservations.id as "id", reservations.occasion AS "occasion", reservations.no_of_participants AS "no_of_participants", 
                        reservations.datetime_start as "datetime_start", reservations.datetime_end as "datetime_end",reservations.facility_id AS "facility_id",reservations.userid as "userid"
                        FROM `reservations` INNER JOIN (facilities, user) WHERE user.id = '.Yii::$app->user->identity->id.' AND facilities.managed_by = user.id AND reservations.facility_id = facilities.id
                        AND reservations.status = 0 AND reservations.confirmation_level = 1';

                        echo Reservations::findBySql($sql)->count();
                        //echo app\models\Reservations::getManagerRequests();
                         ?></h3>
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
                        $sql = 'SELECT reservations.id as "id", reservations.occasion AS "occasion", reservations.no_of_participants AS "no_of_participants", 
                        reservations.datetime_start as "datetime_start", reservations.datetime_end as "datetime_end",reservations.facility_id AS "facility_id",reservations.userid as "userid"
                        FROM `reservations` INNER JOIN (facilities, user) WHERE user.id = '.Yii::$app->user->identity->id.' AND facilities.managed_by = user.id AND reservations.facility_id = facilities.id AND reservations.status = 1 AND reservations.confirmation_level = 2';
                
                        echo Reservations::findBySql($sql)->count(); 
                        //echo Reservations::countManagedBy(Yii::$app->user->identity->id);
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