<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\User;
use app\assets\MaterialAsset;

MaterialAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">
	    <div class="sidebar" data-color="purple" data-image="">

			<!--
		        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
		        Tip 2: you can also add an image using data-image tag
		    -->

	    	<div class="sidebar-wrapper">
			<?= ramosisw\CImaterial\widgets\Menu::widget(
            [
                'options' => ['class' => 'nav'],
                'items' => [
                	['label' => 'Dashboard', 'icon' => 'home', 'url' => ['/']],
                    ['label' => 'Users', 'icon' => 'person', 'url' => ['/user']],
                    ['label' => 'Facilities', 'icon' => 'meeting_room', 'url' => ['/facilities']],
                    ['label' => 'Equipments', 'icon' => 'build', 'url' => ['/equipments']],
                    ['label' => 'Reservations', 'icon' => 'calendar_today', 'url' => ['/reservations']],
                    ['label' => 'Organizations/Clubs', 'icon' => 'group', 'url' => ['/groups']],
		],
            ]
        ) ?>
	    	</div>
		</div>

	    <div class="main-panel">
		<?php
		NavBar::begin([
			'brandLabel' => '<img src="http://mdc.ph/wp-content/uploads/2013/08/MDC-Logo-clipped.png" style="display:inline; horizontal-align: top; height:45px;" alt="logo"/> MDC Facilities Reservation System',
			'brandUrl' => Yii::$app->homeUrl,
			'innerContainerOptions' => ['class' => 'container-fluid'],
			'options' => [
				'class' => 'navbar navbar-transparent navbar-absolute',
			],
		]);
		echo Nav::widget([
			'options' => ['class' => 'nav navbar-nav navbar-right'],
			'encodeLabels' => false,
			'dropDownCaret' => "<span style='font-size:25px;' class='glyphicon glyphicon-log-out'></span>",
			'items' => [
				[
					'label' => '',
					'items' => [
						[
						 'label' => 'Logout',
						 'url' => ['site/logout'],
						 'linkOptions' => ['data-method' => 'post']
						],
				   ],
				]
				],
		]);
		NavBar::end();
		?>
	        <div class="content">
	            <div class="container-fluid">
	                <div class="row">
					<?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
					<?= ramosisw\CImaterial\widgets\Alert::widget() ?>
						<?= $content ?>
	                </div>
	            </div>
	        </div>
			
	    </div>
	</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
