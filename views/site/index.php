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
                        <h3 class="title"><?= app\models\Reservations::find()->where(['status' => 0, 'confirmation_level' => 2])->count(); ?></h3>
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
                <a href="<?= \yii\helpers\Url::to(['/user/index']) ?>">
                    <div class="card-header" data-background-color="orange">
                        <i class="glyphicon glyphicon-user"></i>
                    </div>
                    <div class="card-content">
                        <p class="category">Users</p>
                        <h3 class="title"><?= app\models\User::find()->count(); ?></h3>
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
                <a href="<?= \yii\helpers\Url::to(['/facilities']) ?>">
                    <div class="card-header" data-background-color="blue">
                        <i class="glyphicon glyphicon-list-alt"></i>
                    </div>
                    <div class="card-content">
                        <p class="category">Facilities</p>
                        <h3 class="title"><?= app\models\Facilities::find()->count(); ?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="glyphicon glyphicon-check"></i> Facilities
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <a href="<?= \yii\helpers\Url::to(['/equipments/index']) ?>">
                    <div class="card-header" data-background-color="purple">
                        <i class="glyphicon glyphicon-list-alt"></i>
                    </div>
                    <div class="card-content">
                        <p class="category">Equipments</p>
                        <h3 class="title"><?= app\models\Equipments::find()->count(); ?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="glyphicon glyphicon-check"></i> Equipments
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <a href="<?= \yii\helpers\Url::to(['/groups/index']) ?>">
                    <div class="card-header" data-background-color="blue">
                        <i class="glyphicon glyphicon-th"></i>
                    </div>
                    <div class="card-content">
                        <p class="category">Organizations/Clubs</p>
                        <h3 class="title"><?= app\models\Groups::find()->count(); ?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="glyphicon glyphicon-check"></i> Organizations/Clubs
                        </div>
                    </div>
                </a>
            </div>
        </div>
</div>
</div>