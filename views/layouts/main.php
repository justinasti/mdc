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

if (Yii::$app->controller->action->id === 'login') {
    echo $this->render('main-login', ['content' => $content]);
} else if (Yii::$app->controller->action->id === 'register') {
	echo $this->render('main-register', ['content' => $content]);
} else {
	if(class_exists('app\assets\MaterialAsset')) {
        MaterialAsset::register($this);
    }
}
$this->title = 'MDC Facilities Reservation System';
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
		<?php if (Yii::$app->user->isGuest) : ?>

		<?php else : ?>

		<?php endif ?>
	    <div class="sidebar" data-color="blue" data-image="">

			<!--
		        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
		        Tip 2: you can also add an image using data-image tag
		    -->

		    
		    <?php if (Yii::$app->user->isGuest) : ?>

		    <?php else : ?>
				<?php if (User::findOne(['id' => Yii::$app->user->identity->id])->role===400) : ?>
					<div class="sidebar-wrapper" data-color="green">
						<div class="logo">
							<a href="<?= \yii\helpers\Url::to(['/']) ?>" class="simple-text">
								<?= Yii::$app->user->identity->name; ?>
							</a>
						</div>
						<?= ramosisw\CImaterial\widgets\Menu::widget(
						[
							'options' => ['class' => 'nav'],
							'items' => [
								['label' => 'Calendar', 'icon' => 'calendar_today', 'url' => ['/calendar/index']],
								['label' => 'My Reservations', 'icon' => 'event', 'url' => ['/reservations/my-reservations']],
								
							]	
						]
						) ?>
					</div>
				<?php elseif (User::findOne(['id' => Yii::$app->user->identity->id])->role===300) : ?>
					<div class="sidebar-wrapper">
						<div class="logo">
						<a href="<?= \yii\helpers\Url::to(['/']) ?>" class="simple-text">
							<?= Yii::$app->user->identity->name; ?>
						</a>
						</div>
						<?= ramosisw\CImaterial\widgets\Menu::widget(
						[
							'options' => ['class' => 'nav'],
							'items' => [
								['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/']],
								['label' => 'Requests', 'icon' => 'check_box', 'url' => ['/requests/index']],
								['label' => 'Calendar', 'icon' => 'calendar_today', 'url' => ['/calendar/index']],
								['label' => 'My Reservations', 'icon' => 'event', 'url' => ['/reservations/my-reservations']],
								['label' => 'Manage Organization', 'icon' => 'group', 'url' => ['/groups/manage-group']],
								['label' => 'Change Password', 'icon' => 'fingerprint', 'url' => ['/user/changepassword']],
							]	
						]
						) ?>
					</div>
					<?php elseif (User::findOne(['id' => Yii::$app->user->identity->id])->role===200) : ?>
					<div class="sidebar-wrapper">
						<div class="logo">
							<a href="<?= \yii\helpers\Url::to(['/']) ?>" class="simple-text">
								<?= Yii::$app->user->identity->name; ?>
							</a>
						</div>
						<?= ramosisw\CImaterial\widgets\Menu::widget(
						[
							'options' => ['class' => 'nav'],
							'items' => [
								['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/']],
								['label' => 'Requests', 'icon' => 'check_box', 'url' => ['/requests/index']],
								['label' => 'Calendar', 'icon' => 'calendar_today', 'url' => ['/calendar/index']],
								['label' => 'My Reservations', 'icon' => 'event', 'url' => ['/reservations/my-reservations']],
								['label' => 'Manage Facility', 'icon' => 'meeting_room', 'url' => ['/facilities/manage-facility']],
								['label' => 'Change Password', 'icon' => 'fingerprint', 'url' => ['/user/changepassword']],
							]	
						]
						) ?>
					</div>
				<?php else : ?>
					<div class="sidebar-wrapper">
						<div class="logo">
							<a href="<?= \yii\helpers\Url::to(['/']) ?>" class="simple-text">
								<?= Yii::$app->user->identity->name; ?>
							</a>
						</div>
						<?= ramosisw\CImaterial\widgets\Menu::widget(
						[
							'options' => ['class' => 'nav'],
							'items' => [
								['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/']],
								['label' => 'Requests', 'icon' => 'check_box', 'url' => ['/requests/index']],
								['label' => 'Reservations', 'icon' => 'event', 'url' => ['/reservations']],
								['label' => 'Users', 'icon' => 'person', 'url' => ['/user']],
								['label' => 'Facilities', 'icon' => 'meeting_room', 'url' => ['/facilities']],	
								['label' => 'Equipments', 'icon' => 'build', 'url' => ['/equipments']],
								['label' => 'Organizations/Clubs', 'icon' => 'group', 'url' => ['/groups']],
								['label' => 'Calendar', 'icon' => 'calendar_today', 'url' => ['/calendar/index']],
								['label' => 'Change Password', 'icon' => 'fingerprint', 'url' => ['/user/changepassword']],
							]	
						]
						) ?>
					</div>
				<?php endif ?>
			<?php endif ?>	
		</div>

		<div class="main-panel">
			<?php
				
				NavBar::begin([
					'brandLabel' => '<img src="http://mdc.ph/wp-content/uploads/2013/08/MDC-Logo-clipped.png" style="display:inline; horizontal-align: top; height:55px;" alt="logo"/> MDC Facilities Reservation System',
					'brandUrl' => Yii::$app->homeUrl,
					'innerContainerOptions' => ['class' => 'container-fluid'],
					'options' => [
						'class' => 'navbar navbar-transparent navbar-absolute',
					],
				]);
				if (Yii::$app->user->isGuest) {

				} else {
					echo Nav::widget([
						'options' => ['class' => 'nav navbar-nav navbar-right'],
						'encodeLabels' => false,
						'dropDownCaret' => "<span style='font-size:25px;' class='glyphicon glyphicon-cog'></span>",
						'items' => [
							[
								'label' => "<span style='font-size:25px;' class='glyphicon glyphicon-log-out'></span>",
										'url' => ['site/logout'],
										'linkOptions' => ['data-method' => 'post']
							]
						],
					]);
				}
					
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
				<footer class = "footer">
            <div class = "container">
               <p class = "pull-left">© MDCFRS | All Rights Reserved. <?= date('Y') ?></p>
               <p class = "pull-right"><?= Yii::powered() ?></p>
            </div>
         </footer>
				
		    </div>
			
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
